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
            <h2 class="text-center">Signup</h2>
            <form action="../includes/signup.php" method="post" novalidate>
                <div class="input-field mb-3">
                    <label for="username">Username</label>
                    <input type="text" placeholder="Enter username" name="username" class="form-control rounded-0" />
                </div>
                <div class="input-field mb-3">
                    <label for="email">Email</label>
                    <input type="email" placeholder="Enter Email" name="email" class="form-control rounded-0"  />
                </div>
                <div class="input-field mb-3">
                    <label for="password">Password</label>
                    <input type="password" placeholder="Enter password" name="password" class="form-control rounded-0"  />
                </div>
                <button class="login btn btn-success w-100"><strong>Signup</strong></button>
                <p>You are agree to your terms and policies</p>
            </form>
        </div>
    </div>
</body>
</html>