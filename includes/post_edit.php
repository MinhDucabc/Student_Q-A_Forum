<?php include '../templates/header.php'; ?>
<?php
session_start();
include 'db_connection.php';

$error_messages = [];
$is_edit = true;  // Flag to indicate this is an "edit" action
$post_id = $_GET['id'] ?? null;

if (!$post_id) {
    header("Location: home.php");
    exit();
}

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

    if (empty($title)) {
        $error_messages[] = "Title is required.";
    }
    if (empty($content)) {
        $error_messages[] = "Content is required.";
    }

    if (empty($error_messages)) {
        $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id AND user_id = :user_id");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':content', $content, PDO::PARAM_STR);
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