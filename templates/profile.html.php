<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">User Profile</h2>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Welcome, <?php echo htmlspecialchars($username); ?>!</h5>
                <p class="card-text"><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>
                <p class="card-text"><strong>User ID:</strong> <?php echo htmlspecialchars($user_id); ?></p>

                <a href="home.php" class="btn btn-primary mt-3">Back to Home</a>
                <a href="logout.php" class="btn btn-secondary mt-3">Logout</a>
            </div>
        </div>
    </div>

</body>
</html>
