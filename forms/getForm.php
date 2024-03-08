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

print "welcome user ".$_SESSION['U_ID']."<br>";

print "this page checks if user filled forms and print them if they had, or let user to fill a new form<br>";

$conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT FORM_FILLED.FILLED_FORM_ID FROM FORM_FILLED INNER JOIN FORM_USER ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID WHERE FORM_USER.U_ID = {$_SESSION['U_ID']} AND FORM_FILLED.FORM_ID = {$_GET['id']}";
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
    print "you have not filled this form yet. ";
}



if ($conn->query("SELECT MAX_USER_PER_FORM FROM FORM_TYPE WHERE FORM_ID = {$_GET['id']}")->fetch_assoc()['MAX_USER_PER_FORM'] > 1){ //if this form supports multiple people to fill
    print "<br>this form can display forms filled by roommates as well<br>";

    $roommates = $conn->query("SELECT U_ID FROM USER WHERE HALL = (SELECT HALL FROM USER WHERE U_ID = {$_SESSION['U_ID']}) AND (SUBSTRING(ROOM,1,2) = (SELECT SUBSTRING(ROOM,1,2) FROM USER WHERE U_ID = {$_SESSION['U_ID']}) OR SUBSTRING(ROOM,1,4) = (SELECT SUBSTRING(ROOM,1,4) FROM USER WHERE U_ID = {$_SESSION['U_ID']}))");

    if($roommates->num_rows > 1){
        while ($roommate = $roommates->fetch_assoc()) {

            if ($roommate['U_ID'] == $_SESSION['U_ID']){
                continue;//because the SQL statement return all people living in the same room as the request user, it return everyone in the unit so we exclude the poeple themselves.
            }

            print "we have find you are roommates with:";
           print $roommate['U_ID']."<br>";

           $rforms = $conn->query("SELECT FORM_FILLED.FILLED_FORM_ID FROM FORM_FILLED INNER JOIN FORM_USER ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID WHERE FORM_USER.U_ID = {$roommate['U_ID']} AND FORM_FILLED.FORM_ID = {$_GET['id']}");
           
           if($rforms->num_rows > 0){
                    while ($row = $rforms->fetch_assoc()) {
                        print "your roommate {$roommate['U_ID']} have already filled the form:";
                    print $row['FILLED_FORM_ID']."  ";
                    print "click here to go to see that form <a href='formDetail.php?filled={$row['FILLED_FORM_ID']}'>click me</a>";
                    print "<br>";
                    }

                }else{
                    print "your roommate {$roommate['U_ID']} have not filled the form yet:";
                }

           print "<br>";
        }
    }else{
        print "you do not have other roommates, so we won't show any roommates filled form here. ";
    }
    
    
}


print "please fill this form with link <a href='formDetail.php?form={$_GET['id']}'>this link please</a>";

?>