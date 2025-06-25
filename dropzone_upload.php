<?php
$uploadDir = 'uploads/profile_pic/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if (!empty($_FILES['file'])) {
    $file = $_FILES['file'];
    $fileName = basename($file['name']);
    $uniqueName = uniqid() . "_" . preg_replace("/[^a-zA-Z0-9\._-]/", "", $fileName);
    $uploadPath = $uploadDir . $uniqueName;

    if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
        echo json_encode([
            "status" => "success",
            "file" => $uniqueName
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "status" => "error",
            "message" => "Upload failed"
        ]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        "status" => "error",
        "message" => "No file uploaded"
    ]);
}