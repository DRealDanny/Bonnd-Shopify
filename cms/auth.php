<?php
session_start();

// Hardcoded credentials for MVP
$valid_username = 'Bonnd123';
$valid_password = 'Bonnd@123';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $valid_username && $password === $valid_password) {
        // Success: Set session and redirect to dashboard
        $_SESSION['logged_in'] = true;
        $_SESSION['user'] = 'Admin';
        header("Location: dashboard.php");
        exit;
    } else {
        // Failed: Send back to login with an error flag
        // Note: You can add PHP logic in login.php later to show an error message if ?error=1
        header("Location: login.php?error=1");
        exit;
    }
} else {
    // If someone tries to access auth.php directly, kick them back
    header("Location: login.php");
    exit;
}
?>