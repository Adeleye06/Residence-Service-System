<?php

if (isset($_POST["submit"])) {
    if ($_FILES['fileToUpload']['error']!=0){
        die('upload did not work correctly');
    }

    if ($_FILES['fileToUpload']['size'] > 30000000){
        print "<a href='upload.php'>i am sorry i will try again</a><br>";
        die('this file is too large to upload! Max size is 30MB!! This thing is ' . $_FILES['fileToUpload']['size'] / 1000000 . "MB");
    }

    $conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
    if ($conn->connect_error) {
        die("could not connect to database: ". $conn->connect_error);
    }
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

            // Insert data into the 'users' table
            $query = "INSERT INTO user (HALL, ROOM, L_NAME, F_NAME, BIRTHDATE, GENDER, EMAIL, PHONE, MAJOR) VALUES ('$HALL', '$ROOM', '$L_NAME', '$F_NAME', '$BIRTHDATE', '$GENDER', '$EMAIL', '$PHONE', '$MAJOR')";
            mysqli_query($conn, $query);
        }
        fclose($handle);
        echo 'CSV data imported successfully!';
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