<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title'] ?? 'Post Details'); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../templates/home_style.css">
</head>
<body>
<div class="container mt-5">
    <?php if ($post): ?>
        <div class="card mb-4">
            <div class="card-body">
                <!-- edit -->
                <?php if (isset($_SESSION['user_id']) && $post['user_id'] == $_SESSION['user_id']): ?>
                                <a href="post_edit.php?id=<?php echo $post['id']; ?>" class="btn btn-primary float-right">Edit</a>
                            <?php endif; ?>
        
                <h2 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                <p class="card-text"><?php echo htmlspecialchars($post['content']); ?></p>
                
                <?php if (!empty($post['image_url'])): ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($post['image_url']); ?>" class="card-img-top mb-3 border border-grey" alt="Post Image">
                <?php endif; ?>

                <p class="text-muted">
                    By <?php echo htmlspecialchars($post['username']); ?> | <?php echo htmlspecialchars($post['created_at'] ?? 'Unknown date'); ?>
                </p>
                <?php if (!empty($post['module_name'])): ?>
                    <p class="text-info">Module: <?php echo htmlspecialchars($post['module_name']); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <div class="comments-section mt-5">
            <h4>Comments</h4>
            <!-- Add New Comment Form -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <form id="addCommentForm" class="mt-3" data-post-id="<?php echo $post['id']; ?>">
                    <!-- Call the JavaScript function with post ID when button is clicked -->
                    <div class="form-group">
                        <textarea class="form-control" id="commentText" rows="3" placeholder="Add a comment..."></textarea>
                    </div>
                    <div class="form-button d-flex justify-content-end">
                        <button type="button" class="btn btn-primary mb-2" onclick="submitComment(<?php echo $post['id']; ?>)">
                            Post Comment
                        </button>
                    </div>
                </form>

            <?php else: ?>
                <p><a href="login.php">Log in</a> to add a comment.</p>
            <?php endif; ?>

            <!-- Display Existing Comments -->
            <div id="commentsList">
                <?php
                if (!empty($comments)):
                    foreach ($comments as $comment): ?>
                        <div class="comment mb-3">
                            <strong><?php echo htmlspecialchars($comment['username']); ?>:</strong>
                            <p><?php echo htmlspecialchars($comment['comment_text']); ?></p>
                            <span class="text-muted"><?php echo $comment['created_at']; ?></span>
                        </div>
                    <?php endforeach;
                else: ?>
                    <p>No comments yet. Be the first to comment!</p>
                <?php endif; ?>
            </div>
        </div>


    <?php else: ?>
        <p class="text-center">Post not found.</p>
    <?php endif; ?>
</div>

<!-- <script src="../js/comments.js"></script> -->
<script>
function submitComment(postId) {
    const commentText = document.getElementById('commentText').value.trim();
    if (!commentText) {
        alert('Please enter a comment');
        return;
    }

    // Data to send to the backend
    const commentData = {
        post_id: postId,
        user_id: <?php echo json_encode($_SESSION['user_id']); ?>, // Get user_id from PHP session
        content: commentText // Ensure this key is named "content" to match the PHP script
    };

    // Send a POST request to add_comment.php
    fetch('add_comment.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(commentData)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        if (data.status === 'success') {
            // Clear the textarea
            document.getElementById('commentText').value = '';
            // Reload comments
            loadComments(postId);
        } else {
            alert('Error adding comment: ' + (data.message || 'Unknown error'));
        }
    })
    .catch(error => console.error('Error:', error));
}



// Function to load comments dynamically
function loadComments(postId) {
    fetch(`get_comments.php?post_id=${postId}`)
        .then(response => response.json())
        .then(comments => {
            const commentsList = document.getElementById('commentsList');
            commentsList.innerHTML = ''; // Clear previous comments

            if (comments.length > 0) {
                comments.forEach(comment => {
                    const commentDiv = document.createElement('div');
                    commentDiv.classList.add('comment', 'mb-3');
                    commentDiv.innerHTML = `
                        <strong>${comment.username}:</strong>
                        <p>${comment.content}</p>
                        <span class="text-muted">${new Date(comment.created_at).toLocaleString()}</span>
                    `;
                    commentsList.appendChild(commentDiv);
                });
            } else {
                commentsList.innerHTML = '<p>No comments yet. Be the first to comment!</p>';
            }
        })
        .catch(error => console.error('Error fetching comments:', error));
}

</script>
</body>
</html>
