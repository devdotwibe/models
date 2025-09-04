<?php
// signaling.php
// Simple file-based signaling for demo/prototyping.
// Usage: GET/POST with ?room={roomId}
// Stores per-room JSON files and supports consume semantics.

header('Content-Type: application/json; charset=utf-8');

$room = trim($_GET['room'] ?? '');
if ($room === '') {
    http_response_code(400);
    echo json_encode(['error' => 'room required']);
    exit;
}

$filename = __DIR__ . "/room_".preg_replace('/[^a-zA-Z0-9_\-]/','_', $room).".json";

// default structure
$default = [
    'meta' => [ 'streamer_started' => false, 'streamer_id' => null, 'created_at' => time() ],
    'offers' => (object)[],      // { peerId: offerPayload }
    'answers' => (object)[],     // { peerId: answerPayload }
    'candidates' => (object)[]   // { peerId: [ candidatePayload, ... ] }
];

// load or create
if (!file_exists($filename)) {
    file_put_contents($filename, json_encode($default, JSON_PRETTY_PRINT));
}
$raw = file_get_contents($filename);
$data = json_decode($raw, true);
if ($data === null) $data = $default;

// helper: save
function save_room($filename, $data) {
    file_put_contents($filename, json_encode($data, JSON_PRETTY_PRINT));
}

// POST actions: start_streamer, offer, answer, candidate, cleanup_peer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // read form/body
    $type = $_POST['type'] ?? '';
    $peer = $_POST['peer'] ?? '';
    $payload = $_POST['payload'] ?? '';

    if ($type === 'start_streamer') {
        // Reset room when streamer starts to ensure clean state
        $data = $default;
        $data['meta']['streamer_started'] = true;
        $data['meta']['streamer_id'] = $peer ?: null;
        $data['meta']['created_at'] = time();
        save_room($filename, $data);
        echo json_encode(['ok' => true, 'msg' => 'streamer started']);
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
            save_room($filename, $data);
        }
        echo json_encode(['ok' => true]);
        exit;
    }

    if ($peer === '' || $payload === '') {
        http_response_code(400);
        echo json_encode(['error' => 'missing peer or payload']);
        exit;
    }

    if ($type === 'offer') {
        // Keep latest offer per peer
        $data['offers'][$peer] = $payload;
        // Remove any previous answer (if viewer re-offers) — answer will be re-created by streamer
        unset($data['answers'][$peer]);
    } elseif ($type === 'answer') {
        // Keep latest answer per peer
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

// GET requests
// ?room=myroom&role=streamer&consume=1   -> streamer fetches new offers & candidates for those offers (consumed)
// ?room=myroom&role=viewer&peer=peer_x&consume=1 -> viewer fetches answer (if any) and its candidates (consumed)
// ?room=myroom&status=1  -> get meta only
$role = $_GET['role'] ?? '';
$consume = isset($_GET['consume']) && ($_GET['consume']=='1' || $_GET['consume']==1);
$peer = $_GET['peer'] ?? '';
$status = isset($_GET['status']);

if ($status) {
    echo json_encode(['meta' => $data['meta']]);
    exit;
}

if ($role === 'streamer') {
    // streamer fetch: get new offers (from viewers) and any candidates for those peers
    $offers = $data['offers']; // associative array peer->payload
    $cands_for_offers = [];

    foreach ($offers as $p => $_) {
        if (isset($data['candidates'][$p])) {
            $cands_for_offers[$p] = $data['candidates'][$p];
        } else {
            $cands_for_offers[$p] = [];
        }
    }

    $out = [
        'meta' => $data['meta'],
        'offers' => $offers,
        'candidates' => $cands_for_offers
    ];

    if ($consume) {
        // remove offers and the candidate batches we returned (candidates may be applied by streamer)
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
    if ($peer === '') {
        http_response_code(400);
        echo json_encode(['error'=>'peer required for viewer']);
        exit;
    }

    $ans = $data['answers'][$peer] ?? null;
    $cands = $data['candidates'][$peer] ?? [];

    $out = [ 'meta' => $data['meta'], 'answer' => $ans, 'candidates' => $cands ];

    if ($consume) {
        // remove the answer and candidates after returning them
        unset($data['answers'][$peer]);
        unset($data['candidates'][$peer]);
        save_room($filename, $data);
    }

    echo json_encode($out);
    exit;
}

// Fallback: return entire room (not recommended for production)
echo json_encode($data);
exit;
