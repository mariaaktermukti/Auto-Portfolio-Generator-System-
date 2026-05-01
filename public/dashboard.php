<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Auto Portfolio</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Dashboard Layout Styles */
        body { margin: 0; font-family: Arial, sans-serif; display: flex; background: #f4f7f6; }
        .sidebar { width: 250px; background: #2c3e50; color: #fff; min-height: 100vh; padding-top: 20px; }
        .sidebar h2 { text-align: center; margin-bottom: 30px; font-size: 22px; }
        .nav-menu { list-style: none; padding: 0; margin: 0; }
        .nav-menu li { border-bottom: 1px solid #34495e; }
        .nav-menu a { color: #ecf0f1; text-decoration: none; display: block; padding: 15px 20px; transition: 0.3s; }
        .nav-menu a:hover, .nav-menu a.active { background: #34495e; padding-left: 25px; }
        
        .main-content { flex: 1; display: flex; flex-direction: column; }
        .topbar { background: #fff; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .topbar h3 { margin: 0; color: #333; }
        .btn-logout { background: #e74c3c; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; transition: 0.3s; }
        .btn-logout:hover { background: #c0392b; }
        
        .content-area { padding: 30px; }
        .welcome-card { background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); margin-bottom: 30px; }
        
        /* Dashboard Grid */
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; }
        .stat-card { background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); text-align: center; border-left: 4px solid #3498db; }
        .stat-card h4 { margin: 0 0 10px 0; color: #7f8c8d; }
        .stat-card p { margin: 0; font-size: 24px; font-weight: bold; color: #2c3e50; }
    </style>
</head>
<body>

    <!-- Sidebar Navigation -->
    <div class="sidebar">
        <h2>Portfolio Gen</h2>
        <ul class="nav-menu">
            <li><a href="dashboard.php" class="active">🏠 Dashboard</a></li>
            <li><a href="?section=about">👤 About Me</a></li>
            <li><a href="?section=education">🎓 Education</a></li>
            <li><a href="?section=experience">💼 Work Experience</a></li>
            <li><a href="?section=skills">⚡ Skills</a></li>
            <li><a href="?section=projects">🚀 Projects</a></li>
            <li><a href="?section=achievements">🏆 Achievements</a></li>
            <li><a href="?section=reviews">⭐ Reviews</a></li>
            <li><a href="?section=contact">📞 Contact</a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar">
            <h3>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h3>
            <a href="logout.php" class="btn-logout">Logout</a>
        </div>

        <!-- Dynamic Content Area -->
        <div class="content-area">
            <?php
            // Include database connection to make it available to included pages
            require_once '../config/config.php';

            $section = $_GET['section'] ?? 'dashboard';

            if ($section === 'dashboard') {
                echo '
                <div class="welcome-card">
                    <h2>Your Portfolio Overview</h2>
                    <p>Manage all your sections from the sidebar. Keep your portfolio updated to attract more opportunities!</p>
                </div>
                <div class="dashboard-grid">
                    <div class="stat-card"><h4>Education</h4><p>1 Entry</p></div>
                    <div class="stat-card"><h4>Skills</h4><p>3 Entries</p></div>
                    <div class="stat-card"><h4>Projects</h4><p>2 Entries</p></div>
                    <div class="stat-card"><h4>Profile Views</h4><p>0</p></div>
                </div>';
            } elseif ($section === 'about') {
                // Include the new About page logic and HTML
                include 'about.php';
            } else {
                echo '<div class="welcome-card">';
                echo '<h2>' . htmlspecialchars(ucwords(str_replace('_', ' ', $section))) . ' Management</h2>';
                echo '<p>This section is under construction. You will be able to add, edit, and delete your ' . htmlspecialchars($section) . ' data here!</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

</body>
</html>
