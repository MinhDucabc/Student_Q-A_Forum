<?php include '../templates/header.php'; ?>
<?php
// Start the session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection file
include 'db_connection.php';

// Initialize an error messages array
$error_messages = [];

// Check if form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form inputs
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($email)) {
        $error_messages[] = "Email is required.";
    }
    if (empty($password)) {
        $error_messages[] = "Password is required.";
    }

    // If there are validation errors, store them in the session and reload the page
    if (!empty($error_messages)) {
        $_SESSION['error_messages'] = $error_messages;
        header("Location: login.php");
        exit();

    } else {
        // No validation errors, proceed to check user credentials
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        // Fetch the user data
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if user exists and the password is correct
        if ($user && password_verify($password, $user['password'])) {
            // Store user info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // Redirect to the home page after successful login
            header("Location: home.php");
            exit();
        } else {
            // Set an error message if login fails
            $error_messages[] = "Invalid email or password.";
            $_SESSION['error_messages'] = $error_messages;
            header("Location: login.php");
            exit();
        }
    }

    
}

// If there are any error messages in the session, retrieve them and clear them
// if (isset($_SESSION['error_messages'])) {
//     $error_messages = $_SESSION['error_messages'];
//     unset($_SESSION['error_messages']);
// }

include '../templates/login.html.php';
?>
<?php include '../templates/footer.php'; ?>
