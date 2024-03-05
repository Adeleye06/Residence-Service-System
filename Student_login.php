<!-- <!DOCTYPE html> 
 <html lang="en"> 
 <head> 
     <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
     <title>Student Login</title> 
     <link rel="stylesheet" href="assets/css/style_student_login.css"> 
</head> 
<body>
    <div class="container">
        <div class="left-side">
            <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
            
        </div>
        <div class="right-side">
            <div class="login-form">
                <h2>Student Login</h2><br>
                <form action="submit-login.php" method="post">  create
                    <label for="email">College email address</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="password">OTP</label>
                    <input type="password" id="password" name="password" required>
                    
                    <label class="checkbox-container">Remember Me &nbsp;
                        <input type="checkbox" name="remember-me">
                        <span class="checkmark"></span>
                    </label>
                    
                    <button type="submit">Log In</button>
                </form>
                <a href="reset-password.php">Lost your password?</a> reset-password.php create 
            </div>
        </div>
    </div>
</body>
</html> -->
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <link rel="stylesheet" href="assets/css/style_student_login.css"> 
</head>
<body>
    <div class="container">
        <div class="left-side">
            <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
            
        </div>
        <div class="right-side">
            <div class="login-form">
                <h2>Student Login</h2><br>
                <form action="submit-login.php" method="post"> <!-- create -->
                    <label for="email">College email address</label>
                    <input type="email" id="email" name="email" required>
                    
                    <label for="password">OTP</label>
                    <input type="password" id="password" name="password" required>
                    
                    <label class="checkbox-container">Remember Me &nbsp;
                        <input type="checkbox" name="remember-me">
                        <span class="checkmark"></span>
                    </label>
                    
                    <button type="button" id="generateOTP">Generate OTP</button> <!-- Button to trigger OTP generation -->
                    <button type="submit">Log In</button>
                </form>
                <a href="reset-password.php">Lost your password?</a> <!-- reset-password.php create -->
            </div>
        </div>
    </div>

    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Script to handle OTP generation -->
    <script>
    $(document).ready(function() {
        $('#generateOTP').click(function() {
            var email = $('#email').val(); // Get the email address entered by the user
            
            // Send AJAX request to generateOTP.php and pass email address as a parameter
            $.ajax({
                url: './OTP/generateOTP.php',
                type: 'POST',
                data: { email: email }, // Send email address as data
                success: function(response) {
                    // Response contains the generated OTP
                    alert('OTP generated successfully. Check your email.'); 
                    
                    // Send email with OTP to the user
                    $.ajax({
                        url: './OTP/sendOTP.php', // Path to sendOTP.php script
                        type: 'POST',
                        data: { email: email, otp: response }, // Send email address and OTP as data
                        success: function(response) {
                            alert('OTP sent to your email successfully.');
                        },
                        error: function(xhr, status, error) {
                            alert('Error sending OTP: ' + error);
                        }
                    });
                },
                error: function(xhr, status, error) {
                    alert('Error generating OTP: ' + error);
                }
            });
        });
    });
</script>

</body>
</html>
