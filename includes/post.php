<?php $title = "home"; include '../templates/header.php'; ?>
<?php
include '../includes/db_connection.php'; // Include the database connection file

// Initialize variables
$post_id = (isset($_GET['id']) && !empty($_GET['id'])) ? $_GET['id'] : '';
$mode = $_GET['mode'];

// Fetch post data if post id is available
if ($post_id) {
    $sql = "SELECT * FROM posts WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $post_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    $title = $post['title'];
    $content = $post['content'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($title) || empty($content)) {
            throw new Exception('Title and content cannot be empty.');
        }
        $sql = "UPDATE posts SET title = :title, content = :content WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['title' => $title, 'content' => $content, 'id' => $post_id]);
        header('Location: index.php');
}

// allow for editing of post

} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($title) || empty($content)) {
            throw new Exception('Title and content cannot be empty.');
        }
    $sql = "INSERT INTO posts (title, content) VALUES (:title, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $title, 'content' => $content]);
    header('Location: index.php');
    }
}

 include "../templates/post_header.php";  
 include '../templates/post.html.php'; ?>
<?php include '../templates/footer.php'; ?>