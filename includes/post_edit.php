<?php include '../templates/header.php'; ?>
<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'db_connection.php';
include 'fetch_modules.php';

$error_messages = [];
$is_edit = true;  // Flag to indicate this is an "edit" action
$post_id = $_GET['id'] ?? null;
echo $post_id;

$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
$stmt->bindParam(':id', $post_id, PDO::PARAM_INT);
$stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
$stmt->execute();
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    header("Location: home.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $module_id = $_POST['module'] ?? null;  // Make sure module_id is included
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

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['image']['tmp_name']);
        $image_url = $imageData;
    }

    if (empty($error_messages)) {
        $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content, module_id = :module_id, image_url = :image_url WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
        $stmt->bindParam(':module_id', $module_id, PDO::PARAM_INT);  // Bind the module_id for update
        $stmt->bindParam(':image_url', $image_url, PDO::PARAM_LOB);
        $stmt->bindParam(':id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->execute();

        header("Location: home.php");
        exit();
    }
}

// Include shared form template
include '../templates/post.html.php';

?>
<?php include '../templates/footer.php'; ?>