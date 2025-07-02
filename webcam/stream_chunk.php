<?php
$index = isset($_GET['index']) ? intval($_GET['index']) : 0;
$file = __DIR__ . "/uploads/chunks/chunk$index.webm";

// Check if file exists
if (!file_exists($file)) {
    http_response_code(404);
    exit("Chunk not found");
}

// Get file size and MIME type
$size = filesize($file);
$mime = "video/webm"; // or use mime_content_type($file)
$filename = basename($file);
$start = 0;
$length = $size;

// Handle range requests
if (isset($_SERVER['HTTP_RANGE'])) {
    // Parse range header: e.g., bytes=12345-
    preg_match('/bytes=(\d+)-(\d*)/', $_SERVER['HTTP_RANGE'], $matches);
    $start = intval($matches[1]);
    $end = ($matches[2] !== '') ? intval($matches[2]) : $size - 1;
    $length = $end - $start + 1;

    header("HTTP/1.1 206 Partial Content");
    header("Content-Range: bytes $start-$end/$size");
} else {
    header("HTTP/1.1 200 OK");
    $end = $size - 1;
}

// Standard headers
header("Content-Type: $mime");
header("Content-Disposition: inline; filename=\"$filename\"");
header("Accept-Ranges: bytes");
header("Content-Length: $length");

// Stream the file
$fp = fopen($file, 'rb');
fseek($fp, $start);

$buffer = 8192;
while (!feof($fp) && $length > 0) {
    $read = ($length > $buffer) ? $buffer : $length;
    echo fread($fp, $read);
    flush();
    $length -= $read;
}
fclose($fp);
