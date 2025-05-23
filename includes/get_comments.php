<?php
// Include the database connection
include 'db_connection.php';

// Get the post ID from the query parameter
$post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : null;


if ($post_id) {
    try {
        // Prepare the SQL query to fetch comments
        $stmt = $pdo->prepare(
            "SELECT comments.id, comments.comment_text, comments.created_at, users.username 
             FROM comments 
             LEFT JOIN users ON comments.user_id = users.id 
             WHERE comments.post_id = :post_id 
             ORDER BY comments.created_at DESC"
        );

        // Execute the query with the post ID parameter
        $stmt->execute(['post_id' => $post_id]);

        // Fetch all comments as an associative array
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // If an error occurs, output the error message
        echo $e->getMessage();
    }
}


?>
