
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style_student_dashboard.css"> 
</head>
<body>
<header class="site-header">
        <img src="../assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
        <nav>
            <ul>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
    <div class="ribbon">
        <nav>
        <ul>
            <li><a href="index.php">Home</a> <span>&gt;&gt;</span></li>
            <li><a href="student_dashboard.php">Student Dashboard</a> <span>&gt;&gt;</span></li>
            <li><a href="getForm.php">Forms</a> <span>&gt;&gt;</span> </li>
            <li><a href="formDetail.php">Form Detail</a>
        </ul>
        </nav>
    
</div>

<div class="content-section">

<?php
session_start();
require "../database.php";
if(!isset($_SESSION['studentEmail'])){
    header("refresh:3; url=student_login.php");
    die("you did not log in, going to student log in page in 3 seconds");
}


if (isset($_GET['form'])){
    print "you are trying to fill a new form<br><br>";

    $conn = database();

    
    $sql = "SELECT * FROM QUESTION WHERE FORM_ID = {$_GET['form']}";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
print "<form action='saveForm.php'>";

        print "<input type='hidden' name='FORM_ID' value='{$_GET['form']}' >";

        while ($row = $result->fetch_assoc()) {
           print "question number ".$row['Q_ID']."<br>";
           print "question is ".$row['Q_HTML']."<br>";
           print "answer is ".$row['A_HTML']."<br><br>";;
        }

    }else{
        die("we did not find any question in the database, there is a error");
    }

    print "<button type='submit'>submit</button></form>";

}else

if (isset($_GET['filled'])){
    print "<h1>Saved Form ID {$_GET['filled']}</h1>";
    $viewingRoommateForms = false;

    $conn = database();

    //verify this form is filled by the person logged in, also display the time submitted
    $time = $conn->query("SELECT TIME FROM FORM_FILLED INNER JOIN FORM_USER ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID WHERE FORM_USER.U_ID = {$_SESSION['U_ID']} AND FORM_FILLED.FILLED_FORM_ID = {$_GET['filled']}");
    if ($time->num_rows != 1){
        //this form is not filled by the person trying to log in, let's try and see if it is filled by the roommate?
        $roommates = $conn->query("SELECT U_ID FROM USER WHERE HALL = (SELECT HALL FROM USER WHERE U_ID = {$_SESSION['U_ID']}) AND (SUBSTRING(ROOM,1,2) = (SELECT SUBSTRING(ROOM,1,2) FROM USER WHERE U_ID = {$_SESSION['U_ID']}) OR SUBSTRING(ROOM,1,4) = (SELECT SUBSTRING(ROOM,1,4) FROM USER WHERE U_ID = {$_SESSION['U_ID']}))");

        if($roommates->num_rows > 1){
            while ($roommate = $roommates->fetch_assoc()) {
    
                if ($roommate['U_ID'] == $_SESSION['U_ID']){
                    continue;//because the SQL statement return all people living in the same room as the request user, it return everyone in the unit so we exclude the poeple themselves.
                }

                $time = $conn->query("SELECT FORM_FILLED.TIME FROM FORM_FILLED INNER JOIN FORM_USER ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID WHERE FORM_USER.U_ID = {$roommate['U_ID']} AND FORM_FILLED.FILLED_FORM_ID = {$_GET['filled']}");

                if ($time->num_rows != 1){
                    continue;
                }else{
                    $viewingRoommateForms = true;
                    break;
                }
            }
        }
    }

    //if we did not find the time then we kick the user out (regardless of if the form actually exist we alwasy kick them out)
    if($time->num_rows != 1){
        die("you did not fill this form, or this form is not properly saved, why are you trying to look at this?");
    }
    print "Time Submitted: ".$time->fetch_assoc()['TIME']."<br><br><br>";
    
    $sql = "SELECT * FROM FORM_ANSWER WHERE FILLED_FORM_ID = {$_GET['filled']};";

    $answers = $conn->query($sql);

    if($answers->num_rows > 0){
        print "now displaying form question and saved answer<br><br>";
        
                while ($row = $answers->fetch_assoc()) {
                   print "<br>QUESTION # ".$row['Q_ID']."<br>";
                    $sql_q = "SELECT Q_HTML FROM QUESTION WHERE Q_ID = {$row['Q_ID']}";
                    $q = $conn->query($sql_q);
                    if($q ->num_rows == 1){
                        $question = $q->fetch_assoc();
                        print $question['Q_HTML']; //we display the question belong to this answer
                    }else{
                        print("??we did not find the question entry for this answer, there is error");
                    }


                   print "<br>SAVED ANSWER: ".$row['Q_ANSWER']."<br><br>";
                }


        
            }else{
                die("we did not find any saved asnwer for this form, there is a error");
    }

    if($viewingRoommateForms){
        //check if you have already agreed
        // $agreed = $conn->query("SELECT U_ID FROM FORM_USER WHERE FILLED_FORM_ID = {$_GET['filled']}");
        // while ($agreed -> fetch_assoc()['U_ID'] == $_SESSION['U_ID']){
        //         print 'you have already agreed to this form that your roommate filled';
        //         die();
        // }
        //if not then agree it
        //since this will only trigger when you have not agree
        //and when you agree it won't trigger
        //we don't need a check anymore
        print 'you should try agree to this form';
        print "<a href='saveForm.php?agree={$_GET['filled']}'>i agree to this form</a>";
    }


}else{
    header("refresh:3; url=home.php");
    print "you did not do anything to come to this page, please go back to home";
}

?>


</div>



    <footer class="site-footer">
        <img src="../assets/images/lc-logo.png" alt="Lethbridge College Logo" class="footer-logo">
        <p>3000 College Dr S, Lethbridge, Alberta, Canada, T1K 1L6</p>
        <p>1-800-572-0103</p>
        <nav>
            <a href="contact.php">Contacts and Maps</a>
        </nav>
    </footer>

   
</body>

</html>
