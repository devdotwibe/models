<?php

header("Content-Type: application/json");

// Get input from JSON body or URL parameters
$input = json_decode(file_get_contents("php://input"), true);
$action = $_GET['action'] ?? ($input['action'] ?? null);
$room_id = $_GET['room_id'] ?? ($input['room_id'] ?? null);
$viewer = $_GET['viewer'] ?? ($input['viewer'] ?? null);

// Validate required fields
if (!$room_id) {
    http_response_code(400);
    echo json_encode(["error" => "Missing room_id"]);
    exit;
}

// Setup room and viewer file paths
$roomDir = "rooms";
$roomFile = "$roomDir/room_$room_id.json";

// Create directory and file if they don't exist
if (!file_exists($roomDir)) mkdir($roomDir, 0755, true);
if (!file_exists($roomFile)) file_put_contents($roomFile, json_encode(["viewers" => []]));

// Load existing room state
$room = json_decode(file_get_contents($roomFile), true);

// --- 1. Register viewer ---
if ($action === 'register_viewer') {
    if (!$viewer) {
        echo json_encode(["error" => "Missing viewer ID"]);
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

// --- 2. Get all viewers for broadcaster ---
if ($action === 'get_viewers') {
    echo json_encode($room['viewers']);
    exit;
}

// --- 3. Streamer sends offer ---
if ($action === 'offer') {
    if (!$viewer || empty($input['data'])) {
        echo json_encode(["error" => "Missing viewer or offer data"]);
        exit;
    }

    $room['viewers'][$viewer]['offer'] = $input['data'];
    $room['viewers'][$viewer]['sent'] = true;

    file_put_contents($roomFile, json_encode($room));
    echo json_encode(["status" => "offer_saved"]);
    exit;
}

// --- 4. Viewer sends answer ---
if ($action === 'answer') {
    if (!$viewer || empty($input['data'])) {
        echo json_encode(["error" => "Missing viewer or answer data"]);
        exit;
    }

    $room['viewers'][$viewer]['answer'] = $input['data'];
    file_put_contents($roomFile, json_encode($room));
    echo json_encode(["status" => "answer_saved"]);
    exit;
}

// --- 5. ICE candidates from both sides ---
if ($action === 'ice') {
    if (!$viewer || empty($input['data'])) {
        echo json_encode(["error" => "Missing viewer or ICE data"]);
        exit;
    }

    $room['viewers'][$viewer]['ice'][] = $input['data'];
    file_put_contents($roomFile, json_encode($room));
    echo json_encode(["status" => "ice_saved"]);
    exit;
}

// --- 6. Viewer gets offer + ICE ---
if ($action === 'get_offer') {
    if (!$viewer) {
        echo json_encode(["error" => "Missing viewer ID"]);
        exit;
    }

    $res = [
        "offer" => $room['viewers'][$viewer]['offer'] ?? null,
        "ice" => $room['viewers'][$viewer]['ice'] ?? []
    ];
    echo json_encode($res);
    exit;
}

// --- 7. Unknown action ---
echo json_encode(["status" => "no_action_handled", "action" => $action]);
exit;
