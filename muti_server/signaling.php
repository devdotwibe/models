<?php
session_start();

$room = $_GET['room'] ?? '';
if (!$room) {
    http_response_code(400);
    echo json_encode(['error' => 'Room ID required']);
    exit;
}

$file = __DIR__ . "/rooms_$room.json";

// Initialize empty storage
if (!file_exists($file)) {
    file_put_contents($file, json_encode([
        'offers' => [], 'answers' => [], 'candidates' => []
    ]));
}

$data = json_decode(file_get_contents($file), true);

// POST add
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'] ?? '';
    $peer = $_POST['peer'] ?? '';
    $payload = $_POST['payload'] ?? '';

    if (!$type || !$peer || !$payload) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing fields']);
        exit;
    }

    // Keep only the latest for each peer
    if ($type === 'offers' || $type === 'answers') {
        $data[$type] = array_filter($data[$type], fn($o) => $o['peer'] !== $peer);
        $data[$type][] = ['peer'=>$peer, 'payload'=>$payload];
    }
    elseif ($type === 'candidates') {
        // Candidates can accumulate
        $data[$type][] = ['peer'=>$peer, 'payload'=>$payload];
    }

    file_put_contents($file, json_encode($data));
    echo json_encode(['ok'=>true]);
    exit;
}

// GET fetch
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($data);
    exit;
}
