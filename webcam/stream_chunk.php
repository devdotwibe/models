<?php
$index = isset($_GET['index']) ? intval($_GET['index']) : 0;
$file = __DIR__ . "/uploads/chunks/chunk$index.webm";

if (!file_exists($file)) {
    http_response_code(204); // Not ready
    exit;
}

header("Content-Type: video/webm");
header("Content-Disposition: inline; filename=\"" . basename($file) . "\"");
header("Content-Length: " . filesize($file));

readfile($file);
