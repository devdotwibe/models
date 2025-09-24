<?php
require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;

// Replace with your actual VideoSDK credentials
$API_KEY = "d9e05d67-8f16-4c02-bbc4-933f7603bf7d";       // your public API key
$API_SECRET = "8c812d371cdd9313dcb62738ad900ead2933f1f91f3cb30bef71e6e90567b438"; // secret

// Token payload
$payload = [
    "apikey" => $API_KEY,
    "permissions" => ["allow_join", "allow_mod"], // required permissions
    "iat" => time(),
    "exp" => time() + 60*60*24 // token valid for 24 hours
];

// Generate JWT
$token = JWT::encode($payload, $API_SECRET, 'HS256');

// Return as JSON
header('Content-Type: application/json');
echo json_encode(["token" => $token]);
