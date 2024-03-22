
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
    echo "<h1>See all forms</h1>";
    echo "<h2>This page lists all the submitted forms in the system avaliable for you to view</h2>";
        $conn = database();

        $forms = $conn->query("SELECT * FROM FORM_FILLED JOIN FORM_TYPE ON FORM_FILLED.FORM_ID = FORM_TYPE.FORM_ID ORDER BY FORM_FILLED.TIME");

        if ($forms -> num_rows > 0){
            echo "<table>";
            echo "<tr>
<th>Form ID</th>
<th>Form Type</th>
<th>Submitted Time</th>
<th>Residents</th>
<th>Options</th>
</tr>";
            while($form = $forms -> fetch_assoc()){
                echo "<tr>";
                print "<td>".$form['FILLED_FORM_ID']."</td>";
                print "<td>".$form['FORM_NAME']."</td>";
                print "<td>".$form['TIME']."</td>";
                $agreed = $conn -> query("SELECT F_NAME, L_NAME, ROOM FROM FORM_USER INNER JOIN USER ON FORM_USER.U_ID = USER.U_ID WHERE FORM_USER.FILLED_FORM_ID = {$form['FILLED_FORM_ID']}");
                if ($agreed -> num_rows == 0){
                echo "<td>"."EMPTY!"."</td>";
            }else{
                    echo "<td>";
                while ($user = $agreed->fetch_assoc()){
                   echo "(".$user['ROOM'].") ".$user['F_NAME']." ".$user['L_NAME']."<br>";
                }
                echo "</td>";
            }
            print "<td><a href='formDetail.php?filled={$form['FILLED_FORM_ID']}'>View</a></td>";
            print "</tr>";
        }
        echo "</table>";
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
