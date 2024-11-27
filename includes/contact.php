<?php include '../templates/header.php'; ?>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Validate fields (optional, for additional security)
    if (empty($name) || empty($email) || empty($message)) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        echo "<script>alert('Mail sent successfully.');</script>";

    }
}
    include '../templates/contact.html.php';
?>
<?php include '../templates/footer.php'; ?>