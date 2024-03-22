<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style_forms.css"> 
</head>
<body>
<header class="site-header">
<a href="index.php">
    <img src="../assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
</a>

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
            <li><a href="formDetail.php">Form Detail</a></li>
        </ul>
    </nav>
</div>

<div class="content-section">
    <?php
    session_start();
    require "../database.php";
    require "../authentication.php";
    quitIfNotLoggedIn();

    if (isset($_GET['form'])){
        echo "<h1>New Form</h1><br>";

        $conn = database();
        
        $sql = "SELECT * FROM QUESTION WHERE FORM_ID = {$_GET['form']}";
        $result = $conn->query($sql);

        if($result->num_rows > 0){
            echo "<form action='saveForm.php'>";
            echo "<input type='hidden' name='FORM_ID' value='{$_GET['form']}' >";

            while ($row = $result->fetch_assoc()) {
                echo "<strong>Q.".$row['Q_ID']."</strong><br>";
                echo "".$row['Q_HTML']."<br>";
                echo "".$row['A_HTML']."<br><br>";
            }

        } else {
            die("We did not find any questions in the database. There is an error.");
        }

        echo "<div class='button-container'>";
        echo "<button class='button' type='submit'>Submit</button>";
        echo "<a href='../student_dashboard.php' class='button'>Cancel</a>";
        echo "</div>";

    } else if (isset($_GET['filled'])) {
        echo "<h1>Saved Form ID {$_GET['filled']}</h1>";
        echo "<div class='button-container'>";
        echo "<input type='button' value='Print this page' onClick='window.print()' class='button'>";
        echo "</div>";
        $viewingRoommateForms = false;

        $conn = database();

        if (isset($_SESSION['USER_TYPE'])){
            // This user is an admin then, display regardless
            $time = $conn->query("SELECT TIME FROM FORM_FILLED WHERE FORM_FILLED.FILLED_FORM_ID = {$_GET['filled']}");
        } else {
            // Verify this form is filled by the person logged in, also display the time submitted
            $time = $conn->query("SELECT TIME FROM FORM_FILLED INNER JOIN FORM_USER ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID WHERE FORM_USER.U_ID = {$_SESSION['U_ID']} AND FORM_FILLED.FILLED_FORM_ID = {$_GET['filled']}");
            
            if ($time->num_rows != 1) {
                // This form is not filled by the person trying to log in, let's try and see if it is filled by the roommate?
                $roommates = $conn->query("SELECT U_ID FROM USER WHERE HALL = (SELECT HALL FROM USER WHERE U_ID = {$_SESSION['U_ID']}) AND (SUBSTRING(ROOM,1,2) = (SELECT SUBSTRING(ROOM,1,2) FROM USER WHERE U_ID = {$_SESSION['U_ID']}) OR SUBSTRING(ROOM,1,4) = (SELECT SUBSTRING(ROOM,1,4) FROM USER WHERE U_ID = {$_SESSION['U_ID']}))");

                if($roommates->num_rows > 1){
                    while ($roommate = $roommates->fetch_assoc()) {
                        if ($roommate['U_ID'] == $_SESSION['U_ID']){
                            continue; // Because the SQL statement returns all people living in the same room as the request user, it returns everyone in the unit so we exclude the people themselves.
                        }

                        $time = $conn->query("SELECT FORM_FILLED.TIME FROM FORM_FILLED INNER JOIN FORM_USER ON FORM_FILLED.FILLED_FORM_ID = FORM_USER.FILLED_FORM_ID WHERE FORM_USER.U_ID = {$roommate['U_ID']} AND FORM_FILLED.FILLED_FORM_ID = {$_GET['filled']}");

                        if ($time->num_rows != 1) {
                            continue;
                        } else {
                            $viewingRoommateForms = true;
                            break;
                        }
                    }
                }
            }
        }

        // If we did not find the time then we kick the user out (regardless of if the form actually exists we always kick them out)
        if($time->num_rows != 1){
            die("You did not fill this form, or this form is not properly saved. Why are you trying to look at this?");
        }

        echo "Time Submitted: ".$time->fetch_assoc()['TIME']."<br><br><br>";
        
        $sql = "SELECT * FROM FORM_ANSWER WHERE FILLED_FORM_ID = {$_GET['filled']};";
        $answers = $conn->query($sql);

        if($answers->num_rows > 0){
            
            while ($row = $answers->fetch_assoc()) {
                echo "<strong>Q.".$row['Q_ID']."</strong>";
                $sql_q = "SELECT Q_HTML FROM QUESTION WHERE Q_ID = {$row['Q_ID']}";
                $q = $conn->query
                ($sql_q);
                if($q->num_rows == 1){
                    $question = $q->fetch_assoc();
                    echo "".$question['Q_HTML']."<br>"; // Display the question belonging to this answer
                } else {
                    echo("?? We did not find the question entry for this answer. There is an error.");
                }
                echo "<br>SAVED ANSWER: ".$row['Q_ANSWER']."<br><br>";
            }
        } else {
            die("We did not find any saved answer for this form. There is an error.");
        }

        if($viewingRoommateForms){
            echo 'You should try to agree to this form';
            echo "<a href='saveForm.php?agree={$_GET['filled']}' class='button'>I agree to this form</a>";
        }

    } else {
        header("refresh:3; url=home.php");
        echo "You did not do anything to come to this page. Please go back to home";
    }
    ?>
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
