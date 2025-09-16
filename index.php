<?php

$requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments   = explode('/', $requestUri);

if ($segments[0] === '' || $segments[0] === 'index.php') {
    require __DIR__ . '/home.php';
    exit;
}

if ($segments[0] === 'single-profile' && !empty($segments[1])) {
   
    $_GET['username'] = preg_replace('/[^a-zA-Z0-9_-]/', '', $segments[1]);

    if (file_exists(__DIR__ . '/single-profile.php')) {
        require __DIR__ . '/single-profile.php';
    } else {
        http_response_code(404);
        require __DIR__ . '/404.php';
    }
    exit;
}

if ($segments[0] === 'live-stream' && !empty($segments[1])) {
    
    $_GET['username'] = preg_replace('/[^a-zA-Z0-9_-]/', '', $segments[1]);

    if (file_exists(__DIR__ . '/live-stream/index.php')) {
        require __DIR__ . '/live-stream/index.php';
    } else {
        http_response_code(404);
        require __DIR__ . '/404.php';
    }
    exit;
}

http_response_code(404);
require __DIR__ . '/404.php';
exit;
