<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Admin Panel UI with Navbar -->
<div class="container mt-5">
    <h1>Admin Panel</h1>
    
    <!-- Navbar for switching between Posts, Users, and Modules -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item <?php echo $view == 'posts' ? 'active' : ''; ?>">
                    <a class="nav-link" href="?view=posts">Posts</a>
                </li>
                <li class="nav-item <?php echo $view == 'users' ? 'active' : ''; ?>">
                    <a class="nav-link" href="?view=users">Users</a>
                </li>
                <li class="nav-item <?php echo $view == 'modules' ? 'active' : ''; ?>">
                    <a class="nav-link" href="?view=modules">Modules</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Tab Content -->
    <?php if ($view == 'posts'): ?>
        <!-- Posts Tab -->
        <div class="mt-4">
            <h2>All Posts</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Module</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($post['title']); ?></td>
                            <td><?php echo htmlspecialchars(substr($post['content'], 0, 50)) . '...'; ?></td>
                            <td><?php echo htmlspecialchars($post['module_name']); ?></td>
                            <td><?php echo htmlspecialchars($post['created_at']); ?></td>
                            <td>
                                <a href="post_detail.php?id=<?php echo $post['id']; ?>" class="btn btn-info btn-sm">View</a>
                                <a href="?delete_post_id=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif ($view == 'users'): ?>
        <!-- Users Tab -->
        <div class="mt-4">
            <h2>All Users</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
 
                            <td>
                                <a href="?delete_user_id=<?php echo $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php elseif ($view == 'modules'): ?>
        <!-- Modules Tab -->
        <div class="mt-4">
            <h2>All Modules</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Module Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($modules as $module): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($module['module_name']); ?></td>
                            <td><?php echo htmlspecialchars($module['description']); ?></td>
                            <td>
                                <a href="?delete_module_id=<?php echo $module['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this module?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>