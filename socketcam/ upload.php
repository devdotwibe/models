<?php
$target = __DIR__ . '/live/live.webm';

if (!file_exists(dirname($target))) {
    mkdir(dirname($target), 0777, true);
}

if (isset($_FILES['video']) && $_FILES['video']['tmp_name']) {
    $chunk = file_get_contents($_FILES['video']['tmp_name']);
    file_put_contents($target, $chunk, FILE_APPEND);
}
