<?php
session_start();
require '../config/config.php';
require '../src/Auth/AuthHandler.php';

$error = '';
$auth = new AuthHandler($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        $error = "Security token validation failed!";
    } else {
        $email    = trim($_POST['email']);
        $password = $_POST['password'];

        $result = $auth->login($email, $password);
        
        if ($result['success']) {
            // Set session variables
            $_SESSION['user_id'] = $result['data']['user_id'];
            $_SESSION['user_name'] = $result['data']['user_name'];
            $_SESSION['user_email'] = $result['data']['user_email'];
            $_SESSION['user_role'] = $result['data']['user_role'];

            header("Location: dashboard.php");
            exit;
        } else {
            $error = $result['message'];
        }
    }
}

$csrf_token = generateCSRFToken();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - Auto Portfolio</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
            
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
</body>
</html>
