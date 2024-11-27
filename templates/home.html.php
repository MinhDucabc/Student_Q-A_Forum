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
    <!-- Tab Bar for Sorting -->
    <ul class="nav nav-tabs" id="sortTabs">
        <li class="nav-item">
            <a class="nav-link <?php echo ($_GET['sort'] ?? 'upvotes') === 'upvotes' ? 'active' : ''; ?>" href="?sort=upvotes">Highest Upvotes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($_GET['sort'] ?? 'upvotes') === 'created_at' ? 'active' : ''; ?>" href="?sort=created_at">Newest Posts</a>
        </li>
    </ul>

    <div id="postList" class="post-list mt-3">
        <?php $mode = "home"; include "../templates/post_header.php"; ?>
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class="post-card card mb-4 post">
                    <a href="post_detail.php?id=<?php echo $post['id']; ?>" class="text-decoration-none">
                        <div class="card-body">
                            <h2 class="post-title card-title">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </h2>

                            <p class="post-content card-text">
                                <?php echo htmlspecialchars(substr($post['content'], 0, 100)) . '...'; ?>
                            </p>
                            <?php if (!empty($post['image_url'])): ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($post['image_url']); ?>" class="img-thumbnail mr-3" 
                                     style="width: 50px; height: 50px; padding: 0px; border: none;" class="card-img-top mb-3 border border-grey" alt="Post Image">
                            <?php endif; ?>

                            <p class="post-meta text-muted">
                                By <?php echo htmlspecialchars($post['username']); ?> | <?php echo htmlspecialchars($post['created_at'] ?? 'Unknown date'); ?>
                            </p>

                            <?php if (!empty($post['module_name'])): ?>
                                <p class="text-info">Module: <?php echo htmlspecialchars($post['module_name']); ?></p>
                            <?php endif; ?>
                        </div>
                    </a>
                    <!-- Upvote/Downvote System -->
                    <div class="vote-section">
                        <button class="btn btn-success upvote-btn" data-post-id="<?php echo $post['id']; ?>" data-vote-type="upvote" <?php echo $post['user_vote'] === 'upvote' ? 'disabled' : ''; ?>>
                            Upvote (<?php echo $post['upvotes']; ?>)
                        </button>
                        <button class="btn btn-danger downvote-btn" data-post-id="<?php echo $post['id']; ?>" data-vote-type="downvote" <?php echo $post['user_vote'] === 'downvote' ? 'disabled' : ''; ?>>
                            Downvote (<?php echo $post['downvotes']; ?>)
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No posts available.</p>
        <?php endif; ?>
    </div>
</div>
<script src="../js/vote.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

</body>
</html>
