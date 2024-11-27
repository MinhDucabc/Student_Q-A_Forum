<?php include '../templates/header.php'; ?>
<?php
require 'db_connection.php'; // Database connection

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $module_name = trim($_POST['module_name']);
    $description = trim($_POST['description']);
    $errors = [];

    // Validate inputs
    if (empty($module_name)) {
        $errors[] = "Module name is required.";
    }
    if (empty($description)) {
        $errors[] = "Description is required.";
    }

    // If no errors, insert the new module into the database
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO modules (module_name, description) VALUES (?, ?)");
        $stmt->execute([$module_name, $description]);
        header('Location: index.php?view=modules');
        exit;
    }
}

// Variables for the shared form
$formTitle = "Add New Module";
$submitButtonText = "Add Module";

// Include the shared form template
include '../templates/module.html.php';
?>
<?php include '../templates/footer.php'; ?>
