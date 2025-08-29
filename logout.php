<?php

session_start();

if (!empty($_SESSION['log_user_id'])) {
    $userId   = $_SESSION['log_user_id'];
    $cacheDir = __DIR__ . '/cache/user_activity/';
    $file     = $cacheDir . 'user_' . $userId . '.txt';

    if (!is_dir($cacheDir)) {
        mkdir($cacheDir, 0777, true);
    }

    file_put_contents($file, time() - (5 * 60));
}



session_destroy();
$home_url = 'login.php';
header('Location: ' . $home_url);


?>