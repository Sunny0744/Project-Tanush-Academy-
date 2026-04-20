<?php
// ============================================================
// logout.php
// Destroys the current session and redirects to login page.
// ============================================================

session_start();

// Unset all session variables
$_SESSION = [];

// Destroy the session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to login
header("Location: login.php");
exit();
