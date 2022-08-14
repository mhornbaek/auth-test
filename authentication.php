<?php
require __DIR__ . '/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$key = "example_key";
$issuer = "http://auth-test.test";

// Create JWT with payload of $data
function createJWT($data) {

    // Get current time in unix timestamp
    $currentTime = time();

    $payload = [
        'iss' => $GLOBALS["issuer"],
        'aud' => $GLOBALS["issuer"],
        'iat' => $currentTime,
        'data' => $data
    ];

    $jwt = JWT::encode($payload, $GLOBALS["key"], 'HS256');

    return $jwt;
}

function decodeJWT ($jwt) {
    try {
        $decoded = JWT::decode($jwt, new Key($GLOBALS["key"], 'HS256'));
    
        return $decoded;
    }
    catch (Exception $e) {
        echo 'Invalid token';
        http_response_code(401);
        exit;
    }
}

function verifyIdentity() {
    if(!isset($_COOKIE['jwt'])) {
        return false;
    }
    
    // Get JWT from cookies
    $token = $_COOKIE['jwt'];
    
    // Decode JWT
    $data = decodeJWT($token);

    if($data != null) {
        return true;
    }
    return false;
}