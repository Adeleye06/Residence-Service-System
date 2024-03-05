<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Function to generate OTP
function generateOTP($length = 6) {
    $characters = '0123456789';
    $otp = '';

    for ($i = 0; $i < $length; $i++) {
        $otp .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $otp;
}

// Generate OTP
$otp = generateOTP();

// Email configuration
$emailSubject = 'Your OTP';
$emailBody = 'Your OTP is: ' . $otp;
$recipientEmail = 'enochadeleye3@gmail.com'; // Change this to the recipient's email address

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
    $mail->addAddress($recipientEmail); // Add a recipient

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
