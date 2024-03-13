<?php

session_start();
require "../database.php";
require "authentication.php";
quitIfNotLoggedIn();

print "this page lists all forms in the database and let user to choose the forms they like to use<br><br>";

        //connection
        $conn = database();

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