<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Load PHPMailer using Composer

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $research_title = htmlspecialchars($_POST['research_title']);
    $details = htmlspecialchars($_POST['details']);
    $attachment = $_FILES['attachment'];

    // Check if all required fields are filled
    if (empty($name) || empty($email) || empty($research_title) || empty($details)) {
        echo "All fields are required!";
        exit;
    }

    // Handle file upload
    $upload_ok = false;
    $uploaded_file_path = '';
    if (isset($attachment['tmp_name']) && $attachment['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $uploaded_file_path = $upload_dir . basename($attachment['name']);
        $upload_ok = move_uploaded_file($attachment['tmp_name'], $uploaded_file_path);
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
        $mail->setFrom('cryptosporidium956@gmail.com', 'crypto sporidium'); // Sender
        $mail->addAddress('amnaalzaabi01@gmail.com', 'amnaalzaabi'); // Recipient email

        // Attach file if upload succeeded
        if ($upload_ok) {
            $mail->addAttachment($uploaded_file_path);
        }

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Research Submission: ' . $research_title;
        $mail->Body    = "
            <h2>New Research Submission</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Research Title:</strong> $research_title</p>
            <p><strong>Research Abstract/Details:</strong></p>
            <p>$details</p>
        ";
        $mail->AltBody = "Name: $name\nEmail: $email\nResearch Title: $research_title\nDetails: $details";

        // Send mail
        $mail->send();
        echo "Research submitted successfully!";
    } catch (Exception $e) {
        echo "Mail could not be sent. Error: {$mail->ErrorInfo}";
    } finally {
        // Clean up uploaded file
        if ($upload_ok && file_exists($uploaded_file_path)) {
            unlink($uploaded_file_path);
        }
    }
} else {
    echo "Invalid request method. Please use the form to submit data.";
}
?>
