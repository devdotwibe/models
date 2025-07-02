<?php
$uploadDir = 'uploads';
$filePath = $uploadDir . '/output.webm';
$doneFlag = $uploadDir . '/stream_done.txt';

if (!file_exists($filePath)) {
    http_response_code(404);
    exit('Video not found');
}

$size = filesize($filePath);
$mime = mime_content_type($filePath);
$start = 0;
$length = $size;

if (file_exists($doneFlag)) {
    header('X-Stream-Status: closed');
}

if (isset($_SERVER['HTTP_RANGE'])) {
    preg_match('/bytes=(\d+)-(\d*)/', $_SERVER['HTTP_RANGE'], $matches);
    $start = intval($matches[1]);
    $end = $matches[2] !== '' ? intval($matches[2]) : $size - 1;
    $length = $end - $start + 1;
    header('HTTP/1.1 206 Partial Content');
    header("Content-Range: bytes $start-$end/$size");
} else {
    header('HTTP/1.1 200 OK');
}

header("Content-Type: $mime");
header('Accept-Ranges: bytes');
header("Content-Length: $length");

$fp = fopen($filePath, 'rb');
fseek($fp, $start);
$buffer = 1024 * 8;

while (!feof($fp) && $length > 0) {
    $read = ($length > $buffer) ? $buffer : $length;
    echo fread($fp, $read);
    flush();
    $length -= $read;
}
fclose($fp);
