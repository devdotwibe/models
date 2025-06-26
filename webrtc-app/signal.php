<?php
$room = $_GET['room'] ?? '';
$action = $_GET['action'] ?? '';
$signalFile = "rooms/$room.txt";

if (!file_exists("rooms")) {
    mkdir("rooms", 0777, true);
}

// CREATE or POLL
if ($action === "check") {
    if (!file_exists($signalFile)) {
        file_put_contents($signalFile, json_encode([]));
        echo json_encode(['hasOffer' => false]);
    } else {
        $json = json_decode(file_get_contents($signalFile), true);
        echo json_encode([
            'hasOffer' => isset($json['offer']),
            'offer' => $json['offer'] ?? null
        ]);
    }
    exit;
}

if ($action === "poll") {
    $json = json_decode(file_get_contents($signalFile), true);
    echo json_encode([
        'answer' => $json['answer'] ?? null,
        'ice' => $json['ice'] ?? []
    ]);
    exit;
}

// RECEIVE SIGNAL
$input = json_decode(file_get_contents("php://input"), true);
if ($input) {
    $room = $input['room'];
    $data = $input['data'];

    $signalFile = "rooms/$room.txt";
    $existing = file_exists($signalFile) ? json_decode(file_get_contents($signalFile), true) : [];

    if ($data['type'] === 'offer') {
        $existing['offer'] = json_encode($data['offer']);
    }

    if ($data['type'] === 'answer') {
        $existing['answer'] = json_encode($data['answer']);
    }

    if ($data['type'] === 'ice') {
        $existing['ice'][] = $data['candidate'];
    }

    file_put_contents($signalFile, json_encode($existing));
}
