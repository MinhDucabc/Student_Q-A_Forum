<?php include '../templates/header.php'; ?>
<?php
// Include database connection
include 'db_connection.php';

// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include '../includes/db_connection.php';
$user_id = $_SESSION['user_id'];

// Prepare and bind
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");

// Execute the statement
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
$username = $user['username'];
$email = $user['email'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get user input
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate input
    if (empty($username) || empty($email) || empty($password)) {
        echo "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
    } elseif (strlen($password) < 6) {
        echo "Password must have at least 6 characters.";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Update user profile in the database
        $sql = "UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashed_password,
            'id' => $user_id
        ]);
    
        $_SESSION['email'] = $email;
        $_SESSION['username'] = $username;
        header('Location: profile.php');
        echo "Profile updated successfully.";
    }
}

// Include the edit profile template
include '../templates/edit_profile.html.php';
?>
<?php include '../templates/footer.php'; ?>