<?php
$uploadDir = __DIR__ . '/uploads/chunks';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_FILES['video']) && isset($_POST['index'])) {
    $index = intval($_POST['index']);
    $target = $uploadDir . "/chunk$index.webm";
    
    if (move_uploaded_file($_FILES['video']['tmp_name'], $target)) {
        echo json_encode(['status' => 'saved']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to move file']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
