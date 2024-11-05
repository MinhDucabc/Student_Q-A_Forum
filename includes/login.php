<?php $title = "login"; include '../templates/header.php'; ?>
<?php
session_start(); // Start the session at the top before any output

$title = "login";
include '../includes/db_connection.php'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare and execute the query using PDO
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username); // Bind the username value
    $stmt->execute();
    
    // Fetch the user data
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists
    if ($user) {
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: home.php"); // Redirect to home page
            exit();
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No user found with that username.";
    }
}
include '../templates/login.html.php';
?>

<!-- Display error message if any -->
<?php if (isset($error_message)): ?>
    <p style="color:red;"><?php echo htmlspecialchars($error_message); ?></p>
<?php endif; ?>

<?php
include '../templates/footer.php';
?>
