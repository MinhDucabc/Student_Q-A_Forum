<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($isEdit) ? 'Edit Post' : 'Create Post'; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><?= $is_edit ? 'Edit Your Post' : 'Create a New Post'; ?></h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php echo $is_edit ? 'post_edit.php?id=' . $post['id'] : 'post_create.php'; ?>" method="POST" enctype="multipart/form-data" novalidate>
                            <div class="form-group">
                                <label for="title">Post Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="<?php echo isset($post['title']) ? htmlspecialchars($post['title']) : ''; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="content">Post Content</label>
                                <textarea name="content" id="content" rows="5" class="form-control" required><?php echo isset($post['content']) ? htmlspecialchars($post['content']) : ''; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="module">Module</label>
                                <select name="module" id="module" class="form-control" required>
                                    <?php foreach ($modules as $module): ?>
                                        <option value="<?php echo $module['id']; ?>" <?php echo isset($post['module_id']) && $post['module_id'] == $module['id'] ? 'selected' : ''; ?>>
                                            <?php echo htmlspecialchars($module['module_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" id="image" class="form-control-file" >
                            </div>

                            <?php if (!empty($error_messages)): ?>
                                <?php foreach ($error_messages as $error_message): ?>
                                    <p style="color:red;"><?= htmlspecialchars($error_message); ?></p>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            <div class="form-group text-center mt-4">
                                <button type="submit" class="btn btn-success">
                                    <?php echo $is_edit ? 'Update Post' : 'Create Post'; ?>
                                </button>
                                <a href="home.php" class="btn btn-secondary ml-2">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
