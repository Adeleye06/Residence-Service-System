<?php

session_start();
if(!isset($_SESSION['U_ID'])){
    header("refresh:3; url=admin_login.php");
    die("you did not log in, going to admin log in page in 3 seconds");
}

$conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$forms = $conn->query("SELECT * FROM FORM_FILLED");

if ($forms -> num_rows > 0){
    while($form = $forms -> fetch_assoc()){
        print "FORM TYPE IS: ".$form['FORM_ID'];
        print "SUBMITTED TIME IS: ".$form['TIME'];
        print "ID FOR THIS FILLED FORM IS".$form['FILLED_FORM_ID'];
        $agreed = $conn -> query("SELECT F_NAME, L_NAME, ROOM FROM FORM_USER INNER JOIN USER ON FORM_USER.U_ID = USER.U_ID WHERE FORM_USER.FILLED_FORM_ID = {$form['FILLED_FORM_ID']}");
        if ($agreed -> num_rows == 0){
            print "no one belongs to this form, system did not save this form properly!";
        }else{
            while ($user = $agreed->fetch_assoc()){
                print $user['ROOM'].": ".$user['F_NAME']." ".$user['L_NAME']."      ";
            }
        }
        print "<br><br>";
    }
}else{
    print "no saved forms for this one";
}