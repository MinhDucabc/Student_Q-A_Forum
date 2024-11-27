<?php
header('Content-Type: application/json');
$conn = new mysqli('localhost', 'root', '', 'comment_system');

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Determine the action (fetch or add)
$action = $_GET['action'] ?? '';

if ($action === 'add') {
    // Add a new comment
    $data = json_decode(file_get_contents('php://input'), true);
    $username = $data['username'];
    $comment = $data['comment'];

    if ($username && $comment) {
        $stmt = $conn->prepare("INSERT INTO comments (username, comment) VALUES (?, ?)");
        $stmt->bind_param('ss', $username, $comment);
        $stmt->execute();
        echo json_encode(['success' => true]);
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid input']);
    }
} else {
    // Fetch all comments
    $result = $conn->query("SELECT * FROM comments ORDER BY created_at DESC");
    $comments = [];
    while ($row = $result->fetch_assoc()) {
        $comments[] = $row;
    }
    echo json_encode($comments);
}

$conn->close();
?>
