<?php include "../templates/header.php"; ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    $error = 'You must be logged in to send a message.';
    include '../templates/contact.html.php';
    include "../templates/footer.php";
    exit;
}

$email = $_SESSION['email'];

$mail = new PHPMailer(true);

// Initialize error and success messages
$error = $success = '';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect and sanitize form data
    $name = htmlspecialchars(trim($_POST['name']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate inputs
    if (empty($name) ||empty($message)) {
        $error = 'All fields are required.';
    } elseif ($email == "frostgamer150@gmail.com") {
        $error = 'You cannot send a message to yourself.';
    } else {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = 'frostgamer150@gmail.com'; // SMTP username
            $mail->Password = 'nfcn alaw jlno tyuq'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients

            $mail->setFrom($email, $name);
            $mail->addReplyTo($email, $name);
            $mail->addAddress('frostgamer150@gmail.com'); // Add a recipient


            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Contact Form Submission';
            $mail->Body = "Name: $name<br>Email: $email<br>Message: $message";
            $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message";

            $mail->send();
            $success = 'Message has been sent';
        } catch (Exception $e) {
            $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
include '../templates/contact.html.php';
?>
<?php include "../templates/footer.php"; ?>