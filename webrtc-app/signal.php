<?php

$input = json_decode(file_get_contents("php://input"), true);
$action = $_GET['action'] ?? ($input['action'] ?? null);
$room_id = $_GET['room_id'] ?? ($input['room_id'] ?? null);
$viewer = $_GET['viewer'] ?? ($input['viewer'] ?? null);

if (!$room_id) {
    http_response_code(400);
    echo json_encode(["error" => "Missing room_id"]);
    exit;
}

$roomDir = "rooms";
$roomFile = "$roomDir/room_$room_id.json";

if (!file_exists($roomDir)) mkdir($roomDir);
if (!file_exists($roomFile)) file_put_contents($roomFile, json_encode(["viewers" => []]));

$room = json_decode(file_get_contents($roomFile), true);

// Register viewer
if ($action === 'register_viewer') {
    if (!isset($room['viewers'][$viewer])) {
        $room['viewers'][$viewer] = [
            "offer" => null,
            "answer" => null,
            "ice" => [],
            "sent" => false
        ];
        file_put_contents($roomFile, json_encode($room));
    }
    exit;
}

// Get viewers
if ($action === 'get_viewers') {
    echo json_encode($room['viewers']);
    exit;
}

// Broadcaster sends offer
if ($action === 'offer') {
    $room['viewers'][$viewer]['offer'] = $input['data'];
    $room['viewers'][$viewer]['sent'] = true;
    file_put_contents($roomFile, json_encode($room));
    exit;
}

// Viewer sends answer
if ($action === 'answer') {
    $room['viewers'][$viewer]['answer'] = $input['data'];
    file_put_contents($roomFile, json_encode($room));
    exit;
}

// Handle ICE
if ($action === 'ice') {
    $room['viewers'][$viewer]['ice'][] = $input['data'];
    file_put_contents($roomFile, json_encode($room));
    exit;
}

// Viewer gets offer and ICE
if ($action === 'get_offer') {
    $res = [
        "offer" => $room['viewers'][$viewer]['offer'] ?? null,
        "ice" => $room['viewers'][$viewer]['ice'] ?? []
    ];
    echo json_encode($res);
    exit;
}

echo json_encode(["status" => "no_action_handled"]);
exit;