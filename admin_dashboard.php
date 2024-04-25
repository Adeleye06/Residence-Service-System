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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/css/style_admin_dashboard.css">
    <style>

        .container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
            padding: 1rem;
        }

        .box {
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        .box-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .box-value {
            font-size: 2rem;
            font-weight: bold;
        }

        .box-icon {
            font-size: 3rem;
            margin-bottom: 0.5rem;
        }

        .chart-container {
            grid-column: span 2;
        }

        .chart {
            height: 200px;
        }

        .tips-container {
            grid-column: span 4;
            padding: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .tips-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .tips-list {
            list-style-type: none;
            padding: 0;
        }

        .tips-item {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
<header class="site-header">
        <img src="assets/images/lc-logo.png" alt="Lethbridge College Logo" class="logo">
        <nav>
            <ul>
                <!-- <li><a href="profile.php">Profile</a></li>
                <li><a href="saved-forms.php">My Saved Forms</a></li>
                <li><a href="support.php">Contact Support</a></li> -->
                <li><a href="help.html">Help</a></li>
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
    <?php
    echo "<h1>Welcome, " . $_SESSION["F_NAME"]."</h1>";
    ?>
</div>
<div class="tabs-container">
    <div class="tabs">
        <div class="tab active" onclick="openTab('dashboard');">Dashboard</div>
        <div class="tab" onclick="openTab('forms');">Forms</div>
<!--        <div class="tab" onclick="openTab('reports');">Reports</div>-->
        <div class="tab" onclick="openTab('user');">User Management</div>
        <div class="tab" onclick="openTab('management');">Other Management</div>
    </div>
    <div id="dashboard" class="tab-content active-content">
        <!-- Dashboard Here -->
        <div class="container">
            <div class="box">
                <i class="fas fa-database box-icon"></i>
                <div class="box-title">Form Filled Today</div>
                <div class="box-value">8</div>
            </div>
            <div class="box">
                <i class="fas fa-users box-icon"></i>
                <div class="box-title">System Access Today</div>
                <div class="box-value">7</div>
            </div>
            <div class="box">
                <i class="fas fa-chart-pie box-icon"></i>
                <div class="box-title">Submitted Form Types</div>
                <div class="chart-container">
                    <canvas id="pie-chart" class="chart"></canvas>
                </div>
            </div>
            <div class="box">
                <i class="fas fa-chart-line box-icon"></i>
                <div class="box-title">System Access Count</div>
                <div class="chart-container">
                    <canvas id="line-chart" class="chart"></canvas>
                </div>
            </div>
            <div class="tips-container">
                <div class="tips-title">Tips</div>
                <ul class="tips-list">
                    <li class="tips-item">Import new residents regularly when they move in, and always create admin accounts with strong passwords. You can input the same emails to update accounts detail in accounts management page.</li>
                </ul>
            </div>
        </div>

        <script>
            // Pie chart
            const pieChart = document.getElementById('pie-chart');
            const pieChartData = {
                labels: ['Roommate Agreement Form', 'Guest Registration Form'],
                datasets: [{
                    data: [62, 38],
                    backgroundColor: ['#FF6384', '#36A2EB']
                }]
            };
            const pieChartConfig = {
                type: 'pie',
                data: pieChartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            };
            const pieChartInstance = new Chart(pieChart, pieChartConfig);

            // Line chart
            const lineChart = document.getElementById('line-chart');
            const lineChartData = {
                labels: ['Apr 19', 'Apr 20', 'Apr 21', 'Apr 22', 'Apr 23', 'Apr 24', 'Apr 25'],
                datasets: [{
                    label: 'Data',
                    data: [30, 24, 23, 57, 23, 33, 7],
                    borderColor: '#36A2EB',
                    backgroundColor: '#36A2EB',
                    fill: false
                }]
            };
            const lineChartConfig = {
                type: 'line',
                data: lineChartData,
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            };
            const lineChartInstance = new Chart(lineChart, lineChartConfig);
        </script>



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
