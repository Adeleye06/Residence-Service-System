<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/style_admin_dashboard.css">
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
echo "<h1>Email Log Viewing</h1>";
echo "<h2>This page allows you to view all emails being sent by the system. This allows you to tract the system email performance.</h2>";

$conn = database();
$logs = $conn -> query("SELECT * FROM EMAIL_LOG JOIN USER ON EMAIL_LOG.U_ID = USER.U_ID ORDER BY DATE");
if ($logs -> num_rows == 0){die("<h3>No Email Logs have been found. </h3>");}


echo "<table>
<tr>
<th>Log ID</th>
<th>Email Type</th>
<th>Sent To (User ID)</th>
<th>Sent To (Email)</th>
<th>Sent Time</th>
</tr>";

while ($log = $logs -> fetch_assoc()){

echo "<tr>
    <td>{$log['EMAIL_ID']}</td>
    <td>{$log['EMAIL_TYPE_ID']}</td>
    <td>{$log['U_ID']}</td>
    <td>{$log['EMAIL']}</td>
    <td>{$log['DATE']}</td>
</tr>";

}
echo "</table>";
echo "<h1>End of query<h1>";
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
