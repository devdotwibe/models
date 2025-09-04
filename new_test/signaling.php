<?php
session_start();

$room = $_GET['room'] ?? '';
if (!$room) {
    http_response_code(400);
    echo json_encode(['error' => 'Room ID required']);
    exit;
}

$file = __DIR__ . "/rooms_$room.json";

// Initialize empty room storage if not exists
if (!file_exists($file)) {
    file_put_contents($file, json_encode(['offers' => [], 'answers' => [], 'candidates' => []]));
}

$data = json_decode(file_get_contents($file), true);

// Handle request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'] ?? '';
    $payload = $_POST['payload'] ?? '';

    if (!$type || !$payload) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing type or payload']);
        exit;
    }

    $id = uniqid();
    $data[$type][] = ['id' => $id, 'payload' => $payload];
    file_put_contents($file, json_encode($data));

    echo json_encode(['ok' => true, 'id' => $id]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode($data);
    exit;
}
