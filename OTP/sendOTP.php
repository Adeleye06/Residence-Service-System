<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



// Get email and OTP from POST data
$email = $_POST['email'];
$otp = $_POST['otp'];

// Email configuration
$emailSubject = 'Your OTP';
$emailBody = 'Your OTP is: ' . $otp;

// Sender configuration
$senderEmail = 'elisha.boehm4@ethereal.email'; // Change this to your email address
$senderName = 'Elisha';

// Initialize PHPMailer
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.ethereal.email'; // Your SMTP server
    $mail->SMTPAuth = true;
    $mail->Username = 'elisha.boehm4@ethereal.email'; // Your SMTP username
    $mail->Password = 'KzzpSRyhj7CWQUqHZV'; // Your SMTP password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to

    //Recipients
    $mail->setFrom($senderEmail, $senderName);
    $mail->addAddress($email); // Add recipient

    //Content
    $mail->isHTML(true);
    $mail->Subject = $emailSubject;
    $mail->Body    = $emailBody;

    // Send email
    $mail->send();
    echo 'Email has been sent with OTP: ' . $otp;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
