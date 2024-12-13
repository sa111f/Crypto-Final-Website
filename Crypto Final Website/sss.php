<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'factnewssss089@gmail.com'; 
    $mail->Password   = 'izum xlpo sxjn vklm'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom('factnewssss089@gmail.com', 'factnews');
    $mail->addAddress('rohitashkumawat54rwh@gmail.com', 'Rohitash kumawat');

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Test Email via Gmail SMTP';
    $mail->Body    = '<h1>Hello!</h1><p>This is a test email using Gmail SMTP.</p>';
    $mail->AltBody = 'This is a test email using Gmail SMTP.';

    $mail->send();
    echo 'Mail has been sent successfully!';
} catch (Exception $e) {
    echo "Mail could not be sent. Error: {$mail->ErrorInfo}";
}
?>

