<style>
#sidebar {
    width: 280px;
    position: fixed;
    top: 60px;
    left: 0;
    height: calc(100vh - 60px);
    z-index: 1000;
    background: white;
    color: black;
    transition: width 0.3s ease;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}
#sidebar::-webkit-scrollbar {
    display: none;
}
#sidebar.active {
    width: 80px;
}
#sidebar .sidebar-header {
   
    text-align: center;
    transition: padding 0.3s ease; /* Smooth padding transition */
}
/* #sidebar.active .sidebar-header {
    padding: 15px 4px; /* Reduced padding for minimized state */
} */
#sidebar .sidebar-header img {
    max-width: 80%; /* Matches reference code for maximized state */
    height: 155px; /* Matches reference code for prominent logo */
    transition: all 0.3s ease; /* Smooth transition for size and height */
}
#sidebar.active .sidebar-header img {
   max-width: 72px;
    height: 109px;
}
#sidebar.active ul.components li a {
    font-size: 0;
    text-align: center;
}
#sidebar.active ul.components li a i {
    font-size: 18px;
    margin-right: 0;
}
#sidebar.active ul ul {
    display: none;
}
/* #sidebar ul.components {
    padding: 10px 0;
} */
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
.sidebar-toggle {
    position: absolute;
    top: 10px;
    right: 10px;
    background: none;
    border: none;
    font-size: 20px;
    color: black;
    cursor: pointer;
    padding: 5px;
    transition: all 0.3s ease;
    z-index: 1001;
}
.sidebar-toggle:hover {
    color: #0B2F8B;
}
@media (max-width: 768px) {
    #sidebar {
        width: 100%;
        left: -100%;
        transition: left 0.3s ease, width 0.3s ease;
        top: 60px;
        height: calc(100vh - 60px);
    }
    #sidebar.active {
        left: 0;
        width: 80px;
    }
    #sidebar:not(.active) {
        width: 100%;
    }
    #sidebar.active .sidebar-header img {
        max-width: 20px; /* Small size for tablet when minimized */
        /* height: 20px; */
        margin-top:27px
    }
    #sidebar.active ul.components li a {
        font-size: 0;
        text-align: center;
    }
    #sidebar.active ul.components li a i {
        font-size: 16px;
        margin-right: 0;
    }
    #sidebar.active ul ul {
        display: none;
    }
}
@media (max-width: 480px) {
    #sidebar {
        width: 100%;
    }
    #sidebar.active {
        width: 60px;
    }
    #sidebar.active .sidebar-header img {
        max-width: 15px; /* Small size for small screens when minimized */
        height: 15px; /* Matches minimized size */
    }
    .sidebar-toggle {
        font-size: 18px;
        padding: 3px;
    }
}
</style>
<nav id="sidebar">
    <button type="button" id="sidebarToggle" class="sidebar-toggle">
        <i class="fas fa-chevron-left"></i>
    </button>
    <div class="sidebar-header text-center">
        <a href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url('assets/Images/logo1.png'); ?>" class="img-fluid" alt="EV Logo">
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