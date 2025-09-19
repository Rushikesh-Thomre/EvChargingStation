<style>
    .navbar {
        background-color: white;
        width: 100%;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1001;
    }
    .navbar-toggle {
        background: none;
        border: none;
        font-size: 20px;
        color: black;
        cursor: pointer;
        padding: 5px;
        transition: all 0.3s ease;
        display: none; /* Hidden by default */
    }
    .navbar-toggle:hover {
        color: #0B2F8B;
    }
    @media (max-width: 768px) {
        .navbar {
            justify-content: space-between; /* Adjusted for toggle button */
            flex-direction: row; /* Keep row layout */
            gap: 10px;
        }
        .navbar-toggle {
            display: block; /* Show toggle button in mobile view */
            position: absolute;
            left: 10px; /* Left side of navbar */
            top: 50%;
            transform: translateY(-50%);
        }
        .navbar-brand {
            font-size: 1.2em;
            margin: 0 auto; /* Center the brand */
        }
        .navbar div {
            text-align: right;
            margin-right: 10px;
        }
    }
    @media (max-width: 480px) {
        .navbar {
            padding: 8px;
        }
        .navbar-toggle {
            font-size: 18px;
            padding: 3px;
        }
        .navbar-brand {
            font-size: 1em;
        }
        .navbar div p {
            font-size: 16px;
        }
        .navbar div a.btn {
            padding: 6px 12px;
            font-size: 14px;
        }
    }
</style>
<div class="container-fluid">
    <div class="navbar text-center">
        <button type="button" id="navbarToggle" class="navbar-toggle">
            <i class="fas fa-bars"></i> <!-- Hamburger icon for mobile -->
        </button>
        <a class="navbar-brand d-block" id="navbarHeading" style="font-weight: 900; color: black; margin: 0 auto;">
            EV Charging Dashboard
        </a>
        <div>
            <p style="font-size: 18px; font-weight: bold; color: black; margin: 10px 0;">
                <span><?php echo isset($username) && $username === 'admin' ? 'Admin' : (isset($username) ? $username : ''); ?></span>
            </p>
           <a href="<?php echo base_url('Superadmin/profile'); ?>">
    <img src="<?php echo base_url('assets/Images/circle2.jpg'); ?>" alt="Profile Picture" style="width: 40px; height: 40px;" class="rounded-full ml-3 mr-2 object-cover cursor-pointer transition duration-200 hover:opacity-80">
</a>
            <a href="<?php echo base_url('login'); ?>" class="btn btn-danger me-3" style="margin-left: 10px;">Logout</a>
        </div>
    </div>
</div>