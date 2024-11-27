<?php include '../templates/header.php'; ?>
<?php
$title = "Admin Panel"; 

include '../includes/db_connection.php'; // Database connection file

try {
    // Fetch all posts with necessary information
    $postsStmt = $pdo->prepare('SELECT p.id, p.title, p.content, p.image_url, u.username, m.module_name, p.created_at 
                                FROM posts p
                                LEFT JOIN users u ON p.user_id = u.id
                                LEFT JOIN modules m ON p.module_id = m.id');
    $postsStmt->execute();
    $posts = $postsStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Fetch all users with role information
    $usersStmt = $pdo->prepare('SELECT id, username, email, `admin` FROM users');
    $usersStmt->execute();
    $users = $usersStmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Fetch all modules
    $modulesStmt = $pdo->prepare('SELECT id, module_name, description FROM modules');
    $modulesStmt->execute();
    $modules = $modulesStmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
    exit();
}

// Handle Deletion (post, user, module)
if (isset($_GET['delete_post_id'])) {
    $postId = $_GET['delete_post_id'];
    $deletePostStmt = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $deletePostStmt->execute(['id' => $postId]);
    header('Location: admin.php'); // Refresh the page after deletion
}

if (isset($_GET['delete_user_id'])) {
    $userId = $_GET['delete_user_id'];
    $deleteUserStmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
    $deleteUserStmt->execute(['id' => $userId]);
    header('Location: admin.php'); // Refresh the page after deletion
}

if (isset($_GET['delete_module_id'])) {
    $moduleId = $_GET['delete_module_id'];
    $deleteModuleStmt = $pdo->prepare('DELETE FROM modules WHERE id = :id');
    $deleteModuleStmt->execute(['id' => $moduleId]);
    header('Location: admin.php'); // Refresh the page after deletion
}

// Handle Addition (post, user, module)
if (isset($_POST['add_post'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image'];
    $module = $_POST['module'];
    $userId = $_POST['user_id'];

    // Handle image upload
    $imageData = file_get_contents($image['tmp_name']);
    $imageType = pathinfo($image['name'], PATHINFO_EXTENSION);

    $addPostStmt = $pdo->prepare('INSERT INTO posts (title, content, image_url, module_id, user_id) VALUES (:title, :content, :image_url, :module_id, :user_id)');
    $addPostStmt->execute(['title' => $title, 'content' => $content, 'image_url' => $imageData, 'module_id' => $module, 'user_id' => $userId]);
    header('Location: admin.php'); // Refresh the page after addition
}

// Determine the view type (default to 'posts' if not specified)
$view = $_GET['view'] ?? 'posts'; // Default to posts view if no 'view' parameter is passed

include "../templates/admin.html.php"
?>

<?php include '../templates/footer.php'; ?>
