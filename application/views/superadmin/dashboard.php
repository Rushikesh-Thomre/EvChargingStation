<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>EV Charging Dashboard</title>
    <link rel="icon" href="<?php echo base_url('Images/logo.png'); ?>" type="image/png">

    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;
            background: #fafafa;
            margin: 0;
        }

        .wrapper {
            display: flex;
            width: 100%;
            flex-direction: column; /* Ensure vertical stacking */
        }

        .logo {
            background-color: #f1f1f1;
            width: 100%;
            padding: 5px 0; /* Reduced padding */
            text-align: center;
        }

        .logo img {
            width: 200px; /* Slightly reduced logo size */
            margin: 0 auto;
        }

        .line {
            width: 100%;
            height: 1px;
            border-bottom: 1px dashed #ddd;
            margin: 10px 0; /* Reduced margin to minimize space */
        }

        .content {
            width: 100%;
            padding: 0; /* Removed padding to reduce space */
            transition: all 0.3s;
        }

        .container-fluid {
            padding: 0; /* Remove Bootstrap default padding */
        }

        #datetime {
            font-size: 14px;
            color: #fff;
            padding: 8px 0; /* Reduced padding */
            background: #0B2F8B;
            margin: 0; /* Removed margin-top to eliminate gap */
            text-align: center;
        }

        #datetime span {
            font-weight: bold;
        }

        /* Dashboard Specific Styles with Glassy Effect */
        .dashboard-container {
            width: 100%;
            padding: 15px; /* Reduced padding */
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            gap: 15px; /* Reduced gap */
        }

        .dashboard-row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px; /* Reduced gap */
            justify-content: space-between;
        }

        .custom-station1, .custom-station2, .custom-station3, .custom-station4 {
            flex: 1;
            min-width: 0;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            padding: 10px; /* Reduced padding */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .custom-station1 h5, .custom-station2 h5, .custom-station3 h5, .custom-station4 h5 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px; /* Reduced margin */
            color: white;
            padding: 6px; /* Reduced padding */
            border-radius: 6px 6px 0 0;
        }

        .custom-station1 h5 { background-color: #0B2F8B; }
        .custom-station2 h5 { background-color: #DC3545; }
        .custom-station3 h5 { background-color: #FEC007; }
        .custom-station4 h5 { background-color: #198654; }

        .custom-station1 h5::before,
        .custom-station2 h5::before,
        .custom-station3 h5::before,
        .custom-station4 h5::before {
            content: "Live Status";
            font-size: 10px;
            margin-right: 4px;
            color: white;
        }

        .custom-station1:hover, .custom-station2:hover, .custom-station3:hover, .custom-station4:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        .custom-box-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px; /* Reduced gap */
        }

        .custom-box {
            border: 1px solid rgba(0, 0, 255, 0.2);
            border-radius: 8px;
            padding: 8px; /* Reduced padding */
            text-align: center;
            min-width: 100px;
            flex: 1 1 calc(33.33% - 10px);
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            transition: transform 0.3s ease;
        }

        .custom-box:hover {
            transform: scale(1.05);
        }

        .custom-bold-number {
            font-size: 18px;
            font-weight: bold;
            color: #fff;
        }

        .custom-button-container {
            display: flex;
            justify-content: center;
            margin-top: 10px; /* Reduced margin */
        }

        .custom-button {
            min-width: 150px;
            font-size: 14px;
            padding: 8px 16px; /* Reduced padding */
            background: rgba(134, 126, 248, 0.3);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: black;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .custom-button:hover {
            background: rgba(105, 35, 211, 0.5);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        @media (max-width: 1024px) {
            .custom-box {
                flex: 1 1 calc(50% - 10px);
            }
        }

        @media (max-width: 480px) {
            .custom-box {
                flex: 1 1 100%;
            }

            .dashboard-row {
                flex-direction: column;
            }

            .custom-station1 h5, .custom-station2 h5, .custom-station3 h5, .custom-station4 h5 {
                font-size: 14px;
                padding: 5px;
            }

            .custom-bold-number {
                font-size: 16px;
            }

            .custom-button {
                min-width: 120px;
                font-size: 12px;
                padding: 6px 10px;
            }
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <?php $this->load->view('base/base') ?>

    <div class="wrapper">
        <div class="content">
            <div class="container-fluid">
                <div id="datetime"></div>
                <!-- Dashboard Content -->
                <div class="dashboard-container">
                    <h2 style="text-align: center; font-weight: bold; margin-bottom: 10px; font-size: 20px;">EV Charging Station Dashboard</h2>
                    
                    <div class="dashboard-row">
                        <div class="custom-station1">
                            <h5>Active Stations</h5>
                            <div class="custom-box-container">
                                <div class="custom-box">
                                    <span class="custom-bold-number">25</span>
                                    <p>Total Active</p>
                                    <i class="fas fa-charging-station"></i>
                                </div>
                            </div>
                        </div>
                        <div class="custom-station2">
                            <h5>Charging Sessions</h5>
                            <div class="custom-box-container">
                                <div class="custom-box">
                                    <span class="custom-bold-number">10</span>
                                    <p>Live Sessions</p>
                                    <i class="fas fa-plug"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-row">
                        <div class="custom-station3">
                            <h5>Energy Consumption</h5>
                            <div class="custom-box-container">
                                <div class="custom-box">
                                    <span class="custom-bold-number">150.5 kWh</span>
                                    <p>Today</p>
                                    <i class="fas fa-bolt"></i>
                                </div>
                            </div>
                        </div>
                        <div class="custom-station4">
                            <h5>Station Status</h5>
                            <div class="custom-box-container">
                                <div class="custom-box">
                                    <span class="custom-bold-number">20</span>
                                    <p>Online</p>
                                    <i class="fas fa-check-circle"></i>
                                </div>
                                <div class="custom-box">
                                    <span class="custom-bold-number">5</span>
                                    <p>Offline</p>
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="custom-button-container">
                        <a href="<?php echo base_url('stations'); ?>" class="custom-button">Manage Stations</a>
                    </div>
                </div>
            </div>
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
        function updateDateTime() {
            const datetimeElement = document.getElementById("datetime");
            const currentTime = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'numeric', day: 'numeric' };
            const options2 = { hour: '2-digit', minute: '2-digit', hour12: true };
            const formattedDate = currentTime.toLocaleDateString('en-IN', options);
            const formattedTime = currentTime.toLocaleTimeString('en-IN', options2).toUpperCase();
            const formattedDateTime = `${formattedDate} @ ${formattedTime} IST`;
            datetimeElement.textContent = formattedDateTime;
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>