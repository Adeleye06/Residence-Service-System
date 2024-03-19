<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/style_admin_dashboard.css"> 
</head>
<body>
<header class="site-header">
        <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
        <nav>
            <ul>
                <!-- <li><a href="profile.php">Profile</a></li>
                <li><a href="saved-forms.php">My Saved Forms</a></li>
                <li><a href="support.php">Contact Support</a></li> -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

        <div class="ribbon">
    <p>Home &gt; Admin Dashboard &gt; Residents Import</p>
</div>


<div class="content-section">    
<?php
session_start();
require "database.php";
require "authentication.php";
quitIfNotAdmin();

if(isset($_GET['admin'])){
    echo "updating admin<br>";
    $conn = database();
    $try = $conn -> query("SELECT U_ID FROM USER WHERE EMAIL = '{$_GET['EMAIL']}'");
    if($try -> num_rows > 0){
        //there are already user with same email in database, alter them instead
        $U_ID = $try -> fetch_assoc()['U_ID'];
        $PASSWORD = password_hash($_GET["PASSWORD"], PASSWORD_DEFAULT);
        $conn -> query("UPDATE USER SET L_NAME = '{$_GET['L_NAME']}', F_NAME = '{$_GET['F_NAME']}', USER_TYPE = '{$_GET['USER_TYPE']}' WHERE U_ID = '$U_ID'");

        // Now update into CREDENTIAL table with the new user's ID and hashed password
        $conn -> query("UPDATE CREDENTIAL SET PASSWORD = '$PASSWORD' WHERE U_ID = $U_ID");
        echo "update successfully";
    }else{
        //insert new person
        $PASSWORD = password_hash($_GET["PASSWORD"], PASSWORD_DEFAULT);
        $conn -> query("INSERT INTO user (L_NAME, F_NAME, EMAIL, USER_TYPE) VALUES ('{$_GET['L_NAME']}', '{$_GET['F_NAME']}', '{$_GET['EMAIL']}', '{$_GET['USER_TYPE']}')");
        $U_ID = $conn->insert_id; // Get the auto-generated U_ID

        // Now insert into CREDENTIAL table with the new user's ID and hashed password
        $conn -> query("INSERT INTO CREDENTIAL (U_ID, PASSWORD) VALUES ($U_ID, '$PASSWORD')");
        echo "new creation successfully";
    }
    die();
}

if(isset($_GET['resident'])){
    echo "updating resident";
    $conn = database();
    $try = $conn -> query("SELECT U_ID FROM USER WHERE EMAIL = '{$_GET['EMAIL']}'");
    $HALL = mysqli_real_escape_string($conn, $_GET['HALL']);
    $ROOM = mysqli_real_escape_string($conn, $_GET['ROOM']);
    $L_NAME = mysqli_real_escape_string($conn, $_GET['L_NAME']);
    $F_NAME = mysqli_real_escape_string($conn, $_GET['F_NAME']);
    $BIRTHDATE = mysqli_real_escape_string($conn, $_GET['BIRTHDATE']);
    $GENDER = mysqli_real_escape_string($conn, $_GET['GENDER']);
    $EMAIL = mysqli_real_escape_string($conn, $_GET['EMAIL']);
    $PHONE = mysqli_real_escape_string($conn, $_GET['PHONE']);
    $MAJOR = mysqli_real_escape_string($conn, $_GET['MAJOR']);
    if($try -> num_rows > 0){
        //there are already user with same email in database, alter them instead
        $U_ID = $try -> fetch_assoc()['U_ID'];
        $conn -> query("UPDATE USER SET HALL = '$HALL', ROOM = '$ROOM', L_NAME = '$L_NAME', F_NAME = '$F_NAME', BIRTHDATE = '$BIRTHDATE', GENDER = '$GENDER', PHONE = '$PHONE', MAJOR = '$MAJOR' WHERE U_ID = '$U_ID'");
        echo "update successfully";
    }else{
        //insert new person
        $conn -> query("INSERT INTO user (HALL, ROOM, L_NAME, F_NAME, BIRTHDATE, GENDER, EMAIL, PHONE, MAJOR) VALUES ('$HALL', '$ROOM', '$L_NAME', '$F_NAME', '$BIRTHDATE', '$GENDER', '$EMAIL', '$PHONE', '$MAJOR')");
        $U_ID = $conn->insert_id; // Get the auto-generated U_ID
        echo "new resident id $U_ID is created successfully";
    }
    die();
}

$conn = database();
$students = $conn -> query("SELECT * FROM USER WHERE USER_TYPE IS NULL");
$admins = $conn -> query("SELECT * FROM USER WHERE USER_TYPE IS NOT NULL");
while($student = $students -> fetch_assoc()){
    echo $student['U_ID'];
    echo $student['ROOM'];
    echo $student['HALL'];
    echo $student['F_NAME'];
    echo $student['L_NAME'];
    echo $student['MAJOR'];
    echo $student['EMAIL'];
    echo "<br>";
}

while($admin = $admins -> fetch_assoc()){
    echo $admin['U_ID'];
    echo $admin['F_NAME'];
    echo $admin['L_NAME'];
    echo $admin['EMAIL'];
    echo $admin['USER_TYPE'];
    echo "<br>";
}

?>
<form>
    <h1>Add New Resident</h1>
    <label for='F_NAME'>First Name</label>
    <input type='text' name='F_NAME' required>
    <label for='L_NAME'>Last Name</label>
    <input type='text' name='L_NAME' required>
    <label for='EMAIL'>School Email Address</label>
    <input type='email' name='EMAIL' required>
    <label for='ROOM'>Full Room Number</label>
    <input type='text' name='ROOM' required>
    <label for='MAJOR'>Major</label>
    <input type='text' name='MAJOR' required>
    <label for='HALL'>Residence Hall</label>
    <input type='text' name='HALL' required>
    <input type='submit' name='resident'/>
</form>
<form>
    <h1>Add New Admin</h1>
    <label for='F_NAME'>First Name</label>
    <input type='text' name='F_NAME' required>
    <label for='L_NAME'>Last Name</label>
    <input type='text' name='L_NAME' required>
    <label for='EMAIL'>School Email Address</label>
    <input type='email' name='EMAIL' required>
    <label for='PASSWORD'>PASSWORD</label><input type='password' name='PASSWORD' required>
    <label for='USER_TYPE'>USER TYPE</label>
    <input type='number' name='USER_TYPE' value='1' required>
    <input type='submit' name='admin'/>
</form>
</div>

<footer class="site-footer">
        <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="footer-logo">
        <p>3000 College Dr S, Lethbridge, Alberta, Canada, T1K 1L6</p>
        <p>1-800-572-0103</p>
        <nav>
            <a href="contact.php">Contacts and Maps</a>
        </nav>
    </footer>
   
</body>
</html>
