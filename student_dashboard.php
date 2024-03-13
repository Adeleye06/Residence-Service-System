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
                <!-- <li><a href="profile.php">Profile</a></li> -->
                <!-- <li><a href="saved-forms.php">My Saved Forms</a></li> -->
                <!-- <li><a href="support.php">Contact Support</a></li> -->
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>
    
        <div class="hero-image">
                        
        </div>
        <div class="ribbon">
        <nav>
        <ul>
            <li><a href="index.php">Home</a> <span>&gt;&gt;</span></li>
            <li><a href="student_dashboard.php">Student Dashboard</a></li>
        </ul>
        </nav>
    
</div>
<div class="content-section">
    
</div>

<div class="content-section">
    <h1>Welcome, <?php require "authentication.php"; quitIfNotStudent(); echo($_SESSION['F_NAME']) ?>!</h1>
    <p class="subtitle">Choose the form type you'd like to fill.</p>
    <div class="tabs-container">
        <div class="tabs">
            <div class="tab active" onclick="openTab('studentForm');">Roommate Agreement Form</div>
            <div class="tab" onclick="openTab('guestForm');">Guest Registration Form</div>
        </div>
        <div id="studentForm" class="tab-content active-content">
            <p>Roommate Agreement Form is a form that is required for all resident, you need to fill it every semester if you have roommates. You should do it with your roommates together, so you can make rules of living together and know each other.</p>
            <a href="forms/getForm.php?id=2">Click this to go to the form</a>
        </div>
        <div id="guestForm" class="tab-content">
        <p>Guest form is required for you to fill when you have a overnight guest you would like to host in your residence unit. We ask you to fill this so we know who is there in emeregncy situation, and we would be able to issue you guest parking in the office when you fill this</p>
            <a href="forms/getForm.php?id=1">Click this to go to the form</a>
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
