<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="layout d-flex justify-content-center align-items-center bg-primary vh-100">
        <div class="container bg-white p-3 rounded w-25">
            <h2 class="text-center">Login</h2>
            <form action="../includes/login.php" method="post" novalidate>
                <div class="input-field mb-3">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Enter Email" name="email" class="form-control rounded-0"  />
                </div>
                <div class="input-field mb-3">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter password" name="password" class="form-control rounded-0"  />
                </div>

                <?php
                    // Start session to access session variables
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }

                    // Check if there are error messages stored in the session
                    if (isset($_SESSION['error_messages'])) {
                        // Retrieve and store error messages in the variable
                        $error_messages = $_SESSION['error_messages'];
                        
                        // Clear the error messages from the session so they don't persist across pages
                        unset($_SESSION['error_messages']);
                    } else {
                        // If no error messages in the session, initialize an empty array
                        $error_messages = [];
                    }
                    ?>

                <?php if (!empty($error_messages)): ?>
                    <?php foreach ($error_messages as $error_message): ?>
                        <p style="color:red;"><?= htmlspecialchars($error_message); ?></p>
                    <?php endforeach; ?>
                <?php endif; ?>

                <button class="login btn btn-success w-100 mb-2"><strong>Log in</strong></button>
                <div class="text-center mt-3">
                    <p class="mb-1">you agree to our terms and policies</p>
                    <p class="mb-1">Don't have an account? <a href="signup.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
