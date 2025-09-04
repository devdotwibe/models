<?php
// signaling.php
// File-based per-room, per-peer signaling with server-side logging for debugging.
// See in-room meta.logs for server-side events.

header('Content-Type: application/json; charset=utf-8');

$room = trim($_GET['room'] ?? '');
if ($room === '') {
    http_response_code(400);
    echo json_encode(['error'=>'room required']);
    exit;
}

$dir = __DIR__ . '/rooms';
if (!is_dir($dir)) mkdir($dir, 0777, true);
$roomFile = $dir . '/room_' . preg_replace('/[^a-zA-Z0-9_\-]/','_', $room) . '.json';

// default structure
$default = [
    'meta' => [
        'streamer_started' => false,
        'streamer_id' => null,
        'created_at' => time(),
        'logs' => []
    ],
    'offers' => new stdClass(),      // { peerId: offerPayload }
    'answers' => new stdClass(),     // { peerId: answerPayload }
    'candidates' => new stdClass()   // { peerId: [candidatePayload, ...] }
];

function read_room($file, $default) {
    if (!file_exists($file)) {
        file_put_contents($file, json_encode($default, JSON_PRETTY_PRINT));
    }
    $fh = fopen($file, 'r');
    if (!$fh) return $default;
    flock($fh, LOCK_SH);
    $raw = stream_get_contents($fh);
    flock($fh, LOCK_UN);
    fclose($fh);
    $data = json_decode($raw, true);
    if ($data === null) return json_decode(json_encode($default), true);
    return $data;
}

function save_room($file, $data) {
    $fh = fopen($file, 'c+');
    if (!$fh) return false;
    flock($fh, LOCK_EX);
    ftruncate($fh, 0);
    rewind($fh);
    fwrite($fh, json_encode($data, JSON_PRETTY_PRINT));
    fflush($fh);
    flock($fh, LOCK_UN);
    fclose($fh);
    return true;
}

$method = $_SERVER['REQUEST_METHOD'];
$data = read_room($roomFile, $default);

// GET handlers
if ($method === 'GET') {
    $action = $_GET['action'] ?? 'state';
    if ($action === 'state') {
        echo json_encode($data);
        exit;
    }
    if ($action === 'streamer') {
        $consume = isset($_GET['consume']) && ($_GET['consume'] === '1' || $_GET['consume'] === 'true');
        $offers = $data['offers'] ?? [];
        $cands_for_offers = [];
        foreach ($offers as $p => $payload) {
            $cands_for_offers[$p] = $data['candidates'][$p] ?? [];
        }
        $out = ['meta' => $data['meta'], 'offers' => $offers, 'candidates' => $cands_for_offers];
        if ($consume && !empty($offers)) {
            foreach (array_keys($offers) as $p) {
                unset($data['offers'][$p]);
                // keep answers until viewer consumes
                unset($data['candidates'][$p]); // viewer->streamer candidates consumed with the offer
            }
            save_room($roomFile, $data);
        }
        echo json_encode($out);
        exit;
    }
    if ($action === 'viewer') {
        $peer = $_GET['peer'] ?? '';
        if ($peer === '') { http_response_code(400); echo json_encode(['error'=>'peer required']); exit; }
        $consume = isset($_GET['consume']) && ($_GET['consume'] === '1' || $_GET['consume'] === 'true');
        $answer = $data['answers'][$peer] ?? null;
        $cands = $data['candidates'][$peer] ?? [];
        $out = ['meta' => $data['meta'], 'answer' => $answer, 'candidates' => $cands];
        if ($consume) {
            unset($data['answers'][$peer]);
            unset($data['candidates'][$peer]);
            save_room($roomFile, $data);
        }
        echo json_encode($out);
        exit;
    }
    echo json_encode(['error'=>'unknown action']);
    exit;
}

// POST handlers
$raw = file_get_contents('php://input');
$body = json_decode($raw, true) ?? [];

$type = $body['type'] ?? ($body['action'] ?? '');
$peer = $body['peer'] ?? '';
$payload = $body['payload'] ?? $body['offer'] ?? $body['answer'] ?? $body['candidate'] ?? null;

// server-side logging endpoint
if ($type === 'log') {
    $entry = [
        'ts' => time(),
        'from' => $body['from'] ?? 'client',
        'msg' => $body['msg'] ?? $raw
    ];
    if (!isset($data['meta']['logs']) || !is_array($data['meta']['logs'])) $data['meta']['logs'] = [];
    $data['meta']['logs'][] = $entry;
    // keep last 200 logs
    $data['meta']['logs'] = array_slice($data['meta']['logs'], -200);
    save_room($roomFile, $data);
    echo json_encode(['ok'=>true]); exit;
}

if ($type === 'start') {
    $data['meta'] = [
        'streamer_started' => true,
        'streamer_id' => $body['streamer_id'] ?? uniqid('streamer_'),
        'created_at' => time(),
        'logs' => $data['meta']['logs'] ?? []
    ];
    save_room($roomFile, $data);
    echo json_encode(['ok'=>true,'meta'=>$data['meta']]);
    exit;
}

if ($type === 'offer') {
    if (!$peer || !$payload) { http_response_code(400); echo json_encode(['error'=>'peer and offer required']); exit; }
    $data['offers'][$peer] = $payload;
    if (isset($data['answers'][$peer])) unset($data['answers'][$peer]);
    save_room($roomFile, $data);
    echo json_encode(['ok'=>true]); exit;
}

if ($type === 'answer') {
    if (!$peer || !$payload) { http_response_code(400); echo json_encode(['error'=>'peer and answer required']); exit; }
    $data['answers'][$peer] = $payload;
    save_room($roomFile, $data);
    echo json_encode(['ok'=>true]); exit;
}

if ($type === 'candidate') {
    if (!$peer || !$payload) { http_response_code(400); echo json_encode(['error'=>'peer and candidate required']); exit; }
    if (!isset($data['candidates'][$peer]) || !is_array($data['candidates'][$peer])) $data['candidates'][$peer] = [];
    $data['candidates'][$peer][] = $payload;
    save_room($roomFile, $data);
    echo json_encode(['ok'=>true]); exit;
}

if ($type === 'cleanup') {
    if ($peer !== '') {
        unset($data['offers'][$peer]);
        unset($data['answers'][$peer]);
        unset($data['candidates'][$peer]);
        save_room($roomFile, $data);
    }
    echo json_encode(['ok'=>true]); exit;
}

http_response_code(400);
echo json_encode(['error'=>'unknown type']);
exit;
