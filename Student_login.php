<?php
    require './vendor/autoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    session_start();

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
        $conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

        $email = $conn->real_escape_string($_POST["email"]);
        

        $sql = "SELECT U_ID FROM USER WHERE EMAIL='$email'";

        $result = $conn->query($sql);

        if($result->num_rows == 1){
            // Generate OTP
            $_SESSION['firstTimeOtp'] = generateOTP();
            $_SESSION['studentEmail'] = $email;
            // Email configuration
            $emailSubject = 'Your OTP';
            $emailBody = 'Your OTP is: ' . $_SESSION['firstTimeOtp'];

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
                /* echo 'Email has been sent with OTP: ' . $_SESSION['firstTimeOtp']; */
            } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else{
        header("refresh:2; url=index.php;");
        die('Did not find your account, password or username is wrong');
    }
    
    
    
    }
    if(isset($_POST['login'])){
         //connection
        $conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        $email = $conn->real_escape_string($_POST["email"]);
        $otp = $_POST['password'];

        if($otp){
            if($_SESSION['studentEmail'] == $email && $_SESSION['firstTimeOtp'] == $otp){
                header("refresh:2; url=student_dashboard.php;");
                exit();
            }
            
        } else{
            header("refresh:2; url=Student_login.php;");
            die('Email and otp required');
            exit();
        }

        
        

       /*  $sql = "SELECT U_ID FROM USER WHERE EMAIL='$email'";
        $result = $conn->query($sql);  */
      

        
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
                    <input type="email" id="email" name="email" required>
    
                    <label for="password">OTP</label>
                    <input type="password" id="password" name="password" >
    
                    <label class="checkbox-container">Remember Me &nbsp;
                        <input type="checkbox" name="remember-me">
                        <span class="checkmark"></span>
                    </label>
    
                    <button type="submit" name="generateOTP">Generate OTP</button>
                    <button type="submit" name="login">Log In</button>
                </form>

                <a href="reset-password.php">Lost your password?</a> <!-- reset-password.php create -->
            </div>
        </div>
</div>

</body>
</html>
