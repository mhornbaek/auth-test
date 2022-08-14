<?php
include_once 'authentication.php';

// Example of how to verify identity from JWT

// Verify user identity from JWT
if(!verifyIdentity()) {
    echo 'Invalid token';
    http_response_code(401);
    exit;
}

// Display secret message
echo 'secret';