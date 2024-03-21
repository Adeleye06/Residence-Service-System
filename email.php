<?php
        require './vendor/autoload.php';
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        require_once "database.php";

        function sendEmailtoAddress($EMAIL, $EMAIL_TYPE_ID, $data){

            $USER = database() -> query("SELECT U_ID FROM USER WHERE EMAIL = '$EMAIL'");
            if ($USER -> num_rows != 1){
                echo "we did not find a user with that email, can not send email to non exist person";
                return false;
            }
            
            $U_ID = $USER -> fetch_assoc()['U_ID'];

            sendEmailtoUID($U_ID, $EMAIL_TYPE_ID, $data);
        }

        function sendEmailtoUID($U_ID, $EMAIL_TYPE_ID, $data){
                // Email configuration
                $emailSubject = 'Message From Residence Service System';
                $emailTemplate = database() -> query("SELECT * FROM EMAIL_TYPE WHERE EMAIL_TYPE_ID = '$EMAIL_TYPE_ID'");
                //guard
                if ($emailTemplate -> num_rows != 1){echo "did not find a tempalte for requested email!"; return false;};
                $emailBody = $emailTemplate -> fetch_assoc()['TEMPLATE_TEXT'].$data;
                // Sender configuration
                $senderEmail = 'elisha.boehm4@ethereal.email'; // Change this to your email address
                $senderName = 'Residence Service System';

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

                $USER = database() -> query("SELECT EMAIL FROM USER WHERE U_ID = '$U_ID'");
                if ($USER -> num_rows != 1){
                    echo "we did not find a user with that id, can not send email";
                    return false;
                }
                
                $email = $USER -> fetch_assoc()['EMAIL'];

                $mail->addAddress($email); // Add recipient

                //Content
                $mail->isHTML(true);
                $mail->Subject = $emailSubject;
                $mail->Body    = $emailBody;

                // Send email
                $mail->send();
            } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
            }

            database() -> query("INSERT INTO EMAIL_LOG (EMAIL_TYPE_ID, U_ID, DATE) VALUES ('$EMAIL_TYPE_ID', '$U_ID', NOW())");
        
        }
?>