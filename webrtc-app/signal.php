<?php
session_start();

$file = 'signal_data.json';
$data = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$action = $_GET['action'] ?? '';
$room_id = $_GET['room_id'] ?? '';
$viewer_id = $_GET['viewer_id'] ?? '';
$to = $_GET['to'] ?? '';
$type = $_GET['type'] ?? '';

switch ($action) {
    case 'send':
        $payload = json_decode(file_get_contents('php://input'), true);
        if (!isset($data[$room_id])) $data[$room_id] = [];
        if (!isset($data[$room_id][$to])) $data[$room_id][$to] = [];

        if ($type === 'offer') {
            $data[$room_id][$to]['offer'] = $payload;
        } elseif ($type === 'answer') {
            $data[$room_id][$to]['answer'] = $payload;
        } elseif ($type === 'ice') {
            if (!isset($data[$room_id][$to]['ice'])) $data[$room_id][$to]['ice'] = [];
            $data[$room_id][$to]['ice'][] = $payload;
        }
        file_put_contents($file, json_encode($data));
        break;

    case 'get_viewers':
        echo json_encode($data[$room_id] ?? []);
        break;

    case 'get_signals':
        echo json_encode($data[$room_id][$_GET['viewer_id']] ?? []);
        break;
}
