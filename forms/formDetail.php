<?php

session_start();
if(!isset($_SESSION['studentEmail'])){
    header("refresh:3; url=student_login.php");
    die("you did not log in, going to student log in page in 3 seconds");
}


if (isset($_GET['form'])){
    print "you are trying to fill a new form<br><br>";

    $conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "SELECT * FROM QUESTION WHERE FORM_ID = {$_GET['form']}";

    $result = $conn->query($sql);

    if($result->num_rows > 0){
print "<form action='saveForm.php'>";

        print "<input type='hidden' name='formid' value='{$_GET['form']}' >";

        while ($row = $result->fetch_assoc()) {
           print "question number ".$row['Q_ID']."<br>";
           print "question is ".$row['Q_HTML']."<br>";
           print "answer is ".$row['A_HTML']."<br><br>";;
        }

    }else{
        die("we did not find any question in the database, there is a error");
    }

    print "<button type='submit'>submit</button></form>";
    die();
}

if (isset($_GET['filled'])){
    print "you are trying to view a filled form<br><br>";

    $conn = new mysqli("172.22.2.116", "res", "Password1", "residence", "1433");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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

    die();
}

header("refresh:3; url=home.php");
print "you did not do anything to come to this page, please go back to home"

?>