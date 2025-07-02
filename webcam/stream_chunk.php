<?php
$index = isset($_GET['index']) ? intval($_GET['index']) : 0;
$file = __DIR__ . "/uploads/chunks/chunk$index.webm";

if (!file_exists($file)) {
    http_response_code(204); // No content yet
    exit;
}

header("Content-Type: video/webm");
header("Content-Length: " . filesize($file));
header("Content-Disposition: inline; filename=\"" . basename($file) . "\"");

readfile($file);
