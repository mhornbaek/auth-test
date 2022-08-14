<?php
include_once 'authentication.php';

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    echo 'Invalid method';
    http_response_code(405);
    exit;
}

// Get JSON from body
$data = json_decode(file_get_contents('php://input'), true);

// Get username and password from JSON
$username = $data['username'];
$password = $data['password'];

// Verify username/password here


// Create JWT with username
$token = createJWT(["username" => $username]);

// Set JWT in cookies
setcookie('jwt', $token);

// Display JWT
echo json_encode($token);