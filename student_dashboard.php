<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="assets/css/style_student_dashboard.css"> 
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
    <p>Home &gt;&gt; Student Dashboard</p>
</div>
<div class="content-section">
    
</div>

<div class="content-section">
    <h1>Welcome, [Username]!</h1>
    <p class="subtitle">Choose the form type you'd like to fill.</p>
    <div class="tabs-container">
        <div class="tabs">
            <div class="tab active" onclick="openTab('studentForm');">Student Form Submission</div>
            <div class="tab" onclick="openTab('guestForm');">Guest Form Submission</div>
        </div>
        <div id="studentForm" class="tab-content active-content">
            <!-- Student Form Content Goes Here -->
        </div>
        <div id="guestForm" class="tab-content">
            <!-- Guest Form Content Goes Here -->
        </div>
    </div>
</div>


<script>
    function openTab(tabName) {
    var i, tabcontent, tabs;
    tabcontent = document.getElementsByClassName("tab-content");
    tabs = document.getElementsByClassName("tab");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
        tabcontent[i].classList.remove("active-content");
    }
    for (i = 0; i < tabs.length; i++) {
        tabs[i].classList.remove("active");
    }
    document.getElementById(tabName).style.display = "block";
    document.getElementById(tabName).classList.add("active-content");
    
    event.currentTarget.classList.add("active");
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
