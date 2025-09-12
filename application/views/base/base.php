<!-- File: application/views/base.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EV Charging Dashboard</title>
    <link rel="icon" href="<?php echo base_url('Images\logo.png'); ?>" type="image/png">

    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;
            background: #fafafa;
            margin: 0;
        }

        .wrapper {
            overflow-y: auto;
            display: flex;
            width: 100%;
        }

        .logo {
            background-color: #f1f1f1;
            width: 100%;
            padding: 10px 0;
            text-align: center;
        }

        .logo img {
            width: 220px;
            margin: 0 auto;
        }

        .line {
            width: 100%;
            height: 1px;
            border-bottom: 1px dashed #ddd;
            margin: 40px 0;
        }

        #sidebar {
            width: 280px;
            position: fixed;
            height: 100vh;
            z-index: 999;
            min-width: 280px;
            max-width: 280px;
            background: white;
            color: black;
            transition: all 0.3s;
            display: flex;
            flex-direction: column;
        }

        #sidebar.active {
            margin-left: -280px;
        }

        #sidebar .sidebar-header {
            padding: 10px;
            background: white;
        }

        #sidebar .sidebar-manasvi {
            display: none;
        }

        #sidebar ul.components {
            padding: 10px 0;
            flex-grow: 1;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
            min-height: 100vh;
        }

        #sidebar ul.components::-webkit-scrollbar {
            display: none;
        }

        #sidebar ul p {
            color: #fff;
            padding: 10px;
        }

        #sidebar ul li a {
            padding: 12px 15px;
            font-size: 1em;
            display: flex;
            align-items: center;
            color: black;
            text-decoration: none;
            position: relative;
        }

        #sidebar ul li a:hover {
            color: black;
            background: #fff;
            text-decoration: none;
        }

        #sidebar ul li.active > a,
        a[aria-expanded="true"] {
            color: black;
            background: #fff;
            text-decoration: none;
        }

        a[data-toggle="collapse"] {
            position: relative;
            text-decoration: none;
        }

        .dropdown-toggle::after {
            display: block;
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            transition: all 0.3s ease-in-out;
            border: none;
            content: "\f078";
            font-weight: 900;
            font-size: 12px;
        }

        a[aria-expanded="true"] .dropdown-toggle::after {
            transform: translateY(-50%) rotate(180deg);
        }

        ul ul.submenu {
            padding-left: 0 !important;
            background: white;
            color: black;
            max-height: 300px;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        ul ul.submenu::-webkit-scrollbar {
            display: none;
        }

        ul ul a {
            padding: 10px 15px 10px 45px !important;
            background: white;
            color: black;
            font-size: 0.9em;
        }

        ul ul a:hover {
            color: #0B2F8B;
            background: #fff;
        }

        ul.active {
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 5px;
            display: block;
            text-align: center;
        }

        .content {
            width: 100%;
            padding: 10px;
            transition: all 0.3s;
            margin-left: 280px;
        }

        .hidden {
            width: 0;
            display: none;
        }

        .hamburger-btn {
            background-color: transparent;
            border: none;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 30px;
            padding: 5px;
            transition: transform 0.3s;
        }

        .hamburger-line {
            width: 30px;
            height: 3px;
            background-color: #333;
            margin: 2px 0;
            transition: background-color 0.3s;
        }

        .hamburger-line.active {
            background-color: #000;
        }

        .hamburger-btn.toggled {
            transform: rotate(180deg);
        }

        #sidebar.active+.content {
            margin-left: 0;
            margin-right: 0;
            width: 100%;
        }

        .navbar {
            background-color: white;
            width: 100%;
            padding: 10px;
        }

        .container-fluid {
            padding: 0;
            margin: 0;
            width: 100%;
        }

        #datetime {
            font-size: 14px;
            color: #fff;
            padding: 10px 0;
            background: #0B2F8B;
        }

        #datetime span {
            font-weight: bold;
        }

        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar div.mt-2,
        .sidebar div.mt-4 {
            display: none;
        }
    </style>

    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }

        .box {
            border: 2px solid #888;
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 4px;
        }

        .box .icon {
            height: 62px;
            width: 62px;
            margin-left: 15px;
        }

        .box .text {
            text-align: right;
            font-size: 20px;
            margin-right: 15px;
        }

        .bold-number {
            font-size: 30px;
            font-weight: bold;
        }

        .station-box {
            padding: 16px;
            border-radius: 8px;
            color: black;
            text-align: center;
            margin-bottom: 8px;
        }

        .purple {
            background-color: #867ef8;
        }

        .red {
            background-color: #dc3545;
        }

        .green {
            background-color: #28a745;
        }

        .internal-box {
            border: 1px solid white;
            border-radius: 8px;
            background-color: #fff;
            margin: 10px 1px 5px 1px;
            width: 100%;
        }

        .internal-box i {
            font-size: 50px;
        }

        .internal-box .name {
            font-size: 20px;
        }

        .row-2-heading {
            color: #fff;
        }

        .custom-container {
            width: 100%;
            max-width: 700px;
            margin: auto;
            padding: 20px;
            border: 2px solid #888;
            border-radius: 8px;
            background-color: white;
            text-align: center;
        }

        .custom-station1 {
            border: 2px solid #888;
            border-radius: 8px;
            text-align: center;
            background: white;
            width: 100%;
        }

        .custom-station1 h5 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            background-color: #0B2F8B;
            color: white;
            padding: 19px;
        }

        .custom-station2 {
            border: 2px solid #888;
            border-radius: 8px;
            text-align: center;
            background: white;
            width: 100%;
        }

        .custom-station2 h5 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            background-color: #DC3545;
            color: white;
            padding: 19px;
        }

        .custom-station3 {
            border: 2px solid #888;
            border-radius: 8px;
            text-align: center;
            background: white;
            width: 100%;
        }

        .custom-station3 h5 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            background-color: #FEC007;
            color: white;
            padding: 19px;
        }

        .custom-station4 {
            border: 2px solid #888;
            border-radius: 8px;
            text-align: center;
            background: white;
            width: 100%;
        }

        .custom-station4 h5 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            background-color: #198654;
            color: white;
            padding: 19px;
        }

        .custom-station5 {
            border: 2px solid #888;
            border-radius: 8px;
            text-align: center;
            background: white;
            width: 100%;
        }

        .custom-station5 h5 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 15px;
            background-color: #0D6EFD;
            color: white;
            padding: 19px;
        }

        .custom-box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 12px;
            padding-bottom: 16px;
        }

        .custom-box {
            border: 2px solid #0000ff;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            min-width: 80px;
            width: 30%;
            position: relative;
        }

        .custom-bold-number {
            font-size: 24px;
            font-weight: bold;
        }

        .custom-button-container {
            display: flex;
            justify-content: center;
            margin-top: 10px;
        }

        .custom-button {
            min-width: 200px;
            font-size: 18px;
            padding: 10px 20px;
            background-color: #867ef8;
            color: white;
            border: none;
            border-radius: 8px;
            transition: 0.3s;
            margin-top: 7px;
        }

        .custom-button:hover {
            background-color: #6923d3;
        }

        @media (max-width: 768px) {
            .custom-box {
                width: 45%;
            }
        }

        #station_operators,
        #ev_users,
        #maintenance_technicians,
        #guests,
        #total_count,
        #certified_station_operators,
        #certified_ev_users,
        #certified_maintenance_technicians,
        #certified_guests,
        #certified_total,
        #uncertified_station_operators,
        #uncertified_ev_users,
        #uncertified_guests,
        #uncertified_total,
        #uncertified_maintenance,
        #guest_count {
            font-size: 24px;
            font-weight: bold;
        }

        .custom-box i {
            position: absolute;
            top: 5px;
            right: 5px;
            font-size: 16px;
            color: #000;
        }

        .custom-station1 h5::before,
        .custom-station2 h5::before,
        .custom-station3 h5::before,
        .custom-station4 h5::before,
        .custom-station5 h5::before {
            content: "Live Charging Count";
            font-size: 14px;
            margin-right: 5px;
            color: white;
        }

        .btn-success {
            color: #fff !important;
        }

        #total_staff {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header">
                <div class="logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url('assets\Images\logo.png'); ?>" class="img-fluid" alt="EV Logo"
                            style="max-width: 300px;"></a></div>
            </div>
            <ul class="list-unstyled components font-weight">
                <li class="active">
                    <div class="sidebar fs-5 mx-1">
                        <ul class="nav flex-column" id="nav_accordion">
                            <li id="dashboardMenuItem" style="color:white;">
                                <a href="<?php echo base_url('Superadmin/dashboard'); ?>"><i class="fas fa-home"></i> Dashboard</a>
                            </li>
                            <li id="stationsMenuItem">
                                <a href="#Stations" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <i class="fas fa-charging-station"></i> Charging Stations</a>
                                <ul class="collapse list-unstyled submenu" id="Stations">
                                    <li><a href="<?php echo base_url('Superadmin/managestations'); ?>">Manage Stations</a></li>
                                    <li><a href="<?php echo base_url('Superadmin/chargerstatus'); ?>">Charger Status</a></li>
                                    <li><a href="<?php echo base_url('Superadmin/softwareupdates'); ?>">Software Updates</a></li>
                                </ul>
                            </li>
                            <li id="usersMenuItem">
                                <a href="#Users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <i class="fas fa-users"></i> Users</a>
                                <ul class="collapse list-unstyled submenu" id="Users">
                                    <li><a href="<?php echo base_url('Superadmin/usermanagement'); ?>">User Management</a></li>
                                    <li><a href="<?php echo base_url('Superadmin/authentication'); ?>">Authentication</a></li>
                                    <li><a href="<?php echo base_url('Superadmin/userdata'); ?>">User Data</a></li>
                                </ul>
                            </li>
                            <li id="sessionsMenuItem">
                                <a href="#Sessions" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <i class="fas fa-plug"></i> Charging Sessions</a>
                                <ul class="collapse list-unstyled submenu" id="Sessions">
                                    <li><a href="<?php echo base_url('Superadmin/realtimesessions'); ?>">Real-time Sessions</a></li>
                                    <li><a href="<?php echo base_url('Superadmin/sessionhistory'); ?>">Session History</a></li>
                                </ul>
                            </li>
                            <li id="energyMenuItem">
                                <a href="#Energy" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <i class="fas fa-bolt"></i> Energy Management</a>
                                <ul class="collapse list-unstyled submenu" id="Energy">
                                    <li><a href="<?php echo base_url('Superadmin/powerusage'); ?>">Power Usage</a></li>
                                    <li><a href="<?php echo base_url('Superadmin/loadsharing'); ?>">Load Sharing</a></li>
                                    <li><a href="<?php echo base_url('Superadmin/systemalert'); ?>">System Alerts</a></li>
                                </ul>
                            </li>
                            <li id="paymentsMenuItem">
                                <a href="#Payments" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <i class="fas fa-credit-card"></i> Payments</a>
                                <ul class="collapse list-unstyled submenu" id="Payments">
                                    <li><a href="<?php echo base_url('Superadmin/PaymentProcessing'); ?>">Payment Processing</a></li>
                                    <li><a href="<?php echo base_url('Superadmin/revenuereport'); ?>">Revenue Reports</a></li>
                                </ul>
                            </li>
                            <li id="settingsMenuItem">
                                <a href="#settings" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                    <i class="fas fa-cog"></i> Settings</a>
                                <ul class="collapse list-unstyled submenu" id="settings">
                                    <li><a href="<?php echo base_url('Superadmin/generalsettings'); ?>">General Settings</a></li>
                                    <li><a href="<?php echo base_url('Superadmin/monetizationsettings'); ?>">Monetization</a></li>
                                </ul>
                            </li>
                            <li id="reportMenuItem">
                                <a href="<?php echo base_url('Superadmin/report'); ?>"><i class="fas fa-file-alt"></i> Report</a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>

        <div class="content" id="abc">
            <div class="container-fluid">
                <div class="navbar text-center" style="box-shadow: 10px 10px 10px 10px rgba(0, 0, 0, 0.1);">
                    <button type="button" id="sidebarCollapse" class="btn text-center my-auto" style="color: black;">
                        <i class="fa fa-navicon" style="font-size: 26px;"></i>
                    </button>
                    <a class="navbar-brand d-block" id="navbarHeading"
                        style="font-weight: 900;color:black; margin: 0 auto;">EV Charging Dashboard</a>
                    <p style="font-size: 18px; font-weight: bold; color: black; margin-top: 10px; margin-bottom: 10px;">
                        <span><?php echo isset($username) && $username === 'admin' ? 'Admin' : (isset($username) ? $username : ''); ?></span>
                    </p>
                    <a href="<?php echo base_url('logout'); ?>" class="btn btn-danger me-3" style="margin-left: 10px;">Logout</a>
                </div>
            </div>
            <!-- Placeholder for dynamic content -->
            <?php echo isset($content) ? $content : ''; ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const menuItems = document.querySelectorAll(".nav.flex-column > li");

            menuItems.forEach(menuItem => {
                menuItem.addEventListener("click", function () {
                    menuItems.forEach(item => {
                        if (item !== menuItem && item.classList.contains("active")) {
                            item.classList.remove("active");
                            const submenu = item.querySelector(".submenu");
                            if (submenu) {
                                new bootstrap.Collapse(submenu).hide();
                            }
                        }
                    });

                    menuItem.classList.toggle("active");
                });
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#abc').toggleClass('expanded');

                if ($('#abc').hasClass('expanded')) {
                    $('#abc').css('width', '100%');
                    $('#abc').css('margin-left', '0');
                    $('#abc').css('margin-right', '0');
                } else {
                    $('#abc').css('width', '');
                    $('#abc').css('margin-left', '280px');
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var navbarHeading = document.getElementById("navbarHeading");
            var sectionName = localStorage.getItem("sectionName");

            if (sectionName) {
                navbarHeading.textContent = sectionName;
            }

            var sidebarLinks = document.querySelectorAll("#sidebar a");

            sidebarLinks.forEach(function (link) {
                link.addEventListener("click", function (event) {
                    var sectionName = link.textContent.trim();
                    navbarHeading.textContent = sectionName;
                    localStorage.setItem("sectionName", sectionName);
                    event.preventDefault();
                    window.location.href = link.getAttribute("href");
                });
            });
        });
    </script>
    <script>
        function updateDateTime() {
            const datetimeElement = document.getElementById("datetime");
            const currentTime = new Date();
            const options = {year: 'numeric', month: 'numeric', day: 'numeric'};
            const options2 = {hour: '2-digit', minute: '2-digit', second: '2-digit'};
            const formattedDate = currentTime.toLocaleDateString('en-US', options);
            const formattedTime = currentTime.toLocaleTimeString('en-US', options2);
            const formattedDateTime = "NOW: " + formattedDate + " @ " + formattedTime;
            datetimeElement.textContent = formattedDateTime;
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            if (window.location.pathname === "/" || window.location.pathname === "<?php echo base_url('login'); ?>") {
                localStorage.setItem("sectionName", "Dashboard");
                document.getElementById("navbarHeading").textContent = "Dashboard";
            }
        });
    </script>
</body>
</html>