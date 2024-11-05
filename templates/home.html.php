<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../templates/home_style.css">
</head>
<body>
    <div class="container">
        <div class="post-list">
            <?php $mode = "home"; include "../templates/post_header.php"; ?>
            <?php
            if (!empty($posts)): 
                foreach ($posts as $post): ?>
                    <div class="post-card">
                        <h2 class="post-title">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </h2>
                        <p class="post-content">
                            <?php echo htmlspecialchars(substr($post['content'], 0, 100)) . '...'; ?>
                        </p>
                        <p class="post-meta">
                            By <?php echo htmlspecialchars($post['username']); ?> | <?php echo htmlspecialchars($post['created_at'] ?? 'Unknown date'); ?> |
                            <a href="post.php?mode=edit&id=<?php echo $post['id']; ?>">Edit</a>
                        </p>

                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No posts available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>