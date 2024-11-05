<?php $title = "home"; include '../templates/header.php'; ?>
<?php
include '../includes/db_connection.php'; // Include the database connection file
try {
    $sql = 'SELECT posts.id, content, title, username, DATE(created_at) FROM posts INNER JOIN users ON user_id = users.id';
    $posts = $pdo->query($sql);
    // $sql = 'SELECT questions.id, question, title, author_id, author_name FROM questions INNER JOIN authors ON authorid = authors.author_id';
    // $posts = $pdo->query($sql);

    if ($posts) {
        $posts = $posts->fetchAll(PDO::FETCH_ASSOC); 
        // var_dump($posts);
    } else {
        $posts = [];

    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    $posts = [];
}
include '../templates/home.html.php';
?>
<?php include '../templates/footer.php'; ?>
