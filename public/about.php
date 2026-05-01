<?php
// Ensure this file is only included within dashboard.php
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$success_msg = '';
$error_msg = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_about'])) {
    // Validate CSRF if you implement it here, but keeping it simple for now
    $about_me = trim($_POST['about_me']);
    
    $stmt = $conn->prepare("UPDATE users SET about_me = ? WHERE id = ?");
    
    if ($stmt) {
        $stmt->bind_param("si", $about_me, $user_id);
        if ($stmt->execute()) {
            $success_msg = "Your About Me description was updated successfully!";
        } else {
            $error_msg = "Error updating description: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $error_msg = "Database error: " . $conn->error;
    }
}

// Fetch current about_me description to populate the form
$current_about = '';
$stmt = $conn->prepare("SELECT about_me FROM users WHERE id = ?");
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($current_about);
    $stmt->fetch();
    $stmt->close();
}
?>

<div class="welcome-card">
    <h3 style="font-weight: 600; color: #2c3e50; margin-top: 0;">About me</h3>
    <p style="color: #555; margin-bottom: 20px; font-weight: normal;">Get to know me and my journey</p>
    
    <?php if (!empty($success_msg)): ?>
        <div style="background: #d4edda; color: #27ae60; padding: 10px; margin-bottom: 15px; border-radius: 4px; border-left: 5px solid #2ecc71;">
            <?php echo $success_msg; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error_msg)): ?>
        <div style="background: #f8d7da; color: #c0392b; padding: 10px; margin-bottom: 15px; border-radius: 4px; border-left: 5px solid #e74c3c;">
            <?php echo $error_msg; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="dashboard.php?section=about">
        <textarea 
            name="about_me" 
            id="about_me" 
            rows="8" 
            placeholder="Hi, I am an enthusiastic developer..."
            style="width: 100%; margin-top: 10px; padding: 15px; border-radius: 6px; border: 1px solid #bdc3c7; font-family: inherit; font-size: 14px; resize: vertical;"
        ><?php echo htmlspecialchars($current_about ?? ''); ?></textarea>
        
        <button type="submit" name="update_about" style="margin-top: 15px; padding: 10px 25px; background: #3498db; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; transition: 0.3s;">
            Save Changes
        </button>
    </form>
</div>