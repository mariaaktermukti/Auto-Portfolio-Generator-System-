<?php
session_start();
require '../config/config.php';
require '../src/Auth/AuthHandler.php';

$error = '';
$success = '';
$auth = new AuthHandler($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        $error = "Security token validation failed!";
    } else {
        $name     = trim($_POST['name']);
        $email    = trim($_POST['email']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $phone    = trim($_POST['phone'] ?? '');

        // Check password confirmation
        if ($password !== $confirm_password) {
            $error = "Passwords do not match!";
        } else {
            $result = $auth->register($name, $email, $password, $phone);
            if ($result['success']) {
                $success = $result['message'];
            } else {
                $error = $result['message'];
            }
        }
    }
}

$csrf_token = generateCSRFToken();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register - Auto Portfolio</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Create Account</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <form method="POST" action="register.php">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            
            <label>Full Name</label>
            <input type="text" name="name" required>

            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password (minimum 8 characters)</label>
            <input type="password" name="password" required>

            <label>Confirm Password</label>
            <input type="password" name="confirm_password" required>

            <label>Phone (optional)</label>
            <input type="text" name="phone">

            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
