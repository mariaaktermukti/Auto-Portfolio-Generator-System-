<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /public/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Auto Portfolio</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
        <p>You are successfully logged in.</p>
        <p>This is your dashboard. More features will appear in Update 2 ✨</p>
        <a href="/public/logout.php">Logout</a>
    </div>
</body>
</html>
