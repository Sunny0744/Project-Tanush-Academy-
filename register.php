<?php
// ============================================================
// register.php
// New student registration page.
// Validates input, hashes password, inserts user record.
// ============================================================

session_start();

// Redirect already-logged-in users
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

require_once 'config/database.php';

$errors  = [];
$success = '';

// -----------------------------------------------------------
// Handle POST submission
// -----------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve and sanitize inputs
    $name     = trim($_POST['name']     ?? '');
    $email    = trim($_POST['email']    ?? '');
    $password = trim($_POST['password'] ?? '');
    $confirm  = trim($_POST['confirm']  ?? '');

    // ------ Validation ------
    if (empty($name)) {
        $errors[] = "Full name is required.";
    } elseif (strlen($name) < 2 || strlen($name) > 100) {
        $errors[] = "Name must be between 2 and 100 characters.";
    }

    if (empty($email)) {
        $errors[] = "Email address is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email address.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    // Check if email already exists (prepared statement)
    if (empty($errors)) {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch()) {
            $errors[] = "An account with this email already exists.";
        }
    }

    // ------ Insert new user ------
    if (empty($errors)) {
        // Hash the password using bcrypt (PASSWORD_DEFAULT = bcrypt)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)"
        );
        $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':password' => $hashedPassword,
        ]);

        $success = "Registration successful! You can now <a href='login.php'>login here</a>.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Tanush Academy</title>
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
            <p>Create your free student account</p>
        </div>

        <!-- Error Messages -->
        <?php if (!empty($errors)): ?>
            <div class="alert-custom alert-error mb-3">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                <?php foreach ($errors as $err): ?>
                    <div><?= htmlspecialchars($err) ?></div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Success Message -->
        <?php if ($success): ?>
            <div class="alert-custom alert-success mb-3">
                <i class="bi bi-check-circle-fill me-1"></i>
                <?= $success ?>
            </div>
        <?php endif; ?>

        <!-- Registration Form -->
        <?php if (!$success): ?>
        <form method="POST" action="register.php" novalidate>

            <!-- Full Name -->
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" id="name" name="name" class="form-control"
                       placeholder="Your full name"
                       value="<?= htmlspecialchars($_POST['name'] ?? '') ?>"
                       required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-control"
                       placeholder="you@example.com"
                       value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                       required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control"
                       placeholder="Minimum 6 characters" required>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="confirm" class="form-label">Confirm Password</label>
                <input type="password" id="confirm" name="confirm" class="form-control"
                       placeholder="Re-enter password" required>
            </div>

            <button type="submit" class="btn-primary-custom">
                <i class="bi bi-person-plus-fill me-2"></i>Create Account
            </button>
        </form>
        <?php endif; ?>

        <!-- Login Link -->
        <p class="text-center mt-3 mb-0" style="font-size:0.9rem; color:#546E7A;">
            Already have an account?
            <a href="login.php" style="color:#1565C0; font-weight:600;">Login here</a>
        </p>
        <p class="text-center mt-2" style="font-size:0.85rem;">
            <a href="index.php" style="color:#78909C;">← Back to Home</a>
        </p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
