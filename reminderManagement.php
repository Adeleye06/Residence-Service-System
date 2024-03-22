<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/style_reminderman.css">
</head>
<body>
<header class="site-header">
    <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
    <nav>
        <ul>
            <!-- <li><a href="profile.php">Profile</a></li>
            <li><a href="saved-forms.php">My Saved Forms</a></li>
            <li><a href="support.php">Contact Support</a></li> -->
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
</header>

<div class="ribbon">
    <p>Home &gt; Admin Dashboard &gt; Residents Import</p>
</div>


<div class="content-section">
    <?php
    require "authentication.php";
    require "database.php";
    quitIfNotAdmin();
    echo "<h1>Email Management</h1>";
    echo "<h2>This page allows you to update email settings like templates and set up automatic email reminder system.</h2>";

    $conn = database();
    if (isset($_GET['new'])){
        $FORM_ID = $conn -> real_escape_string($_GET['FORM_ID']);
        $REMINDER_DATE = $conn -> real_escape_string($_GET['REMINDER_DATE']);
        if ($_GET['REPEAT'] != "") {
            $REPEAT = $_GET['REPEAT'];
        } else {
            $REPEAT = "NULL";
        }
        $TEMPLATE_TEXT = $conn -> real_escape_string($_GET['TEMPLATE_TEXT']);

        $conn -> query("INSERT INTO EMAIL_TYPE (FORM_ID, REMINDER_DATE, TEMPLATE_TEXT, ENABLED, EMAIL_TYPE.REPEAT) VALUES ('$FORM_ID', '$REMINDER_DATE', '$TEMPLATE_TEXT', 1, $REPEAT)");
        header("refresh: 3,url=reminderManagement.php");
        die("new reminder is added, refreshing the page..");
    }
    if (isset($_GET['enable'])){
        $conn -> query("UPDATE EMAIL_TYPE SET ENABLED = 1 WHERE EMAIL_TYPE_ID = {$_GET['enable']}");
        header("refresh: 3,url=reminderManagement.php");
        die("this reminder is enabled, refreshing the page..");
    }
    if (isset($_GET['disable'])){
        $conn -> query("UPDATE EMAIL_TYPE SET ENABLED = 0 WHERE EMAIL_TYPE_ID = {$_GET['disable']}");
        header("refresh: 3,url=reminderManagement.php");
        die("this reminder is disabled, refreshing the page..");
    }

    $logs = $conn -> query("SELECT * FROM FORM_TYPE RIGHT JOIN EMAIL_TYPE ON EMAIL_TYPE.FORM_ID = FORM_TYPE.FORM_ID ORDER BY EMAIL_TYPE.FORM_ID");
    if ($logs -> num_rows == 0){die("<h3>No Email Reminders have been found. </h3>");}


    echo "<table>
<tr>
<th>Reminder ID</th>
<th>Enabled</th>
<th>Related Form (ID)</th>
<th>Template Texts</th>
<th>Next Sending Date</th>
<th>Repeat (days)</th>
<th>Actions</th>
</tr>";
    while ($log = $logs -> fetch_assoc()){
        echo "<tr>
    <td>{$log['EMAIL_TYPE_ID']}</td>";

        if ($log['ENABLED'] == "1"){
            echo "<td>Enabled</td>";
        }else{
            echo "<td>Not Enabled</td>";
        }

        if (isset($log['FORM_ID'])){
            echo "<td>{$log['FORM_NAME']} ({$log['FORM_ID']})</td>";
        }else{
            echo "<td>N/A</td>";
        }
        echo "
    <td>{$log['TEMPLATE_TEXT']}</td>";
        if (isset($log['REMINDER_DATE'])){
            echo "<td>{$log['REMINDER_DATE']}</td>";
        }else{
            echo "<td>N/A</td>";
        }
        if (isset($log['REPEAT'])){
            echo "<td>{$log['REPEAT']} Days</td>";
        }else{
            echo "<td>Not Repeating</td>";
        }
        echo "<td><a href='reminderManagement.php?enable={$log['EMAIL_TYPE_ID']}'>Enable</a>";
        echo "<a href='reminderManagement.php?disable={$log['EMAIL_TYPE_ID']}'>Disable</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br><h1>End of query</h1></br>";

    echo "
<h3>Set up a new automatic reminder</h3>
<form>
<label for='FORM_ID'>Related Form</label>
<input type='number' name='FORM_ID' required>
<label for='FORM_ID'>Reminder Date</label>
<input type='date' name='REMINDER_DATE' required>
<label for='FORM_ID'>Repeating Every ... (Days)</label>
<input type='number' name='REPEAT'>
<label for='FORM_ID'>Email Text Template</label>
<input type='text' name='TEMPLATE_TEXT' required>
<input type='submit' name='new' value='Create'>
</form>"

    ?>
</div>
<footer class="site-footer">
    <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="footer-logo">
    <p>3000 College Dr S, Lethbridge, Alberta, Canada, T1K 1L6</p>
    <p>1-800-572-0103</p>
    <nav>
        <a href="contact.php">Contacts and Maps</a>
    </nav>
</footer>

</body>
</html>
