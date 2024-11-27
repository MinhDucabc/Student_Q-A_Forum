<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2><?php echo htmlspecialchars($formTitle); ?></h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <div class="mb-3">
            <label for="module_name" class="form-label">Module Name</label>
            <input 
                type="text" 
                id="module_name" 
                name="module_name" 
                class="form-control" 
                value="<?php echo htmlspecialchars($module['module_name'] ?? ''); ?>" 
                required
            >
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea 
                id="description" 
                name="description" 
                class="form-control" 
                rows="4"
                required
            ><?php echo htmlspecialchars($module['description'] ?? ''); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary"><?php echo htmlspecialchars($submitButtonText); ?></button>
        <a href="admin.php?view=modules" class="btn btn-secondary">Cancel</a>
    </form>
</div>

</body>
</html>