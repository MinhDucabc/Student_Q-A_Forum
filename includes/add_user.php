<?php include '../templates/header.php'; ?>
<?php
require 'db_connection.php'; // Database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);
    $errors = [];

    // Validate inputs
    if (empty($username)) {
        $errors[] = "Username is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    // If no errors, insert the new user into the database
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, admin) VALUES (?, ?, ?, ?)");
        $stmt->execute([$username, $email, $password, $role]);
        header('Location: admin.php?view=users');
        exit;
    }
}

// Variables for the shared form
$formTitle = "Add New User";
$submitButtonText = "Add User";
$includePasswordField = true; // Password is required for adding a new user
$isPasswordRequired = true;

// Include the shared form template
include '../templates/user.html.php';
?>
<?php include '../templates/footer.php'; ?>
