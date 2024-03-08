<?php
session_start();
if(!isset($_SESSION['U_ID'])){
    header("refresh:3; url=admin_login.php");
    die("you did not log in, going to admin log in page in 3 seconds");
}
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
                <li><a href="profile.php">Profile</a></li>
                <li><a href="saved-forms.php">My Saved Forms</a></li>
                <li><a href="support.php">Contact Support</a></li>
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
        <div class="tab" onclick="openTab('applications');">Applications</div>
        <div class="tab" onclick="openTab('reports');">Reports</div>
        <div class="tab" onclick="openTab('historicalApps');">Historical Applications</div>
        <div class="tab" onclick="openTab('residents');">Residents Management</div>
    </div>
    <div id="dashboard" class="tab-content active-content">
        <!-- Dashboard Here -->
    </div>
    <div id="applications" class="tab-content">
        <!-- Applications Here -->
    </div>
    <div id="reports" class="tab-content">
        <!-- Reports Here -->
    </div>
    <div id="historicalApps" class="tab-content">
        <!-- Historical Applications Here -->
    </div>
    <div id="residents" class="tab-content">
        <a href="uploadcsv.php">Go Upload CSV File From THD System</a>
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
