<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link rel="stylesheet" href="/assets/css/homepage.css">
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="/public/homepage.php">👨‍💻 My Portfolio</a>
            </div>
            <ul class="nav-menu">
                <li class="nav-item"><a href="#home" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="#about" class="nav-link">About</a></li>
                <li class="nav-item"><a href="#projects" class="nav-link">Projects</a></li>
                <li class="nav-item"><a href="#contact" class="nav-link">Contact</a></li>

                <!-- Admin Link -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a href="/public/dashboard.php" class="nav-link nav-btn-primary">Dashboard</a></li>
                <?php else: ?>
                    <li class="nav-item"><a href="/public/login.php" class="nav-link">Admin Login</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- HERO SECTION -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Hi, I'm <span style="color: #ffd700;">Mukti</span></h1>
            <p>I am a passionate Web Developer crafting beautiful and functional digital experiences. Welcome to my personal portfolio.</p>
            <a href="#projects" class="btn btn-primary btn-lg">View My Work</a>
            <a href="#contact" class="btn btn-secondary btn-lg">Contact Me</a>
        </div>
        <div class="hero-image">
            <div class="placeholder-image" style="border-radius: 50%; width: 300px; height: 300px; background: rgba(255,255,255,0.2);">
                <p>Profile Pic</p>
            </div>
        </div>
    </section>

    <!-- ABOUT & SKILLS SECTION -->
    <section id="about" class="features">
        <h2>About & Skills</h2>
        <p style="text-align: center; max-width: 800px; margin: 0 auto 40px; font-size: 1.1rem; color: #555;">
            I specialize in building responsive, scalable, and dynamic web applications. Here are some of my core technical skills:
        </p>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">💻</div>
                <h3>Frontend Architecture</h3>
                <p>HTML5, CSS3, JavaScript, React, responsive UI design styling.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⚙️</div>
                <h3>Backend Development</h3>
                <p>PHP, Node.js, RESTful web services, and robust server architecture.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🗄️</div>
                <h3>Database Management</h3>
                <p>MySQL, MongoDB, PostgreSQL, and optimising queries.</p>
            </div>
        </div>
    </section>

    <!-- PROJECTS SECTION -->
    <section id="projects" class="gallery">
        <h2>My Recent Projects</h2>
        <div class="gallery-grid">
            <div class="gallery-item">
                <div class="gallery-placeholder">
                    <p>E-commerce Solution</p>
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-placeholder">
                    <p>Task Management App</p>
                </div>
            </div>
            <div class="gallery-item">
                <div class="gallery-placeholder">
                    <p>Blog Platform</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="cta">
        <h2>Get In Touch</h2>
        <p>Interested in working together or have a project in mind? Let's talk!</p>
        <a href="mailto:hello@example.com" class="btn btn-primary btn-lg">Email Me</a>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="footer-bottom" style="border-top: none; padding-top: 0;">
            <p>&copy; 2026 Mukti's Portfolio. All rights reserved.</p>
        </div>
    </footer>

    <script src="/assets/js/navbar.js"></script>
</body>
</html>
