<?php
// Include the database connection file
include 'database_connection.php';
try{
    // Fetch posts from the database
    $query = "SELECT * FROM posts";
    $posts = $pdo->query($query);
    ob_start();
    include '../templates/home.html.php';
    $output = ob_get_clean();
} catch (PDOException $e) {
    // Error message if connection fails
    $titles = 'An error has occurred';
    $error = "Unable to connect to db server: " . $e->getMessage();
}
include '../templates/layout.html.php';

// Close the database connection
mysqli_close($conn);
?>