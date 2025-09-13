<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV Charging Dashboard</title>
    <link rel="icon" href="<?php echo base_url('Images/logo.png'); ?>" type="image/png">
    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;
            background: #fafafa;
            margin: 0;
            overflow-x: hidden;
        }
        .wrapper {
            display: flex;
            width: 100%;
        }
        #sidebar {
            width: 280px;
            position: fixed;
            height: 100vh;
            z-index: 999;
            background: white;
            color: black;
            transition: all 0.3s ease;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        #sidebar::-webkit-scrollbar {
            display: none;
        }
        #sidebar.active {
            margin-left: -280px;
        }
        #sidebar ul.components {
            padding: 10px 0;
        }
        #sidebar ul li {
            margin-bottom: 5px;
        }
        #sidebar ul li a {
            padding: 12px 15px;
            font-size: 18px;
            display: block;
            color: black;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        #sidebar ul li a:hover {
            color: #0B2F8B;
            background: #f1f1f1;
        }
        #sidebar ul li a i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }
        .dropdown-toggle::after {
            float: right;
            margin-top: 5px;
            border: none;
            content: "\f078";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            transition: transform 0.3s ease;
        }
        .dropdown-toggle[aria-expanded="true"]::after {
            transform: rotate(180deg);
        }
        ul ul {
            padding-left: 20px;
            background: #f8f9fa;
            display: none;
        }
        ul ul.show {
            display: block;
        }
        ul ul a {
            font-size: 0.9em;
            padding: 10px 15px;
            display: block;
        }
        ul ul a:hover {
            color: #0B2F8B;
            background: #f1f1f1;
        }
        .content {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 10px;
            transition: all 0.3s ease;
        }
        .content.expanded {
            margin-left: 0;
            width: 100%;
        }
        .navbar {
            background-color: white;
            width: 100%;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        @media (max-width: 768px) {
            #sidebar {
                margin-left: -280px;
            }
            #sidebar.active {
                margin-left: 0;
            }
            .content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar">
            <div class="sidebar-header p-3 text-center">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url('assets/Images/logo1.png'); ?>" class="img-fluid" alt="EV Logo" style="max-width: 220px;">
                </a>
            </div>
            <ul class="list-unstyled components mb-0">
                <li>
                    <a href="<?php echo base_url('Superadmin/dashboard'); ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-target="#stationsSubmenu">
                        <i class="fas fa-charging-station"></i> Charging Stations
                    </a>
                    <ul class="list-unstyled" id="stationsSubmenu">
                        <li><a href="<?php echo base_url('Superadmin/managestations'); ?>">Manage Stations</a></li>
                        <li><a href="<?php echo base_url('Superadmin/chargerstatus'); ?>">Charger Status</a></li>
                        <li><a href="<?php echo base_url('Superadmin/softwareupdates'); ?>">Software Updates</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-target="#usersSubmenu">
                        <i class="fas fa-users"></i> Users
                    </a>
                    <ul class="list-unstyled" id="usersSubmenu">
                        <li><a href="<?php echo base_url('Superadmin/usermanagement'); ?>">User Management</a></li>
                        <li><a href="<?php echo base_url('Superadmin/authentication'); ?>">Authentication</a></li>
                        <li><a href="<?php echo base_url('Superadmin/userdata'); ?>">User Data</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-target="#sessionsSubmenu">
                        <i class="fas fa-plug"></i> Charging Sessions
                    </a>
                    <ul class="list-unstyled" id="sessionsSubmenu">
                        <li><a href="<?php echo base_url('Superadmin/realtimesessions'); ?>">Real-time Sessions</a></li>
                        <li><a href="<?php echo base_url('Superadmin/sessionhistory'); ?>">Session History</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-target="#energySubmenu">
                        <i class="fas fa-bolt"></i> Energy Management
                    </a>
                    <ul class="list-unstyled" id="energySubmenu">
                        <li><a href="<?php echo base_url('Superadmin/powerusage'); ?>">Power Usage</a></li>
                        <li><a href="<?php echo base_url('Superadmin/loadsharing'); ?>">Load Sharing</a></li>
                        <li><a href="<?php echo base_url('Superadmin/systemalert'); ?>">System Alerts</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-target="#paymentsSubmenu">
                        <i class="fas fa-credit-card"></i> Payments
                    </a>
                    <ul class="list-unstyled" id="paymentsSubmenu">
                        <li><a href="<?php echo base_url('Superadmin/PaymentProcessing'); ?>">Payment Processing</a></li>
                        <li><a href="<?php echo base_url('Superadmin/revenuereport'); ?>">Revenue Reports</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="dropdown-toggle" data-target="#settingsSubmenu">
                        <i class="fas fa-cog"></i> Settings
                    </a>
                    <ul class="list-unstyled" id="settingsSubmenu">
                        <li><a href="<?php echo base_url('Superadmin/generalsettings'); ?>">General Settings</a></li>
                        <li><a href="<?php echo base_url('Superadmin/monetizationsettings'); ?>">Monetization</a></li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo base_url('Superadmin/report'); ?>">
                        <i class="fas fa-file-alt"></i> Report
                    </a>
                </li>
            </ul>
        </nav>
        <div class="content" id="abc">
            <div class="container-fluid">
                <div class="navbar text-center">
                    <button type="button" id="sidebarCollapse" class="btn text-center my-auto" style="color: black;">
                        <i class="fa fa-navicon" style="font-size: 26px;"></i>
                    </button>
                    <a class="navbar-brand d-block" id="navbarHeading" style="font-weight: 900; color: black; margin: 0 auto;">
                        EV Charging Dashboard
                    </a>
                    <div>
                        <p style="font-size: 18px; font-weight: bold; color: black; margin: 10px 0;">
                            <span><?php echo isset($username) && $username === 'admin' ? 'Admin' : (isset($username) ? $username : ''); ?></span>
                        </p>
                        <a href="<?php echo base_url('login'); ?>" class="btn btn-danger me-3" style="margin-left: 10px;">Logout</a>
                    </div>
                </div>
            </div>
            <!-- Placeholder for dynamic content -->
            <?php echo isset($content) ? $content : ''; ?>
        </div>
    </div>

      
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            // Toggle sidebar
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $('#abc').toggleClass('expanded');
            });

            // Handle dropdown toggle
            $('.dropdown-toggle').on('click', function(e) {
                e.preventDefault();
                var target = $(this).data('target');

                // Close all other open menus
                $('.list-unstyled').not(target).removeClass('show');

                // Toggle current menu
                $(target).toggleClass('show');

                // Update aria-expanded attribute
                $(this).attr('aria-expanded', $(this).attr('aria-expanded') === 'true' ? 'false' : 'true');
            });

            // Update navbar heading based on clicked link
            const sidebarLinks = document.querySelectorAll("#sidebar a:not(.dropdown-toggle)");
            sidebarLinks.forEach(link => {
                link.addEventListener("click", function () {
                    const sectionName = link.textContent.trim();
                    document.getElementById("navbarHeading").textContent = sectionName;
                    localStorage.setItem("sectionName", sectionName);
                });
            });

            // Set default section name for login or root path
            if (window.location.pathname === "/" || window.location.pathname === "<?php echo base_url('login'); ?>") {
                localStorage.setItem("sectionName", "Dashboard");
                document.getElementById("navbarHeading").textContent = "Dashboard";
            } else {
                const savedSection = localStorage.getItem("sectionName");
                if (savedSection) {
                    document.getElementById("navbarHeading").textContent = savedSection;
                }
            }
        });
    </script>

   
</body>
</html>
