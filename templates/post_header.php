<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php if ($mode == 'home'): ?>
    <div class="header">
        <h1>Latest Posts</h1>
        <a href="../includes/post.php?mode=create" class="btn btn-create">Create</a>
    </div>
<?php else: ?>
    <div class="header">
        <a href="../includes/index.php" class="btn btn-return">Return</a>
    </div>
<?php endif; ?>

</body>
</html>
<?php 
