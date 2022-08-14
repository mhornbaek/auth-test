<?php
include_once 'authentication.php';

// Verify request method
if ($_SERVER['REQUEST_METHOD'] !== "GET") {
    echo 'Invalid method';
    http_response_code(405);
    exit;
}

// Verify user identity from JWT
if(!verifyIdentity()){
   echo json_encode([
    'success' => false,
    'data' => 'Invalid token'
   ]); 
   exit;
}

// Get JWT from cookies
$token = $_COOKIE['jwt'];

// Decode JWT
$data = decodeJWT($token);

// Display result
echo json_encode([
    'success' => true,
    'data' => $data->data
]); 