<?php
include 'db_connection.php'; // Include your database connection file

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    // Create a delete query
    $query = "DELETE FROM posts WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(1, $post_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Redirect to home page after deletion
        header("Location: home.php");
        exit();
    } else {
        echo "Error deleting post.";
    }

    $stmt->close();
} else {
    echo "No post ID provided.";
}
?>