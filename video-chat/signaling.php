<?php
session_start();

$file = 'signal.json';

// Read existing signals
$signals = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

// Handle actions
$action = $_POST['action'] ?? null;

if ($action === 'send') {
    $signals[] = [
        'from' => $_POST['from'],
        'to' => $_POST['to'],
        'data' => $_POST['data']
    ];
    file_put_contents($file, json_encode($signals));
    echo 'sent';
} elseif ($action === 'get') {
    $to = $_POST['to'];
    $newSignals = [];

    foreach ($signals as $index => $signal) {
        if ($signal['to'] === $to) {
            $newSignals[] = $signal;
            unset($signals[$index]); // remove after reading
        }
    }

    file_put_contents($file, json_encode(array_values($signals))); // reset array index
    echo json_encode($newSignals);
}
