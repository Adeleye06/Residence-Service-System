<?php
if(isset($_POST['login'])){
    //connection
    $conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email && $password){
       // Using prepared statements to prevent SQL Injection
       $sql = "SELECT c.PASSWORD FROM credential c JOIN user u ON u.U_ID = c.U_ID WHERE u.email = ?"; 
       $stmt = $conn->prepare($sql);
       if ($stmt) {
           $stmt->bind_param("s", $email); // 's' indicates the parameter type is a string
           $stmt->execute();
           $result = $stmt->get_result();

           if($result->num_rows == 1){
               $row = $result->fetch_assoc();
               if(password_verify($password, $row['PASSWORD'])){
                   // Password is correct, redirect to admin dashboard
                   header("Location: admin_dashboard.php");
                   exit();
               } else {
                   // Password is incorrect
                   echo "<script>alert('Incorrect email or password.');</script>";
               }
           } else {
               // Email does not exist in the database
               echo "<script>alert('Incorrect email or password.');</script>";
           }
           $stmt->close();
       } else {
           echo "<script>alert('Failed to prepare the SQL statement.');</script>";
       }
   } else {
       // Email or Password not provided
       echo "<script>alert('Please enter both email and password.');</script>";
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="assets/css/style_admin_login.css"> 
</head>
<body>
    <div class="container">
        <div class="left-side">
            <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
        </div>
        <div class="right-side">
            <div class="login-form">
                <h2>Admin Login</h2><br>
                <form action="Admin_Login.php" method="post"> <!-- create -->
                    <label for="email">College email address</label>
                    <input type="email" id="email" name="email" required>                    
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                    <label class="checkbox-container">Remember Me &nbsp;
                        <input type="checkbox" name="remember-me">
                        <span class="checkmark"></span>
                    </label>                    
                    <button type="submit" name="login">Log In</button>
                </form>
                <a href="reset-password.php">Lost your password?</a> <!-- reset-password.php create -->
            </div>
        </div>
    </div>
</body>
</html>
