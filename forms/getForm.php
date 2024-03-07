<?php

session_start();
if(!isset($_SESSION['studentEmail'])){
    header("refresh:3; url=student_login.php");
    die("you did not log in, going to student log in page in 3 seconds");
}

if (!isset($_GET['id'])){
    
    header("refresh:3; url=chooseforms.php");
    die("you did not choose a form yet, going to choose in 3 seconds");
}

print "welcome user".$_SESSION['studentEmail']."<br>";

print "this page checks if user filled forms and print them if they had, or let user to fill a new form<br>";

$conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT FORM_FILLED.FILLED_FORM_ID FROM FORM_FILLED JOIN FORM_USER WHERE FORM_USER.U_ID = {$_SESSION['U_ID']} AND FORM_USER.FILLED_FORM_ID = {$_GET['id']};";
//print $sql."<br>";
$result = $conn->query($sql);

if($result->num_rows > 0){
    while ($row = $result->fetch_assoc()) {
        print "we have find you already filled the form with id:";
       print $row['FILLED_FORM_ID']."  ";
       print "click here to go to see the form <a href='formDetail.php?filled={$row['FILLED_FORM_ID']}'>click me</a>";
       print "<br>";
    }

}else{
    print "you have not filled this form yet";
}

print "please fill this form with link <a href='formDetail.php?form={$_GET['id']}'>this link please</a>";

?>