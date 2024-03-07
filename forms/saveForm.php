<?php

session_start();
if(!isset($_SESSION['studentEmail'])){
    header("refresh:3; url=student_login.php");
    die("you did not log in, going to student log in page in 3 seconds");
}

if(!isset($_GET['formid'])){
    header("refresh:3; url=student_login.php");
    die("you did not come here with a formid, there is nothing to save!!");
}


$conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//create a new filled form entry
$sql = "INSERT INTO FORM_FILLED (FORM_ID, TIME) VALUES (1, NOW())";
$conn->query($sql);
$newFormID = mysqli_insert_id($conn);

$sql2 = "INSERT INTO FORM_USER (U_ID, FILLED_FORM_ID) VALUES ({$_SESSION['U_ID']}, $newFormID)";
$conn -> query($sql2);

for ($i=1; isset($_GET[$i]); $i++) { 
    print "get answer data for question $i: ";
    print ($_GET[$i])."<br>";

    $sql = "INSERT INTO FORM_ANSWER (FILLED_FORM_ID, Q_ID, Q_ANSWER) VALUES ($newFormID, $i, '{$_GET[$i]}');";
    print "saving the data with ".$sql."<br><br>";
    $conn->query($sql);

}

header("refresh:3; url=../student_dashboard.php");
print "form saved successfully, now go back to home, thank you!";
die();