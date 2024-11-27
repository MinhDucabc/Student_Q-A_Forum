<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <?php if ($mode == 'home'): ?>
        <div class="header d-flex justify-content-between align-items-center">
            <h1 class="display-4">Latest Posts</h1>
            <a href="../includes/<?php echo (isset($_SESSION['user_id'])) ? "post_create.php" : "login.php"; ?>" 
               class="btn btn-primary">Create Post</a>
        </div>
      
        <form method="get" action="home.php" class="w-100 d-flex mb-2 mt-4">
            <input type="text" name="search_query" class="form-control mr-2" placeholder="Search..." value="<?php echo isset($search_query) ? htmlspecialchars($search_query) : ''; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

    <?php else: ?>
        <div class="header">
            <a href="../includes/index.php" class="btn btn-secondary">Return to Home</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
