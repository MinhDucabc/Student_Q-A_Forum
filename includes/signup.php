<?php include '../templates/header.php'; ?>
<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Include database connection file
include 'db_connection.php';

// Initialize an error messages array
$error_messages = [];

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate username
    if (empty($username)) {
        $error_messages[] = "Username is required.";
    }
    
    // Validate email
    if (empty($email)) {
        $error_messages[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_messages[] = "A valid email address is required.";
    }
    
    // Validate password
    if (empty($password)) {
        $error_messages[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $error_messages[] = "Password must be at least 6 characters long.";
    }
    
    // Check if there are any error messages
    if (!empty($error_messages)) {
        // Store errors in session
        $_SESSION['error_messages'] = $error_messages;
        header("Location: signup.php");
        exit();

    } else {
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->fetch()) {
            $_SESSION['error_messages'] = ["Username or email is already taken."];
            header("Location: signup.php");
            exit();
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new user into the database with the hashed password
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword); // Use the hashed password


            if ($stmt->execute()) {
                // Redirect to login page or homepage after successful signup
                $_SESSION['success'] = "Signup successful! You can now log in.";
                header("Location: login.php");
                exit();
            } else {
                $_SESSION['error_messages'] = ["There was an error creating your account. Please try again."];
                header("Location: signup.php");
                exit();
            }
        }
    }
}

include '../templates/signup.html.php';
?>
<?php include '../templates/footer.php'; ?>
