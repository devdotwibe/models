<?php
$uploadDir = 'uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
    $chunk = $_FILES['video']['tmp_name'];
    $targetFile = $uploadDir . '/output.webm';

    // Append the chunk to the output file
    $out = fopen($targetFile, 'ab'); // append binary
    $in = fopen($chunk, 'rb');

    while ($buffer = fread($in, 4096)) {
        fwrite($out, $buffer);
    }

    fclose($in);
    fclose($out);

    echo json_encode(['status' => 'success']);
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'File upload failed']);
}
