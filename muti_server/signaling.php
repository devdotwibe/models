<?php
header('Content-Type: application/json');

$roomId = $_GET['room'] ?? null;
$action = $_GET['action'] ?? null;
$roomsDir = __DIR__ . '/rooms';

if (!$roomId || !$action) {
    echo json_encode(["error" => "Missing params"]);
    exit;
}

$roomFile = "$roomsDir/$roomId.json";
if (!file_exists($roomsDir)) mkdir($roomsDir, 0777, true);

// Load current room state (or create if missing)
if (file_exists($roomFile)) {
    $data = json_decode(file_get_contents($roomFile), true);
} else {
    $data = [
        "meta" => [
            "streamer_started" => false,
            "streamer_id" => null,
            "created_at" => time()
        ],
        "offers" => [],
        "answers" => [],
        "candidates" => []
    ];
}

// Streamer starts room (do NOT wipe offers if any exist)
if ($action === 'create') {
    $data['meta'] = [
        "streamer_started" => true,
        "streamer_id" => uniqid("streamer_"),
        "created_at" => time()
    ];
    file_put_contents($roomFile, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["ok" => true]);
    exit;
}

// Add viewer offer
if ($action === 'offer' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $peerId = $body['peer'];
    $data['offers'][$peerId] = $body['offer'];
    file_put_contents($roomFile, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["ok" => true]);
    exit;
}

// Add streamer answer
if ($action === 'answer' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $peerId = $body['peer'];
    $data['answers'][$peerId] = $body['answer'];
    file_put_contents($roomFile, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["ok" => true]);
    exit;
}

// Add ICE candidate
if ($action === 'candidate' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $peerId = $body['peer'];
    if (!isset($data['candidates'][$peerId])) $data['candidates'][$peerId] = [];
    $data['candidates'][$peerId][] = $body['candidate'];
    file_put_contents($roomFile, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["ok" => true]);
    exit;
}

// Get room state
if ($action === 'state') {
    echo json_encode($data);
    exit;
}

echo json_encode(["error" => "Unknown action"]);
