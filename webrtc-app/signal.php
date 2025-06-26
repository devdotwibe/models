<?php
$file = "rooms/room.json";

if (!file_exists("rooms")) {
    mkdir("rooms", 0777, true);
}
if (!file_exists($file)) {
    file_put_contents($file, json_encode(["viewers" => []]));
}

$data = json_decode(file_get_contents("php://input"), true);
$action = $_GET['action'] ?? $data['action'] ?? '';

$room = json_decode(file_get_contents($file), true);

// Register a viewer
if ($action === 'register_viewer') {
    $viewerId = $data['viewer'];
    $room['viewers'][$viewerId] = ["offer" => null, "answer" => null, "ice" => []];
    file_put_contents($file, json_encode($room));
    exit;
}

// Get all viewers (for broadcaster)
if ($action === 'get_viewers') {
    echo json_encode($room['viewers']);
    exit;
}

// Send offer from broadcaster
if ($action === 'offer') {
    $viewerId = $data['viewer'];
    $room['viewers'][$viewerId]['offer'] = $data['offer'];
    file_put_contents($file, json_encode($room));
    exit;
}

// Viewer sends answer
if ($action === 'answer') {
    $viewerId = $data['viewer'];
    $room['viewers'][$viewerId]['answer'] = $data['answer'];
    file_put_contents($file, json_encode($room));
    exit;
}

// ICE candidates
if ($action === 'ice') {
    $viewerId = $data['viewer'];
    $room['viewers'][$viewerId]['ice'][] = $data['candidate'];
    file_put_contents($file, json_encode($room));
    exit;
}

// Viewer gets offer + ICE
if ($action === 'get_offer') {
    $viewerId = $_GET['viewer'];
    $viewer = $room['viewers'][$viewerId] ?? [];
    echo json_encode([
        'offer' => $viewer['offer'] ?? null,
        'ice' => $viewer['ice'] ?? []
    ]);
    exit;
}
