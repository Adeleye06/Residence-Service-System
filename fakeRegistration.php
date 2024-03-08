<?php
if(isset($_POST['submit'])){
    //connection
    $conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = $conn->real_escape_string($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $firstname = $conn->real_escape_string($_POST["firstname"]);
    $lastname = $conn->real_escape_string($_POST["lastname"]);

    // Check if email already exists
    $sql = "SELECT U_ID FROM USER WHERE email='$email'";
    $result = $conn->query($sql);
    if($result->num_rows > 0) {
        header("refresh:2; url=fakeRegistration.php");
        die("This email exists, try other emails please!");
    } else {
        // Insert into USER table
        $sql2 = "INSERT INTO USER (email, f_name, l_name) VALUES ('$email', '$firstname', '$lastname')";
        if($conn->query($sql2)){
            $user_id = $conn->insert_id; // Get the auto-generated U_ID

            // Now insert into CREDENTIAL table with the new user's ID and hashed password
            $sql3 = "INSERT INTO CREDENTIAL (U_ID, password) VALUES ($user_id, '$password')";
            if(!$conn->query($sql3)){
                echo "Error inserting password: " . $conn->error;
            } else {
                echo('Registration successful.');
            }
        } else {
            echo "Error inserting user: " . $conn->error;
        }
    }
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title
</head>
<body style=''>
    <form action = 'fakeRegistration.php' method='POST' enctype='multipart/form-data'>
    <h1> Register Page </h1>
    <label for="firstname">Enter Firstname</label>
    <input type="text" name="firstname" id='firstname' placeholder='Enter Firstname' required> <br>

    <label for="">Enter Lastname</label>
    <input type="text" name="lastname" id="lastname" placeholder="Enter Lastname" required> <br>

    <label for='email'> Admin Email </label>
    <input type='text' id='email' name='email' value='' placeholder='Enter Username' required> <br>

    <label for='password'> Password </label>
    <input type='password' id='password' name='password' placeholder='Enter Password' required> <br>

    <input type='submit' value='register' name='submit'>
    </form>
</body>
</html>