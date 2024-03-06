<?php

session_start();
if(!isset($_SESSION['studentEmail'])){
    header("refresh:3; url=student_login.php");
    die("you did not log in, going to student log in page in 3 seconds");
}

print "this page lists all forms in the database and let user to choose the forms they like to use<br><br>";

        //connection
        $conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM FORM_TYPE";

            $result = $conn->query($sql);
    
            if($result->num_rows > 0){
                while ($row = $result->fetch_assoc()) {
                   print $row['FORM_NAME']."  ";
                   print $row['DUE_DATE']."  ";
                   print "click here to go to the form <a href='getForm.php?id={$row['FORM_ID']}'>click me</a>";
                   print "<br>";
                }
    
            }else{
                die("we did not find any form in the database, there is a error");
            }

?>