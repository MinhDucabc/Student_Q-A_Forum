<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../templates/header_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="bg-light py-3 border-bottom">
        <?php $title = $title ?? ''; ?>
        <?php if ($title === 'home'):?>
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <h1 class="h4 mb-0">Logo Name</h1>
                </div>
                <nav>
                    <ul class="nav">
                        <li class="nav-item"><a href="../includes/home.php" class="nav-link text-primary font-weight-bold">Home</a></li>
                        <li class="nav-item"><a href="../includes/about.php" class="nav-link text-primary font-weight-bold">About</a></li>
                        <li class="nav-item"><a href="../templates/contact.html.php" class="nav-link text-primary font-weight-bold">Contact</a></li>
                    </ul>
                </nav>
                <div class="d-flex align-items-center">
                    <a href="#" class="text-dark mr-3"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-dark mr-3"><i class="fab fa-github"></i></a>
                    <a href="#" class="text-dark mr-3"><i class="fab fa-instagram"></i></a>
                </div>
                <div class="auth-buttons d-flex align-items-center">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <!-- Display Profile button if user is logged in -->
                        <a href="profile.php" class="btn btn-primary ml-3">Profile</a>
                        <a href="logout.php" class="btn btn-secondary ml-3">Logout</a>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-primary ml-3">Login</a>
                        <a href="signup.php" class="btn btn-primary ml-3">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="page-title">
                <a href="index.php" class="btn btn-primary"><i class="fas fa-undo-alt"></i></a>
            </div>
        <?php endif;?>
    </header>
</body>
</html>
