<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create or Edit Post</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style></style>
</head>
<body>
    <h1 class="text-center mt-4"><?php echo $mode; ?></h1>
    <div class="container mt-5">
        <form method="POST" action="../includes/post.php">
            <input type="hidden" name="post_id" value="<?php echo isset($post_id) ? $post_id : '' ?>">

            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" name="content" rows="5" required><?php echo htmlspecialchars($content); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3"></button>
        </form>
    </div>
</body>
</html>
