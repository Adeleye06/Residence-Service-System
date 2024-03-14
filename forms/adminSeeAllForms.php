
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
                    <li><a href="../logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        
            <div class="ribbon">
        <p>Home &gt; Admin Dashboard &gt; All Forms </p>
    </div>

    <div class="content-section">

    <?php

    session_start();
    require "../database.php";
    require "../authentication.php";
    quitIfNotAdmin();
        $conn = database();

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
            print "<a href='formDetail.php?filled={$form['FILLED_FORM_ID']}'>View</a>";
            print "<br><br>";
        }
    }else{
        print "no saved forms for this one";
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
