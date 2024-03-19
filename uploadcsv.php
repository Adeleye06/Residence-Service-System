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

if (isset($_POST["submit"])) {
    if ($_FILES['fileToUpload']['error']!=0){
        die('upload did not work correctly');
    }

    if ($_FILES['fileToUpload']['size'] > 1000000){
        print "<a href=''>Try Again</a><br>";
        die('This file is too large to upload! Max size is 1MB!! This thing is ' . $_FILES['fileToUpload']['size'] / 1000000 . "MB");
    }

    $conn = database();
    $conn->options(MYSQLI_OPT_LOCAL_INFILE, true);

    //filename
    $filename = $_FILES["fileToUpload"]["name"];
    
    //mime
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    if (finfo_file($finfo, $_FILES['fileToUpload']['tmp_name']) != "text/plain"){
        die("you upload wrong thing, unaccepted");
    }
    finfo_close($finfo);

    //size
    $size = $_FILES['fileToUpload']['size'];

    print "uploading files named $filename with size of $size in to our database...";

    $file = $_FILES['fileToUpload']['tmp_name'];
    if ($file) {
        $update = 0;
        $new = 0;
        $handle = fopen($file, 'r');
        while (($data = fgetcsv($handle, 1000, ',')) !== false) {
            $HALL = mysqli_real_escape_string($conn, $data[0]);
            $ROOM = mysqli_real_escape_string($conn, $data[1]);
            $L_NAME = mysqli_real_escape_string($conn, $data[3]);
            $F_NAME = mysqli_real_escape_string($conn, $data[4]);
            $BIRTHDATE = mysqli_real_escape_string($conn, $data[5]);
            $GENDER = mysqli_real_escape_string($conn, $data[6]);
            $EMAIL = mysqli_real_escape_string($conn, $data[7]);
            $PHONE = mysqli_real_escape_string($conn, $data[8]);
            $MAJOR = mysqli_real_escape_string($conn, $data[9]);

            $try = $conn -> query("SELECT U_ID FROM USER WHERE EMAIL = '$EMAIL'");
            if($try -> num_rows > 0){
                //there are already user with same email in database, alter them instead
                $conn -> query("UPDATE USER SET HALL = '$HALL', ROOM = '$ROOM', L_NAME = '$L_NAME', F_NAME = '$F_NAME', BIRTHDATE = '$BIRTHDATE', GENDER = '$GENDER', PHONE = '$PHONE', MAJOR = '$MAJOR' WHERE U_ID = '{$try -> fetch_assoc()['U_ID']}'");
                $update = $update + 1;
            }else{
                //insert new person
                $conn -> query("INSERT INTO user (HALL, ROOM, L_NAME, F_NAME, BIRTHDATE, GENDER, EMAIL, PHONE, MAJOR) VALUES ('$HALL', '$ROOM', '$L_NAME', '$F_NAME', '$BIRTHDATE', '$GENDER', '$EMAIL', '$PHONE', '$MAJOR')");
                $new = $new + 1;
            }
        }
        fclose($handle);
        echo 'CSV data imported successfully!<br>';
        echo "This import added $new new users, and updated $update existing users.<br>";
    } else {
        echo 'Error uploading the CSV file.';
    }
}

print "<!DOCTYPE html>
<html>
<body>

<form action='uploadcsv.php' method='post' enctype='multipart/form-data'>
<h1>Welcome to csv upload page<br></h1>
  <h5>Select csv file to upload:<br></h5>
  <input type='file' name='fileToUpload' id='fileToUpload'> <br><br>
  <input type='submit' value='Upload File' name='submit'> <br><br>
</form>

</body>
</html>";
?>
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
