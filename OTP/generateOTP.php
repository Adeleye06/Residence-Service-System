<?php
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
echo $otp; // Output the OTP (or you can return it as JSON, etc.)
?>
