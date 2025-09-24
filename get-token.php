<?php
require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;

// Your VideoSDK credentials
$API_KEY = "d9e05d67-8f16-4c02-bbc4-933f7603bf7d";
$API_SECRET = "8c812d371cdd9313dcb62738ad900ead2933f1f91f3cb30bef71e6e90567b438";

// Generate Server JWT (valid 1 hour)
$payload = [
    "apikey" => $API_KEY,
    "permissions" => ["allow_join", "allow_mod"],
    "iat" => time(),
    "exp" => time() + 3600
];
$server_token = JWT::encode($payload, $API_SECRET, 'HS256');

// Optional: If you want, you can create a meeting server-side
// Client can specify roomId or server can create new
$createRoom = true;
$roomId = null;

if($createRoom) {
    $url = "https://api.videosdk.live/v2/rooms";
    $options = [
        "http" => [
            "header" => "Authorization: $server_token\r\nContent-Type: application/json\r\n",
            "method" => "POST",
            "content" => json_encode([])
        ]
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $roomData = json_decode($result, true);
    $roomId = $roomData['roomId'] ?? null;
}

// Return JSON with server token and roomId
header('Content-Type: application/json');
echo json_encode([
    "token" => $server_token,
    "roomId" => $roomId
]);
