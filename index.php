<?php
// ============================================================
// index.php
// Public homepage - shown to visitors who are not logged in.
// Redirects logged-in users directly to the dashboard.
// ============================================================

session_start();

// Already logged in? Go straight to dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanush Academy - Learn, Grow, Succeed</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- ====== Public Navbar ====== -->
<nav class="navbar navbar-expand-lg navbar-tanush">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="bi bi-mortarboard-fill me-2"></i>Tanush <span>Academy</span>
        </a>
        <div class="ms-auto d-flex gap-2">
            <a href="login.php"    class="btn-logout">Login</a>
            <a href="register.php" class="btn btn-light btn-sm fw-bold px-3">Register</a>
        </div>
    </div>
</nav>

<!-- ====== Hero Section ====== -->
<section class="hero-section">
    <div class="container">
        <h1>Welcome to Tanush Academy</h1>
        <p>Your complete online learning platform for Government Exam Preparation, Computer Courses, and Shorthand Practice. Study smarter, not harder.</p>
        <a href="register.php" class="hero-btn">Get Started Free</a>
        <a href="login.php"    class="hero-btn hero-btn-outline">Login</a>
    </div>
</section>

<!-- ====== Features Section ====== -->
<section class="features-section">
    <div class="container">
        <h2>What We Offer</h2>
        <div class="row g-4">
            <!-- Govt Exams -->
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon">🏛️</div>
                    <h5>Government Exam Prep</h5>
                    <p>Comprehensive study material for UPSC, SSC, Banking, and Railway examinations prepared by experts.</p>
                </div>
            </div>
            <!-- Computer Courses -->
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon">💻</div>
                    <h5>Computer Courses</h5>
                    <p>Learn Basic Computer, MS Office, Web Development (HTML, CSS, JS) from beginner to advanced level.</p>
                </div>
            </div>
            <!-- Shorthand -->
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon">✍️</div>
                    <h5>Shorthand Practice</h5>
                    <p>Master Pitman Shorthand with structured lessons, speed exercises, and practice dictation passages.</p>
                </div>
            </div>
            <!-- Notes -->
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon">📄</div>
                    <h5>Downloadable Notes</h5>
                    <p>Access and download high-quality study notes and PDF materials across all courses anytime.</p>
                </div>
            </div>
            <!-- Expert Teachers -->
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon">👩‍🏫</div>
                    <h5>Expert Teachers</h5>
                    <p>Content curated and verified by experienced educators with years of exam coaching expertise.</p>
                </div>
            </div>
            <!-- Free Access -->
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="icon">🎓</div>
                    <h5>Free Registration</h5>
                    <p>Create your free student account in seconds and instantly access all available study materials.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ====== CTA Section ====== -->
<section style="background: #E3F2FD; padding: 4rem 1rem; text-align:center;">
    <div class="container">
        <h2 style="color:#1565C0; font-weight:700; margin-bottom:1rem;">Ready to Start Learning?</h2>
        <p style="color:#546E7A; max-width:500px; margin:0 auto 2rem;">Join thousands of students preparing for their dream careers through Tanush Academy.</p>
        <a href="register.php" class="hero-btn" style="display:inline-block;">Create Free Account</a>
    </div>
</section>

<!-- ====== Footer ====== -->
<footer class="site-footer">
    <p>&copy; <?= date('Y') ?> Tanush Academy. All rights reserved. | Built with ❤️ for students.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
