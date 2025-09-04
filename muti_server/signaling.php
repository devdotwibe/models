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

// Create new room (by streamer)
if ($action === 'create') {
    file_put_contents($roomFile, json_encode([
        "meta" => [
            "streamer_started" => true,
            "streamer_id" => uniqid("streamer_"),
            "created_at" => time()
        ],
        "offers" => [],   // viewer offers
        "answers" => [],  // streamer answers
        "candidates" => []
    ], JSON_PRETTY_PRINT));
    echo json_encode(["ok" => true]);
    exit;
}

// Add viewer offer
if ($action === 'offer' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $data = json_decode(file_get_contents($roomFile), true);
    $peerId = $body['peer'];
    $data['offers'][$peerId] = $body['offer'];
    file_put_contents($roomFile, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["ok" => true]);
    exit;
}

// Add streamer answer
if ($action === 'answer' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $data = json_decode(file_get_contents($roomFile), true);
    $peerId = $body['peer'];
    $data['answers'][$peerId] = $body['answer'];
    file_put_contents($roomFile, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["ok" => true]);
    exit;
}

// Add ICE candidate
if ($action === 'candidate' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $body = json_decode(file_get_contents("php://input"), true);
    $data = json_decode(file_get_contents($roomFile), true);
    $peerId = $body['peer'];
    $data['candidates'][$peerId][] = $body['candidate'];
    file_put_contents($roomFile, json_encode($data, JSON_PRETTY_PRINT));
    echo json_encode(["ok" => true]);
    exit;
}

// Poll room state
if ($action === 'state') {
    if (!file_exists($roomFile)) {
        echo json_encode(["error" => "Room not found"]);
        exit;
    }
    echo file_get_contents($roomFile);
    exit;
}

echo json_encode(["error" => "Unknown action"]);
