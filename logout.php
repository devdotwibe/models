<?php

session_start();

if (!empty($_SESSION['log_user_id'])) {
    $userId   = $_SESSION['log_user_id'];
    $cacheDir = __DIR__ . '/cache/user_activity/';
    $file     = $cacheDir . 'user_' . $userId . '.txt';

    $data = time() - (5 * 60);

    file_put_contents($file, json_encode($data));
}


session_destroy();
$home_url = 'login.php';
header('Location: ' . $home_url);


?>