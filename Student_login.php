    <?php
    
    session_start();
        require "database.php";
        require "authentication.php";
        require "email.php";

        if (loggedIn()){
            echo "You Already Logged in!";
        }

        if(isset($_POST['generateOTP'])){
            function generateOTP($length = 6) {
                $characters = '0123456789';
                $otp = '';
            
                for ($i = 0; $i < $length; $i++) {
                    $otp .= $characters[rand(0, strlen($characters) - 1)];
                }
            
                return $otp;
            }

            //connection
            $conn = database();

            $email = $conn->real_escape_string($_POST["email"]);
            
            $result = $conn->query("SELECT U_ID, F_NAME, USER_TYPE FROM USER WHERE EMAIL='$email'");


            if($result->num_rows == 1){
                // Generate OTP
                $_SESSION['firstTimeOtp'] = generateOTP();
                $_SESSION['otpTime'] = time();
                $_SESSION['studentEmail'] = $email;
                $student = $result->fetch_assoc();
                $_SESSION['F_NAME'] = $student['F_NAME'];     
                $_SESSION['U_ID'] = $student['U_ID'];
                $_SESSION['USER_TYPE'] = $student['USER_TYPE'];
                sendEmailtoAddress($email, 1, $_SESSION['firstTimeOtp']);

            } else{
            header("refresh:2; url=index.php;");
            die('Did not find your account, password or username is wrong');
            }
        }
        if (isset($_POST['login'])) {
            $conn = database();
            $email = $conn->real_escape_string($_POST["email"]);
            $otp = $_POST['password'];
            $currentTime = time();
        
            if (isset($_SESSION['otpTime']) && $currentTime - $_SESSION['otpTime'] <= 120) { // Check if OTP is within 2-minute validity
                if ($_SESSION['studentEmail'] == $email && $_SESSION['firstTimeOtp'] == $otp) {
                    session_regenerate_id(); // Regenerate session ID upon successful login
                    echo("You are logged in. Redirecting to dashboard...");
                    $conn -> query("INSERT INTO ACCESS_LOG (U_ID, TIME) VALUES ({$_SESSION['U_ID']}, NOW())");
                    header("refresh:2; url=student_dashboard.php;");
                    exit();
                } else {
                    echo 'Invalid OTP or email. Please try again.';
                }
            } else {
                echo 'Your OTP has expired. Please generate a new one.';
            }
        }
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
                    <form action="Student_login.php" method="POST">
                        <label for="email">College email address</label>
                        <input type="email" id="email" name="email" value="<?php
                        if(isset($_POST["generateOTP"])){
                            echo $_POST["email"];
                        }
                        ?>" required>
        
                        <label for="password">OTP</label><br>
                        <input id="password" name="password" type="text" inputmode="numeric" maxlength="6">
        
                        <button type="submit" name="generateOTP">Generate OTP</button>
                        <button type="submit" name="login">Log In</button>
                    </form>
                </div>
            </div>
    </div>

    </body>
    </html>
