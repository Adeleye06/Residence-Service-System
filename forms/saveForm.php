
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
    <p>Home &gt; Student Dashboard &gt; Form &gt; Form Detail &gt; Save Form</p>
</div>

<div class="content-section">

<?php

session_start();
require "../database.php";
if(!isset($_SESSION['studentEmail'])){
    header("refresh:3; url=student_login.php");
    die("you did not log in, going to student log in page in 3 seconds");
}

if(isset($_GET['agree'])){    //agreeing a form
    $conn = database();
//TODO: check if you can agree before allow you to agree
    $conn -> query("INSERT INTO FORM_USER (U_ID, FILLED_FORM_ID) VALUES ({$_SESSION['U_ID']}, {$_GET['agree']})");
    header("refresh:3; url=../student_dashboard.php");
    die("agreed successfully, now going back to the home");
}

if(!isset($_GET['FORM_ID'])){
    header("refresh:3; url=student_login.php");
    die("you did not come here with a formid, there is nothing to save!!");
}


$conn = database();

//create a new filled form entry
$sql = "INSERT INTO FORM_FILLED (FORM_ID, TIME) VALUES ({$_GET['FORM_ID']}, NOW())";
$conn->query($sql);
$newFormID = mysqli_insert_id($conn);

$sql2 = "INSERT INTO FORM_USER (U_ID, FILLED_FORM_ID) VALUES ({$_SESSION['U_ID']}, $newFormID)";
$conn -> query($sql2);

foreach ($_GET as $i => $value) {
    if ($i == "FORM_ID"){
        continue;//dont save the form id as answer!
    }

    $sql = "INSERT INTO FORM_ANSWER (FILLED_FORM_ID, Q_ID, Q_ANSWER) VALUES ($newFormID, $i, '$value');";
    print "saving the data with ".$sql."<br><br>";
    $conn->query($sql);

}

// for ($i=1; isset($_GET[$i]); $i++) { 
//     print "get answer data for question $i: ";
//     print ($_GET[$i])."<br>";

//     $sql = "INSERT INTO FORM_ANSWER (FILLED_FORM_ID, Q_ID, Q_ANSWER) VALUES ($newFormID, $i, '{$_GET[$i]}');";
//     print "saving the data with ".$sql."<br><br>";
//     $conn->query($sql);

// }

header("refresh:3; url=../student_dashboard.php");
print "form saved successfully, now go back to home, thank you!";
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
