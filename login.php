<?php
// ============================================================
// login.php
// Student login page.
// Validates credentials, creates session on success.
// ============================================================

session_start();

// Redirect already-logged-in users
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

require_once 'config/database.php';

$error = '';

// -----------------------------------------------------------
// Handle POST submission
// -----------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');

    // Basic validation
    if (empty($email) || empty($password)) {
        $error = "Please enter both email and password.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Please enter a valid email address.";
    } else {
        // Fetch user by email (prepared statement - prevents SQL injection)
        $stmt = $pdo->prepare("SELECT id, name, email, password FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            // Credentials valid - regenerate session ID to prevent fixation
            session_regenerate_id(true);

            // Store user info in session
            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email']= $user['email'];

            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid email or password. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Tanush Academy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">

        <!-- Logo / Branding -->
        <div class="auth-logo">
            <div style="font-size:2.5rem; margin-bottom:0.5rem;">🎓</div>
            <h2>Tanush Academy</h2>
            <p>Sign in to your student account</p>
        </div>

        <!-- Error Message -->
        <?php if ($error): ?>
            <div class="alert-custom alert-error mb-3">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <!-- Login Form -->
        <form method="POST" action="login.php" novalidate>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control"
                       placeholder="you@example.com"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       required autofocus>
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control"
                       placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn-primary-custom">
                <i class="bi bi-box-arrow-in-right me-2"></i>Login
            </button>
        </form>

        <!-- Register Link -->
        <p class="text-center mt-3 mb-0" style="font-size:0.9rem; color:#546E7A;">
            Don't have an account?
            <a href="register.php" style="color:#1565C0; font-weight:600;">Register here</a>
        </p>
        <p class="text-center mt-2" style="font-size:0.85rem;">
            <a href="index.php" style="color:#78909C;">← Back to Home</a>
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
