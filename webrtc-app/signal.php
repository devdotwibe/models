<?php
// signal.php
header("Content-Type: application/json");
$file = 'signal_data.json';
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$action = $_GET['action'] ?? '';
$room_id = $_GET['room_id'] ?? '';
$viewer_id = $_GET['viewer_id'] ?? '';
$to = $_GET['to'] ?? '';
$type = $_GET['type'] ?? '';

switch ($action) {
    case 'send':
        $input = json_decode(file_get_contents('php://input'), true);

        if (!isset($data[$room_id])) $data[$room_id] = [];
        if (!isset($data[$room_id][$to])) $data[$room_id][$to] = [];

        if ($type === 'offer') {
            $data[$room_id][$to]['offer'] = $input;
        } elseif ($type === 'answer') {
            $data[$room_id][$to]['answer'] = $input;
        } elseif ($type === 'ice') {
            if (!isset($data[$room_id][$to]['ice'])) $data[$room_id][$to]['ice'] = [];
            $data[$room_id][$to]['ice'][] = $input;
        }

        file_put_contents($file, json_encode($data));
        echo json_encode(["status" => "ok"]);
        break;

    case 'get_viewers':
        echo json_encode($data[$room_id] ?? []);
        break;

    case 'get_signals':
        echo json_encode($data[$room_id][$viewer_id] ?? []);
        break;

    default:
        echo json_encode(["status" => "no_action"]);
        break;
}
