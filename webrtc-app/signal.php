<?php

header("Content-Type: application/json");

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

if (!file_exists($roomDir)) mkdir($roomDir, 0755, true);
if (!file_exists($roomFile)) file_put_contents($roomFile, json_encode(["viewers" => []]));

$room = json_decode(file_get_contents($roomFile), true);

// Register viewer
if ($action === 'register_viewer') {
    if (!$viewer) {
        echo json_encode(["error" => "Missing viewer"]);
        exit;
    }
    if (!isset($room['viewers'][$viewer])) {
        $room['viewers'][$viewer] = [
            "offer" => null,
            "answer" => null,
            "ice" => [],
            "sent" => false
        ];
        file_put_contents($roomFile, json_encode($room));
    }
    echo json_encode(["status" => "viewer_registered"]);
    exit;
}

// Get viewers for streamer
if ($action === 'get_viewers') {
    echo json_encode($room['viewers']);
    exit;
}

// Broadcaster sends offer
if ($action === 'offer') {
    if (!$viewer || empty($input['data'])) {
        echo json_encode(["error" => "Missing viewer or offer"]);
        exit;
    }
    $room['viewers'][$viewer]['offer'] = $input['data'];
    $room['viewers'][$viewer]['sent'] = true;
    file_put_contents($roomFile, json_encode($room));
    echo json_encode(["status" => "offer_saved"]);
    exit;
}

// Viewer sends answer
if ($action === 'answer') {
    if (!$viewer || empty($input['data'])) {
        echo json_encode(["error" => "Missing viewer or answer"]);
        exit;
    }
    $room['viewers'][$viewer]['answer'] = $input['data'];
    file_put_contents($roomFile, json_encode($room));
    echo json_encode(["status" => "answer_saved"]);
    exit;
}

// ICE candidates from either side
if ($action === 'ice') {
    if (!$viewer || empty($input['data'])) {
        echo json_encode(["error" => "Missing viewer or ICE"]);
        exit;
    }
    $room['viewers'][$viewer]['ice'][] = $input['data'];
    file_put_contents($roomFile, json_encode($room));
    echo json_encode(["status" => "ice_saved"]);
    exit;
}

// Viewer requests offer + ICE
if ($action === 'get_offer') {
    if (!$viewer) {
        echo json_encode(["error" => "Missing viewer"]);
        exit;
    }

    $res = [
        "offer" => $room['viewers'][$viewer]['offer'] ?? null,
        "ice" => $room['viewers'][$viewer]['ice'] ?? []
    ];
    echo json_encode($res);
    exit;
}

echo json_encode(["status" => "no_action_handled"]);
exit;
