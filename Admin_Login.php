<?php
session_start();
require "database.php";
require "authentication.php";
if (loggedIn()){
    echo "You Already Logged in!";
}
if(isset($_POST['login'])){
    //connection
    $conn = database();

    $email = $_POST['email'];
    $password = $_POST['password'];
    if ($email && $password){
       // Using prepared statements to prevent SQL Injection
       $sql = "SELECT c.PASSWORD, u.U_ID, u.USER_TYPE FROM credential c JOIN user u ON u.U_ID = c.U_ID WHERE u.email = ? AND USER_TYPE IS NOT NULL"; 
       $stmt = $conn->prepare($sql);
       if ($stmt) {
           $stmt->bind_param("s", $email); // 's' indicates the parameter type is a string
           $stmt->execute();
           $result = $stmt->get_result();

           if($result->num_rows == 1){
               $row = $result->fetch_assoc();
               if(password_verify($password, $row['PASSWORD'])){
                   // Password is correct, redirect to admin dashboard
                    $_SESSION['U_ID'] = $row['U_ID'];
                    $_SESSION['USER_TYPE'] = $row['USER_TYPE'];
                   header("Location: admin_dashboard.php");
                   exit();
               } else {
                   // Password is incorrect
                   echo "Incorrect email or password";
               }
           } else {
               // Email does not exist in the database
               echo "Incorrect email or password";
           }
           $stmt->close();
       } else {
           echo "Failed to prepare the SQL statement";
       }
   } else {
       // Email or Password not provided
       echo "Please enter both email and password";
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
                    <button type="submit" name="login">Log In</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
