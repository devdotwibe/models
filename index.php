<?php

$requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments   = explode('/', $requestUri);

if ($segments[0] === '' || $segments[0] === 'index.php') {
    require __DIR__ . '/home.php';
    exit;
}


    $excluded = ['advertisements', 'live-stream', 'watch-stream', '404'];

    $routes = [
        'all-members',
        'contact-support',
        'verification-help',
        'tls-tom',
        'privacy-policy',
        'verification-policy',
        'edit-profile',
        'my-activity',
        'wallet',
        'my-purchase',
        'optimized_services',
        'chat-app',
        'login',
        'booking'
    ];

    if (!empty($segments[0]) && in_array($segments[0], $routes)) {
        $file = __DIR__ . '/' . $segments[0] . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            http_response_code(404);
            require __DIR__ . '/404.php';
        }
        exit;
    }

    if ($segments[0] === 'advertisement' && !empty($segments[1])) {
        $file = __DIR__ . '/advertisement/' . basename($segments[1]) . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            http_response_code(404);
            require __DIR__ . '/404.php';
        }
        exit;
    }

    if ($segments[0] === 'payments' && !empty($segments[1])) {
        $file = __DIR__ . '/payments/' . basename($segments[1]) . '.php';
        if (file_exists($file)) {
            require $file;
        } else {
            http_response_code(404);
            require __DIR__ . '/404.php';
        }
        exit;
    }


    if (!empty($segments[0]) && !in_array($segments[0], $excluded) && !preg_match('/\.php$/i', $segments[0])) {

        // $_GET['username'] = preg_replace('/[^a-zA-Z0-9_-]/', '', $segments[0]);
        $username = urldecode($segments[0]);
        
        $_GET['username'] = preg_replace('/[^a-zA-Z0-9@._-]/', '', $username);

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

    if ($segments[0] === 'watch-stream' && !empty($segments[1])) {
        
        $_GET['username'] = preg_replace('/[^a-zA-Z0-9_-]/', '', $segments[1]);

        if (file_exists(__DIR__ . '/watch-stream/index.php')) {
            require __DIR__ . '/watch-stream/index.php';
        } else {
            http_response_code(404);
            require __DIR__ . '/404.php';
        }
        exit;
    }

    http_response_code(404);
    require __DIR__ . '/404.php';
    exit;
