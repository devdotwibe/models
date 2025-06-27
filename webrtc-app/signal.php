<?php

$roomFile = 'rooms/room.json';

if (!file_exists('rooms')) {
    mkdir('rooms');
}
if (!file_exists($roomFile)) {
    file_put_contents($roomFile, json_encode(["viewers" => []]));
}

$data = json_decode(file_get_contents("php://input"), true);
$action = $_GET['action'] ?? ($data['action'] ?? null);
$room = json_decode(file_get_contents($roomFile), true);

// Register viewer
if ($action === 'register_viewer') {
    $viewer = $data['viewer'];
    if (!isset($room['viewers'][$viewer])) {
        $room['viewers'][$viewer] = [
            "offer" => null,
            "answer" => null,
            "ice" => [],
            "sent" => false
        ];
    }
    file_put_contents($roomFile, json_encode($room));
    exit;
}

// Get all viewers
if ($action === 'get_viewers') {
    echo json_encode($room['viewers']);
    exit;
}

// Broadcaster sends offer
if ($action === 'offer') {
    $viewer = $data['viewer'];
    $room['viewers'][$viewer]['offer'] = $data['data'];
    $room['viewers'][$viewer]['sent'] = true;
    file_put_contents($roomFile, json_encode(value: $room));
    exit;
}

// Viewer sends answer
if ($action === 'answer') {
    $viewer = $data['viewer'];
    $room['viewers'][$viewer]['answer'] = $data['data'];
    file_put_contents($roomFile, json_encode($room));
    exit;
}

// Any ICE candidate
if ($action === 'ice') {
    $viewer = $data['viewer'];
    $room['viewers'][$viewer]['ice'][] = $data['data'];
    file_put_contents($roomFile, json_encode($room));
    exit;
}

// Viewer gets offer and ICE
if ($action === 'get_offer') {
    $viewer = $_GET['viewer'];
    $res = [
        "offer" => $room['viewers'][$viewer]['offer'] ?? null,
        "ice" => $room['viewers'][$viewer]['ice'] ?? []
    ];
    echo json_encode($res);
    exit;
}
