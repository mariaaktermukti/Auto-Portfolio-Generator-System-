<?php
$host = 'localhost';
$db   = 'portfolio_gen';
$user = 'root';           // change if needed
$pass = '';               // change if needed
$charset = 'utf8mb4';

$conn = new mysqli($host, $user, $pass, $db); //$conn-> connection object

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CSRF Token functions
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
}
?>
