<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../templates/home_style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="post-list">
            <?php $mode = "home"; include "../templates/post_header.php"; ?>
            <?php if (!empty($posts)): ?>
                <?php foreach ($posts as $post): ?>
                    <div class="post-card card mb-4">
                        <div class="card-body">
                            <?php if (!empty($post['image_url'])): ?>
                                <img src="<?php echo htmlspecialchars($post['image_url']); ?>" class="card-img-top mb-3" alt="Post Image">
                            <?php endif; ?>
                            <h2 class="post-title card-title">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </h2>
                            <p class="post-content card-text">
                                <?php echo htmlspecialchars(substr($post['content'], 0, 100)) . '...'; ?>
                            </p>
                            <p class="post-meta text-muted">
                                By <?php echo htmlspecialchars($post['username']); ?> | <?php echo htmlspecialchars($post['created_at'] ?? 'Unknown date'); ?>
                            </p>
                            <?php if (!empty($post['module_name'])): ?>
                                <p class="text-info">Module: <?php echo htmlspecialchars($post['module_name']); ?></p>
                            <?php endif; ?>
                            <a href="post_edit.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Edit</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">No posts available.</p>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
