<?php include '../templates/header.php'; ?>
<?php
require 'db_connection.php'; // Include your database connection or configuration file

// Check if the user ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the user from the database
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();

    // Handle case where user is not found
    if (!$user) {
        echo "User not found.";
        exit;
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $role = trim($_POST['role']);
        $errors = [];

        // Validate inputs
        if (empty($username)) {
            $errors[] = "Username is required.";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "A valid email is required.";
        }

        // If no errors, update the user in the database
        if (empty($errors)) {
            $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, admin = ? WHERE id = ?");
            $stmt->execute([$username, $email, $role, $id]);
            header('Location: admin.php?view=users');
            exit;
        }
    }
} else {
    echo "Invalid request.";
    exit;
}

// Variables for the shared form
$formTitle = "Edit User";
$submitButtonText = "Save Changes";
$includePasswordField = false; // Password is not required for editing

// Include the shared form template
include '../templates/user.html.php';
?>
<?php include '../templates/footer.php'; ?>
