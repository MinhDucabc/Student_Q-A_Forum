<?php include '../templates/header.php'; ?>
<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Retrieve user information from session
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
$email = $_SESSION['email'];

// Include the profile template
include '../templates/profile.html.php';
?>
<?php include '../templates/footer.php'; ?>
