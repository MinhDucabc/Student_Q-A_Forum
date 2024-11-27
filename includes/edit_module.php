<?php include '../templates/header.php'; ?>
<?php
require 'db_connection.php'; // Database connection

// Check if the module ID is provided
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch the module from the database
    $stmt = $pdo->prepare("SELECT * FROM modules WHERE id = ?");
    $stmt->execute([$id]);
    $module = $stmt->fetch();

    // Handle case where module is not found
    if (!$module) {
        echo "Module not found.";
        exit;
    }

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

        // If no errors, update the module in the database
        if (empty($errors)) {
            $stmt = $pdo->prepare("UPDATE modules SET module_name = ?, description = ? WHERE id = ?");
            $stmt->execute([$module_name, $description, $id]);
            header('Location: admin.php?view=modules');
            exit;
        }
    }
} else {
    echo "Invalid request.";
    exit;
}

// Variables for the shared form
$formTitle = "Edit Module";
$submitButtonText = "Save Changes";

// Include the shared form template
include '../templates/module.html.php';
?>
<?php include '../templates/footer.php'; ?>
