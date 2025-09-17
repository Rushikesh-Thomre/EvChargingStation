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
    @media (max-width: 768px) {
        .navbar {
            justify-content: center;
            flex-direction: column;
            gap: 10px;
        }
        .navbar-brand {
            font-size: 1.2em;
        }
        .navbar div {
            text-align: center;
        }
    }
    @media (max-width: 480px) {
        .navbar {
            padding: 8px;
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