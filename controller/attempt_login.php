<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start the session without any output before session_start
session_start();

// Check if the user is not logged in or the session has timed out
if (!isset($_SESSION["email"]) || (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800))) {
    // Store the current page URL in the session
    $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
    
    // Redirect to the login page
    header("Location: login.php");
    exit();
}

// Clear the redirect URL after using it
if (isset($_SESSION['redirect_url'])) {
    unset($_SESSION['redirect_url']);
}

// Update last activity timestamp
$_SESSION['last_activity'] = time();
?>
