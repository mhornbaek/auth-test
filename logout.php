<?php
include_once 'authentication.php';

// Verify request method
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    echo 'Invalid method';
    http_response_code(405);
    exit;
}

// Delete JWT from cookies
setcookie('jwt', '', time() - 3600);