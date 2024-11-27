<?php 
$title = "home"; 
include '../templates/header.php'; 
?>
<?php
include '../includes/db_connection.php'; // Include the database connection file
    
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $userId = $_SESSION['user_id'] ?? null; // Get the current user's ID if logged in

    // Default sorting option (upvotes)
    $sortBy = $_GET['sort'] ?? 'upvotes'; // Get the sorting parameter from the query string

    // Default SQL query (without WHERE clause filtering)
    $sql = 'SELECT posts.id, posts.title, posts.content, posts.image_url, posts.user_id, DATE(posts.created_at) AS created_at, 
                users.username,  
                modules.module_name,
                
                -- Count total upvotes and downvotes
                SUM(CASE WHEN post_votes.vote_type = "upvote" THEN 1 ELSE 0 END) AS upvotes,
                SUM(CASE WHEN post_votes.vote_type = "downvote" THEN 1 ELSE 0 END) AS downvotes,

                -- Check if the current user has already voted on this post
                MAX(CASE WHEN post_votes.user_id = :userId THEN post_votes.vote_type ELSE NULL END) AS user_vote
            FROM posts
            LEFT JOIN users ON posts.user_id = users.id
            LEFT JOIN modules ON posts.module_id = modules.id
            LEFT JOIN post_votes ON posts.id = post_votes.post_id';

    // Add the WHERE clause only if a search query is present
    if (isset($_GET['search_query']) && !empty($_GET['search_query'])) {
        $search_query = $_GET['search_query'];
        $sql .= ' WHERE title LIKE :search_query OR content LIKE :search_query';
    } else {
        $search_query = ''; // Set to an empty string if no query is provided
    }

    // Sorting logic based on the selected tab
    if ($sortBy === 'upvotes') {
        $sql .= ' GROUP BY posts.id
                  ORDER BY upvotes DESC, posts.created_at DESC'; // Sort by upvotes first, then by created_at if upvotes are equal
    } else {
        $sql .= ' GROUP BY posts.id
                  ORDER BY posts.created_at DESC'; // Sort by created_at
    }

    $stmt = $pdo->prepare($sql);

    // Execute the query, binding the parameters
    if (!empty($search_query)) {
        $stmt->execute(['search_query' => "%$search_query%", 'userId' => $userId]);
    } else {
        $stmt->execute(['userId' => $userId]); // Execute without search query
    }

    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    $posts = [];
}

include '../templates/home.html.php';
include '../includes/vote.php'; // Include the vote processing file
?>
<?php
include '../templates/footer.php';
?>
