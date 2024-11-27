<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $postId = $data['postId'];
    $voteType = $data['voteType'];
    $userId = $_SESSION['user_id'] ?? null;

    if (!$userId) {
        echo json_encode(['success' => false, 'redirect' => 'login.php', 'message' => 'Please log in to vote.']);
        exit;

    }

    try {
        // Check if the user already voted on this post
        $stmt = $pdo->prepare('SELECT * FROM post_votes WHERE post_id = :postId AND user_id = :userId');
        $stmt->execute(['postId' => $postId, 'userId' => $userId]);
        $existingVote = $stmt->fetch();

        if ($existingVote) {
            // If the vote type is different, update the vote
            if ($existingVote['vote_type'] !== $voteType) {
                $updateStmt = $pdo->prepare('UPDATE post_votes SET vote_type = :voteType WHERE post_id = :postId AND user_id = :userId');
                $updateStmt->execute(['voteType' => $voteType, 'postId' => $postId, 'userId' => $userId]);
            }
        } else {
            // Insert a new vote
            $insertStmt = $pdo->prepare('INSERT INTO post_votes (post_id, user_id, vote_type) VALUES (:postId, :userId, :voteType)');
            $insertStmt->execute(['postId' => $postId, 'userId' => $userId, 'voteType' => $voteType]);
        }

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
}
?>
