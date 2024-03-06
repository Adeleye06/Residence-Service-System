<?php

session_start();
if(!isset($_SESSION['studentEmail'])){
    header("refresh:3; url=student_login.php");
    die("you did not log in, going to student log in page in 3 seconds");
}


if (isset($_GET['form'])){
    print "you are trying to fill a new form";
    die();
}

if (isset($_GET['filled'])){
    print "you are trying to view a filled form";
    die();
}

header("refresh:3; url=home.php");
print "you did not do anything to come to this page, please go back to home"

?>