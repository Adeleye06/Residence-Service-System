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
                    
                    <button type="submit">Log In</button>
                </form>
                <a href="reset-password.php">Lost your password?</a> <!-- reset-password.php create -->
            </div>
        </div>
    </div>
</body>
</html>
