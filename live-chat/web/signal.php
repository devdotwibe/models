<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents("php://input"), true);
$action = $_GET['action'] ?? $input['action'] ?? null;
$room_id = $_GET['room_id'] ?? $input['room_id'] ?? null;
$viewer = $_GET['viewer'] ?? $input['viewer'] ?? null;

if (!$room_id) {
    http_response_code(400);
    echo json_encode(["error" => "Missing room_id"]);
    exit;
}

$roomDir = __DIR__ . "/rooms";
$roomFile = "$roomDir/room_$room_id.json";

// Ensure room directory exists
if (!file_exists($roomDir)) mkdir($roomDir, 0777, true);
if (!file_exists($roomFile)) file_put_contents($roomFile, json_encode(["viewers" => []], JSON_PRETTY_PRINT));

$room = json_decode(file_get_contents($roomFile), true);

// Register viewer
if ($action === 'register_viewer' && $viewer) {
    if (!isset($room['viewers'][$viewer])) {
        $room['viewers'][$viewer] = [
            "offer" => null,
            "answer" => null,
            "ice" => [],
            "sent" => false
        ];
        file_put_contents($roomFile, json_encode($room, JSON_PRETTY_PRINT));
    }
    echo json_encode(["status" => "registered"]);
    exit;
}

// Get viewers
if ($action === 'get_viewers') {
    echo json_encode($room['viewers']);
    exit;
}

// Streamer sends offer
if ($action === 'offer' && $viewer) {
    $room['viewers'][$viewer]['offer'] = $input['data'] ?? null;
    $room['viewers'][$viewer]['sent'] = true;
    file_put_contents($roomFile, json_encode($room, JSON_PRETTY_PRINT));
    echo json_encode(["status" => "offer_saved"]);
    exit;
}

// Viewer sends answer
if ($action === 'answer' && $viewer) {
    $room['viewers'][$viewer]['answer'] = $input['data'] ?? null;
    file_put_contents($roomFile, json_encode($room, JSON_PRETTY_PRINT));
    echo json_encode(["status" => "answer_saved"]);
    exit;
}

// Both sides send ICE
if ($action === 'ice' && $viewer) {
    $room['viewers'][$viewer]['ice'][] = $input['data'];
    file_put_contents($roomFile, json_encode($room, JSON_PRETTY_PRINT));
    echo json_encode(["status" => "ice_saved"]);
    exit;
}

// Viewer gets offer + ICE
if ($action === 'get_offer' && $viewer) {
    echo json_encode([
        "offer" => $room['viewers'][$viewer]['offer'] ?? null,
        "ice" => $room['viewers'][$viewer]['ice'] ?? []
    ]);
    exit;
}

echo json_encode(["status" => "no_action_handled"]);
exit;
