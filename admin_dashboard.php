<?php
require "authentication.php";
quitIfNotAdmin();
?>

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
    
        <div class="hero-image">
            
        </div>

        <div class="ribbon">
    <p>Home &gt;&gt; Admin Dashboard</p>
</div>


<div class="content-section">    
</div>
<div class="tabs-container">
    <div class="tabs">
        <div class="tab active" onclick="openTab('dashboard');">Dashboard</div>
        <div class="tab" onclick="openTab('forms');">Forms</div>
        <div class="tab" onclick="openTab('reports');">Reports</div>
        <div class="tab" onclick="openTab('user');">User Management</div>
        <div class="tab" onclick="openTab('management');">Other Management</div>
    </div>
    <div id="dashboard" class="tab-content active-content">
        <!-- Dashboard Here -->
    </div>
    
    
    
    <div id="forms" class="tab-content">
    <button class="button" onclick="window.location.href='forms/adminSeeAllForms.php'">
    <img src="assets/icons/online-survey.svg" alt="Online Survey Icon" style="vertical-align: middle;">
    Check all forms in the system
</button><br>
<button class="button" onclick="window.location.href='unitList.php'">
    <img src="assets/icons/online-survey1.svg" alt="Online Survey Icon" style="vertical-align: middle;">
    Check forms based on unit
</button><br>
        
    </div>
    <div id="reports" class="tab-content">
        <!-- Reports Here -->
    </div>
    <div id="user" class="tab-content">
    <button class="button" onclick="window.location.href='uploadcsv.php'">
    <img src="assets/icons/file-upload.svg" alt="Online Survey Icon" style="vertical-align: middle;">
    Go Upload CSV File From THD System
</button><br>
<button class="button" onclick="window.location.href='userManagement.php'">
    <img src="assets/icons/customer-care.svg" alt="Online Survey Icon" style="vertical-align: middle;">
    Manage Users and Admins
</button><br>
        
    </div>
    <div id="management" class="tab-content">
    <button class="button" onclick="window.location.href='reminderManagement.php'">
    <img src="assets/icons/alert.svg" alt="Online Survey Icon" style="vertical-align: middle;">
    Manage Reminder
</button><br>

<button class="button" onclick="window.location.href='loginLogView.php'">
    <img src="assets/icons/data-encryption.svg" alt="Online Survey Icon" style="vertical-align: middle;">
    View Access Logs
</button><br>
        
<button class="button" onclick="window.location.href='emailLogView.php'">
    <img src="assets/icons/email.svg" alt="Online Survey Icon" style="vertical-align: middle;">
    View Email Sending Logs
</button><br>
        
    </div>
</div>

<script>
function openTab(tabId) {
    // Hide all the tab contents
    var tabsContent = document.querySelectorAll('.tab-content');
    tabsContent.forEach(function(content) {
        content.style.display = 'none';
        content.classList.remove('active-content');
    });

    // Remove the active class from all tabs
    var tabs = document.querySelectorAll('.tab');
    tabs.forEach(function(tab) {
        tab.classList.remove('active');
    });

    // Show the selected tab's content and add 'active' class to the tab
    document.getElementById(tabId).style.display = 'block';
    document.getElementById(tabId).classList.add('active-content');
    event.currentTarget.classList.add('active');
}
</script>

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
