<?php include '../templates/header.php'; ?>

<?php
// Enable error reporting for debugging (uncomment if needed)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Start the session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include the database connection
include '../includes/db_connection.php';

// Initialize variables
$post = [];
$comments = [];
$user_id = $_SESSION['user_id'] ?? null;

// Get the post ID from the query string
$post_id = $_GET['id'] ?? null;

if ($post_id) {
    try {
        // Fetch post details
        $postQuery = 'SELECT posts.id, posts.title, posts.content, posts.image_url, posts.user_id, users.username, 
                      DATE(posts.created_at) AS created_at, modules.module_name
                      FROM posts
                      LEFT JOIN users ON posts.user_id = users.id
                      LEFT JOIN modules ON posts.module_id = modules.id
                      WHERE posts.id = :post_id';
        
        // Prepare and execute the post query
        $postStmt = $pdo->prepare($postQuery);
        $postStmt->execute(['post_id' => $post_id]);
        $post = $postStmt->fetch(PDO::FETCH_ASSOC);

        // Check if the post exists
        if (!$post) {
            echo '<p class="text-center">Post not found.</p>';
            exit;
        }

        // Fetch comments
        $commentQuery = 'SELECT comments.id, comments.comment_text, comments.created_at, users.username
                         FROM comments
                         LEFT JOIN users ON comments.user_id = users.id
                         WHERE comments.post_id = :post_id
                         ORDER BY comments.created_at DESC';
        
        // Prepare and execute the comments query
        $commentStmt = $pdo->prepare($commentQuery);
        $commentStmt->execute(['post_id' => $post_id]);
        $comments = $commentStmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Include the template file
include '../templates/post_detail.html.php';
?>

<?php include '../templates/footer.php'; ?>
