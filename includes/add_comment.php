<?php
include 'db_connection.php';

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set the content type to JSON
header('Content-Type: application/json');

// Buffer the output to catch unexpected HTML
ob_start();

// Get the JSON data from the request body
$data = json_decode(file_get_contents("php://input"), true);

// Extract the data
$post_id = isset($data['post_id']) ? intval($data['post_id']) : null;
$user_id = isset($data['user_id']) ? intval($data['user_id']) : null;
$comment_text = isset($data['content']) ? trim($data['content']) : null;

$response = [];

try {
    // Validate inputs
    if (!$post_id || !$user_id || empty($comment_text)) {
        throw new Exception('Invalid input');
    }

    // Prepare and execute the insert statement
    $stmt = $pdo->prepare("INSERT INTO comments (post_id, user_id, comment_text) VALUES (:post_id, :user_id, :comment_text)");
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':comment_text', $comment_text, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $response = ['status' => 'success'];
    } else {
        throw new Exception('Failed to add comment');
    }
} catch (Exception $e) {
    // Capture any errors
    $response = ['status' => 'error', 'message' => $e->getMessage()];
}

// Check for unexpected output
$unexpectedOutput = ob_get_clean();
if (!empty($unexpectedOutput)) {
    $response['debug'] = $unexpectedOutput;
}

// Send JSON response
echo json_encode($response);
?>
