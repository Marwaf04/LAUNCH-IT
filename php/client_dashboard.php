<?php
session_start();
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>

    <!-- Link to CSS -->
    <link rel="stylesheet" href="css/customerStyles.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Poppins&display=swap" rel="stylesheet">

    <!-- Material Symbols Outlined -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>

<body>
    <div class="grid-container">

        <!-- Header -->
        <header class="header1">
            <!-- Sidebar Icon -->
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-symbols-outlined">menu</span>
            </div>

            <!-- Header Left -->
            <div class="header-left">
                <span class="material-symbols-outlined icon">search</span>
            </div>

            <!-- Header Right -->
            <div class="header-right">
                <span class="material-symbols-outlined icon">notifications</span>
                <span class="material-symbols-outlined icon">mail</span>
                <span class="material-symbols-outlined icon">account_circle</span>

                <!-- User Info -->
                <div class="user-info">
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
                </div>

                <!-- Logout Button -->
                <button class="logout-btn" onclick="window.location.href='logout.php';">Logout</button>
            </div>
        </header>
        <!-- End Header -->

        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <span class="material-symbols-outlined">dashboard</span> Dashboard
                </div>
                <span class="material-symbols-outlined" onclick="closeSidebar()">close</span>
            </div>
            <ul class="sidebar-list">
                <li class="Sidebar-list-item">
                    <span class="material-symbols-outlined">search</span> Search Services
                </li>
                <li class="Sidebar-list-item">
                    <span class="material-symbols-outlined">assignment</span> My Requests
                </li>
                <li class="Sidebar-list-item">
                    <span class="material-symbols-outlined">history</span> Service History
                </li>
                <li class="Sidebar-list-item">
                    <span class="material-symbols-outlined">payment</span> Payments
                </li>
                <li class="Sidebar-list-item"> 
                    <a href="setting.html" style="text-decoration: none; color: inherit;">
                        <span class="material-symbols-outlined">settings</span> Settings
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main -->
        <main class="main-container">
            <div class="main-title">
                <p class="text-weight-bold">CUSTOMER DASHBOARD</p>
            </div>

            <div class="main">
                <!-- Search Services -->
                <div class="div1">
                    <div class="div1-inner">
                        <p class="text-primary">Search Services</p>
                        <span class="material-symbols-outlined text-blue">search</span>
                    </div>
                    <button onclick="window.location.href='cart.html';">Search Now</button>
                </div>

                <!-- Request Service -->
                <div class="div1">
                    <div class="div1-inner">
                        <p class="text-primary">Request Service</p>
                        <span class="material-symbols-outlined text-green">assignment</span>
                    </div>
                    <button onclick="window.location.href='request.html';">Request</button>
                </div>

                <!-- Service History -->
                <div class="div1">
                    <div class="div1-inner">
                        <p class="text-primary">Service History</p>
                        <span class="material-symbols-outlined text-orange">history</span>
                    </div>
                    <button onclick="window.location.href='OverviewServices.php';">View</button>
                </div>

                <!-- Payments -->
                <div class="div1">
                    <div class="div1-inner">
                        <p class="text-primary">Payments</p>
                        <span class="material-symbols-outlined text-red">payment</span>
                    </div>
                    <button onclick="managePayments()">Manage</button>
                </div>
            </div>
        </main>
    </div>

    <script src="js/customerDashboard.js"></script>
</body>

</html>
