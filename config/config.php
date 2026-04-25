<?php
$host = 'localhost';
$db   = 'portfolio_db';
$user = 'root';           // change if needed
$pass = '';               // change if needed
$charset = 'utf8mb4';

$conn = new mysqli($host, $user, $pass, $db); //$conn-> connection object

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
