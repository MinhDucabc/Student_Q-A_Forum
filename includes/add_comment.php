<?php
require 'db_connection.php'; // Include database connection and session start

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $post_id = intval($_POST['post_id']);
    $comment_text = trim($_POST['comment_text']);

    // Validate input
    if (empty($comment_text)) {
        $_SESSION['error_message'] = 'Comment cannot be empty.';
        header("Location: post_detail.php?id=$post_id");
        exit;
    }

    // Insert comment into the database
    try {
        $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, comment_text, created_at) VALUES (?, ?, ?, NOW())");
        $stmt->execute([$post_id, $_SESSION['user_id'], $comment_text]);

        // Redirect back to the post page with success message
        $_SESSION['success_message'] = 'Comment added successfully.';
        header("Location: post_detail.php?id=$post_id");
    } catch (PDOException $e) {
        // Handle database errors
        $_SESSION['error_message'] = 'Failed to add comment. Please try again.';
        header("Location: post_detail.php?id=$post_id");
    }
}
