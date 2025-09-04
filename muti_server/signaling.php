<?php
// signaling.php
// File-based, per-room, per-peer signaling for demo/prototyping.
// GET/POST with ?room=roomId
// POST types: start_streamer, offer, answer, candidate, cleanup_peer
// GET role=streamer -> returns offers (per-peer) and streamer-candidates
// GET role=viewer&peer=peerId -> returns answer (for that peer) and candidates (for that peer)

header('Content-Type: application/json; charset=utf-8');

$room = trim($_GET['room'] ?? '');
if ($room === '') {
    http_response_code(400);
    echo json_encode(['error' => 'room required']);
    exit;
}

// safe filename
$filename = __DIR__ . "/room_".preg_replace('/[^a-zA-Z0-9_\-]/','_', $room).".json";

$default = [
    'meta' => ['streamer_started' => false, 'streamer_id' => null, 'created_at' => time()],
    'offers' => new stdClass(),      // assoc: peerId => payload (stringified SDP JSON)
    'answers' => new stdClass(),     // assoc: peerId => payload
    'candidates' => new stdClass()   // assoc: peerId => [payload1, payload2, ...]
];

// load or init
if (!file_exists($filename)) {
    file_put_contents($filename, json_encode($default, JSON_PRETTY_PRINT));
}
$raw = file_get_contents($filename);
$data = json_decode($raw, true);
if ($data === null) $data = json_decode(json_encode($default), true);

// helpers
function save_room($filename, $data) {
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}

$requestMethod = $_SERVER['REQUEST_METHOD'];

// POST handling
if ($requestMethod === 'POST') {
    $type = $_POST['type'] ?? '';
    $peer = $_POST['peer'] ?? '';
    $payload = $_POST['payload'] ?? '';

    if ($type === 'start_streamer') {
        // reset/clean room and mark streamer started
        $data = json_decode(json_encode($default), true);
        $data['meta']['streamer_started'] = true;
        $data['meta']['streamer_id'] = $peer ?: null;
        $data['meta']['created_at'] = time();
        save_room($filename, $data);
        echo json_encode(['ok' => true, 'msg' => 'streamer started/room reset']);
        exit;
    }

    if (!in_array($type, ['offer','answer','candidate','cleanup_peer'])) {
        http_response_code(400);
        echo json_encode(['error' => 'invalid type']);
        exit;
    }

    if ($type === 'cleanup_peer') {
        if ($peer !== '') {
            unset($data['offers'][$peer]);
            unset($data['answers'][$peer]);
            unset($data['candidates'][$peer]);
            // also remove empty arrays / objects
            if (empty($data['offers'])) $data['offers'] = new stdClass();
            if (empty($data['answers'])) $data['answers'] = new stdClass();
            if (empty($data['candidates'])) $data['candidates'] = new stdClass();
            save_room($filename, $data);
        }
        echo json_encode(['ok' => true]);
        exit;
    }

    // require peer & payload
    if ($peer === '' || $payload === '') {
        http_response_code(400);
        echo json_encode(['error' => 'missing peer or payload']);
        exit;
    }

    if ($type === 'offer') {
        // store latest offer for peer (viewer->streamer)
        $data['offers'][$peer] = $payload;
        // remove stale answer if any (viewer re-offered)
        if (isset($data['answers'][$peer])) unset($data['answers'][$peer]);
    } elseif ($type === 'answer') {
        // store answer for peer (streamer->viewer)
        $data['answers'][$peer] = $payload;
    } elseif ($type === 'candidate') {
        if (!isset($data['candidates'][$peer]) || !is_array($data['candidates'][$peer])) {
            $data['candidates'][$peer] = [];
        }
        $data['candidates'][$peer][] = $payload;
    }

    save_room($filename, $data);
    echo json_encode(['ok' => true]);
    exit;
}

// GET handling
$role = $_GET['role'] ?? '';
$consume = isset($_GET['consume']) && ($_GET['consume'] === '1' || $_GET['consume'] === 'true' || $_GET['consume'] === 'yes');
$peer = $_GET['peer'] ?? '';
$status = isset($_GET['status']) && ($_GET['status'] === '1' || $_GET['status'] === 'true' || $_GET['status'] === 'yes');

if ($status) {
    echo json_encode(['meta' => $data['meta']]);
    exit;
}

if ($role === 'streamer') {
    // Streamer asks for all offers (from viewers) and candidates for those offers.
    // We return offers (assoc) and candidates (assoc per peer).
    $offers = $data['offers'] ?? [];
    $cands_for_offers = [];

    foreach ($offers as $p => $payload) {
        $cands_for_offers[$p] = $data['candidates'][$p] ?? [];
    }

    $out = ['meta' => $data['meta'], 'offers' => $offers, 'candidates' => $cands_for_offers];

    if ($consume) {
        // remove offers & their candidate arrays (streamer will answer and we'll keep answer until viewer consumes it)
        foreach (array_keys($offers) as $p) {
            unset($data['offers'][$p]);
            unset($data['candidates'][$p]);
        }
        save_room($filename, $data);
    }

    echo json_encode($out);
    exit;
}

if ($role === 'viewer') {
    // viewer must specify its peer id
    if ($peer === '') {
        http_response_code(400);
        echo json_encode(['error' => 'peer required for viewer']);
        exit;
    }

    $ans = $data['answers'][$peer] ?? null;
    $cands = $data['candidates'][$peer] ?? [];

    $out = ['meta' => $data['meta'], 'answer' => $ans, 'candidates' => $cands];

    if ($consume) {
        // remove answer & candidates for this peer once consumed
        if (isset($data['answers'][$peer])) unset($data['answers'][$peer]);
        if (isset($data['candidates'][$peer])) unset($data['candidates'][$peer]);
        save_room($filename, $data);
    }

    echo json_encode($out);
    exit;
}

// fallback: return full room (not recommended)
echo json_encode($data);
exit;
