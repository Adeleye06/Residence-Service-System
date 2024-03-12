<?php
// Function to generate OTP
session_start();

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
$_SESSION['firstTimeOtp'] = $otp;
echo $otp; // Output the OTP (or you can return it as JSON, etc.)
?>
