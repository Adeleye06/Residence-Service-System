
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style_get_form.css"> 
    <style>
        .content-section {
            display: flex;
        }
        .left-column {
            flex: 1;
            padding-right: 1em;
        }
        .right-column {
            flex: 1;
            padding-left: 1em;
        }
        iframe {
            width: 100%;
            height: 600px; 
            border: none;
        }
    </style>
</head>
<body>
<header class="site-header">
<a href="index.php">
    <img src="../assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
</a>

    <nav>
        <ul>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </nav>
</header>
    
<div class="ribbon">
    <nav>
        <ul>
            <li><a href="index.php">Home</a> <span>&gt;&gt;</span></li>
            <li><a href="../student_dashboard.php">Student Dashboard</a> <span>&gt;&gt;</span></li>
            <li><a href="getForm.php">Forms</a></li>
        </ul>
    </nav>
</div>

<div class="content-section">
    <div class="left-column">
    <?php
        session_start();
        require "../database.php";
        require "../authentication.php";
        quitIfNotLoggedIn();

        if (!isset($_GET['id'])){
            header("refresh:3; url=chooseforms.php");
            die("you did not choose a form yet, going to choose in 3 seconds");
        }

        print "<h1>Welcome ".$_SESSION['F_NAME']."<br></br></h1>";
        print "<p>If you or your roommate have filled this form before, you will be able to refer back to them. Or you can choose to fill a new form. <br></br></p>";

        $conn = database();

        $sql = "SELECT FORM_FILLED.FILLED_FORM_ID FROM FORM_FILLED INNER JOIN FORM_USER ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID WHERE FORM_USER.U_ID = {$_SESSION['U_ID']} AND FORM_FILLED.FORM_ID = {$_GET['id']}";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            while ($row = $result->fetch_assoc()) {
                print "<p>Your Filled Form ";
                print $row['FILLED_FORM_ID'];
                print ": <button class='review-button' onclick='document.getElementById(\"right-iframe\").src=\"formDetail.php?filled={$row['FILLED_FORM_ID']}\"'>Review This Form</button></p>";
                print "<br>";
            }
        } else {
            print "You have not filled this form yet. ";
        }

        if ($conn->query("SELECT MAX_USER_PER_FORM FROM FORM_TYPE WHERE FORM_ID = {$_GET['id']}")->fetch_assoc()['MAX_USER_PER_FORM'] > 1){ 
            print "<br>It appears this form is a collaborative form that you can fill with your roommates. <br>";

            $roommates = $conn->query("SELECT U_ID FROM USER WHERE HALL = (SELECT HALL FROM USER WHERE U_ID = {$_SESSION['U_ID']}) AND (SUBSTRING(ROOM,1,2) = (SELECT SUBSTRING(ROOM,1,2) FROM USER WHERE U_ID = {$_SESSION['U_ID']}) OR SUBSTRING(ROOM,1,4) = (SELECT SUBSTRING(ROOM,1,4) FROM USER WHERE U_ID = {$_SESSION['U_ID']}))");

            if($roommates->num_rows > 1){
                while ($roommate = $roommates->fetch_assoc()) {
                    if ($roommate['U_ID'] == $_SESSION['U_ID']){
                        continue;
                    }
                    print "It looks like you are roommates with User ID ";
                    print $roommate['U_ID'].": <br>";

                    $rforms = $conn->query("SELECT FORM_FILLED.FILLED_FORM_ID FROM FORM_FILLED INNER JOIN FORM_USER ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID WHERE FORM_USER.U_ID = {$roommate['U_ID']} AND FORM_FILLED.FORM_ID = {$_GET['id']}");
                    
                    if($rforms->num_rows > 0){
                        while ($row = $rforms->fetch_assoc()) {
                            print "<p>Your roommate {$roommate['U_ID']} have already filled the form ";
                            print $row['FILLED_FORM_ID'];
                            print ", click <button class='review-button' onclick='document.getElementById(\"right-iframe\").src=\"formDetail.php?filled={$row['FILLED_FORM_ID']}\"'>here</button> to review that form. </p>";
                        }
                    } else {
                        print "Your roommate {$roommate['U_ID']} have not filled the form yet.";
                    }
                    print "<br>";
                }
            } else {
                print "The system's record does not show you have any other roommate, so we won't show any roommate filled form here. ";
            }
        }
        print "<button class='review-button' onclick='document.getElementById(\"right-iframe\").src=\"formDetail.php?form={$_GET['id']}\"'>Fill A New Form</button>";
    ?>
    </div>
    <div class="right-column">
        <iframe id="right-iframe" src="" frameborder="0"></iframe>
    </div>
</div>
<footer class="site-footer">
<a href="index.php">
    <img src="../assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
</a>


    <p>3000 College Dr S, Lethbridge, Alberta, Canada, T1K 1L6</p>
    <p>1-800-572-0103</p>
    <nav>
        <a href="contact.php">Contacts and Maps</a>
    </nav>
</footer>

</body>
</html>
