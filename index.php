<?php
$requestUri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$segments = explode('/', $requestUri);

// Home page
if ($segments[0] === '' || $segments[0] === 'index.php') {
    require 'home.php';
    exit;
}

if ($segments[0] === 'single-profile' && !empty($segments[1])) {
    $_GET['username'] = $segments[1];
    require 'single-profile.php';
    exit;
}

http_response_code(404);
require '404.php';
exit;
