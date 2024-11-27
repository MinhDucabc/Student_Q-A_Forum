<?php

try {
    // Connect to the database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "beginner_db";

    $dsn = "mysql:host=$servername;dbname=$dbname";
    
    $pdo = new PDO($dsn, $username, $password);

    // echo "Connected successfully"; // Display message if connection is successful
    // Query to fetch all department data
    $sql = 'SELECT * FROM posts';
    $posts = $pdo->query($sql);
    
} catch (PDOException $e) {
    // Error message if connection fails
    $error = "Unable to connect to db server: " . $e->getMessage();
}
?>
