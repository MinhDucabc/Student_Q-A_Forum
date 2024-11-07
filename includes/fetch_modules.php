<?php
// fetch_categories.php
include 'db_connection.php';

try {
    // Query to fetch categories
    $sql2 = "SELECT * FROM modules";
    $modules = $pdo->query($sql2);

    if (!$modules) {
        die("Query failed: " . $pdo->errorInfo());
}
    
    } catch (PDOException $e) {
        // Error message if connection fails
        $error = "Unable to connect to db server: " . $e->getMessage();
    }
?>
