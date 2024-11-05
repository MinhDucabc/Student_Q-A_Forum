<?php $title = "signup"; include '../templates/header.php'; ?>
<?php 
    include '../templates/signup.html.php'; 
    include '../includes/db_connection.php'; // Include the database connection file
    // $db = getDbConnection(); // Initialize the $db variable
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

            // Insert the user into the database
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $password])) {
                $error_messages = "Registration successful! <a href='login.php'>Login here</a>";
            } else {
                $error_messages = "Registration failed. Username or email may already be taken.";
            }
        } else {
            $error_messages = "Please fill in all required fields.";
        }
    }
?>

<?php include '../templates/footer.php'; ?>