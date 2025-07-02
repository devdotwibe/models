<?php
$uploadDir = 'uploads';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
    $chunk = $_FILES['video']['tmp_name'];
    $targetFile = $uploadDir . '/output.webm';

    // Append video chunk
    $out = fopen($targetFile, 'ab');
    $in = fopen($chunk, 'rb');
    while ($buffer = fread($in, 4096)) {
        fwrite($out, $buffer);
    }
    fclose($in);
    fclose($out);

    echo json_encode(['status' => 'success']);
}
elseif (isset($_POST['stop']) && $_POST['stop'] === 'true') {
    // Create done flag
    file_put_contents($uploadDir . '/stream_done.txt', 'done');
    echo json_encode(['status' => 'stream closed']);
}
else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Upload failed']);
}
