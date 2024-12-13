<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer using Composer

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Debugging: Check if $_POST contains data
    if (empty($_POST)) {
        echo "No POST data received. Make sure the form uses method='POST'.";
        exit;
    }

    // Collect form data
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $location = isset($_POST['location']) ? htmlspecialchars($_POST['location']) : '';
    $details = isset($_POST['details']) ? htmlspecialchars($_POST['details']) : '';

    if (empty($name) || empty($email) || empty($location) || empty($details)) {
        echo "All fields are required!";
        exit;
    }

    // Create PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Gmail SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'cryptosporidium956@gmail.com'; // Your Gmail address
        $mail->Password   = 'csqh dkdz jzmc jfja';   // App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Recipients
        $mail->setFrom('cryptosporidium956@gmail.com', 'Crypto sporidium'); // Sender
        $mail->addAddress('amnaalzaabi01@gmail.com', 'amnaalzaabi'); // Recipient email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Case Submitted';
        $mail->Body    = "
            <h2>New Case Submitted</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Affected Animal Name:</strong> $location</p>
            <p><strong>Details of the Case:</strong></p>
            <p>$details</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nAffected Animal Name: $location\nDetails: $details";

        // Send mail
        $mail->send();
        echo "Mail has been sent successfully!";
    } catch (Exception $e) {
        echo "Mail could not be sent. Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method. Please use the form to submit data.";
}
?>
