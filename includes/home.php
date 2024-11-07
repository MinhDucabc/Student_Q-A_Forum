<?php $title = "home"; include '../templates/header.php'; ?>
<?php
include '../includes/db_connection.php'; // Include the database connection file

try {
    $sql = 'SELECT posts.id, posts.title, posts.content, posts.image_url, users.username,  DATE(posts.created_at) AS created_at, 
            modules.module_name
            FROM posts 
            LEFT JOIN users ON posts.user_id = users.id 
            LEFT JOIN modules ON posts.module_id = modules.id';

    $posts = $pdo->query($sql);

    if ($posts) {
        $posts = $posts->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $posts = [];
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    $posts = [];
}

include '../templates/home.html.php';
?>
<?php
include '../templates/footer.php';
?>
