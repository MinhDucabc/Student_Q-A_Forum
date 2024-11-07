<?php include '../templates/header.php'; ?>

<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connection.php';

$error_messages = [];
$is_edit = false;  // Flag to indicate this is a "create" action
$modules = []; // Array to store module options

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $module_id = $_POST['module'] ?? null;
    $user_id = $_SESSION['user_id'] ?? null;
    $image_url = null;

    if (empty($title)) {
        $error_messages[] = "Title is required.";
    }
    if (empty($content)) {
        $error_messages[] = "Content is required.";
    }
    if (empty($module_id)) {
        $error_messages[] = "Module is required.";
    }

    // Handle file upload if image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $image_url = $imageData;  // Store the binary image data for the image_url field
    }

    if (empty($error_messages) && $user_id) {
        // Insert post into the database
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id, module_id, image_url, created_at) VALUES (:title, :content, :user_id, :module_id, :image_url, NOW())");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':module_id', $module_id, PDO::PARAM_INT);
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_LOB); // Store image data as a blob
        $stmt->execute();

        header("Location: home.php");
        exit();
    }
}

// Include the shared form template
include '../includes/fetch_modules.php';
include '../templates/post.html.php';
?>

<?php include '../templates/footer.php'; ?>
