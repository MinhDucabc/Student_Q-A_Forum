<?php include '../templates/header.php'; ?>
<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Retrieve user information from session
$user_id = $_SESSION['user_id'];
$email = $_SESSION['email'];


include '../includes/db_connection.php';
// Prepare and bind
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");

// Execute the statement
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$username = $user['username'];
$role = ($user['admin'] == 1) ? 'admin' : 'user';

// Include the profile template
include '../templates/profile.html.php';
?>
<?php include '../templates/footer.php'; ?>
