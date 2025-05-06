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
                    <a href="post_delete.php?id=<?php echo $post['id']; ?>" class="btn btn-danger float-right">Delete</a>
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
                <form action="add_comment.php" method="POST" class="mt-3">
                    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['id']); ?>"> <!-- Hidden input for post ID -->
                    <div class="form-group">
                        <textarea class="form-control" name="comment_text" rows="3" placeholder="Add a comment..." required></textarea>
                    </div>
                    <div class="form-button d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mb-2">Post Comment</button>
                    </div>
                </form>

            <?php else: ?>
                <p><a href="login.php">Log in</a> to add a comment.</p>
            <?php endif; ?>

            <!-- Display Existing Comments -->
            <div id="commentsList">
                <?php
                include '../includes/get_comments.php';
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

</body>
</html>
