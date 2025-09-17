<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV Charging Dashboard</title>
    <link rel="icon" href="<?php echo base_url('Images/logo.png'); ?>" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #1a73e8;
            --secondary: #4A90E2;
            --success: #28a745;
            --danger: #dc3545;
            --warning: #ffc107;
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #333;
            --white: #ffffff;
            --shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            --border-radius: 10px;
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Montserrat', sans-serif !important;
            background: #fafafa;
            margin: 0;
            overflow-x: hidden;
            font-size: 14px;
        }

        .wrapper {
            display: flex;
            width: 100%;
            min-height: calc(100vh - 60px);
            margin-top: 60px;
        }

        .content {
            margin-left: 280px;
            width: calc(100% - 280px);
            padding: 10px;
            transition: var(--transition);
            min-height: calc(100vh - 60px);
        }

        .content.expanded {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        #datetime {
            font-size: 12px;
            color: #333;
            padding: 10px 0;
            background: #e6f0ff;
            margin-top: 10px;
            text-align: center;
            border-radius: 5px;
        }

        #datetime span {
            font-weight: bold;
        }

        .dashboard-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 25px;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .dashboard-title {
            font-size: 18px;
            font-weight: 800;
            color: var(--primary);
        }

        .dashboard-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .card {
            flex: 1;
            min-width: 250px;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 20px;
            transition: var(--transition);
            cursor: pointer;
            border: 1px solid #e0e0e0;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
        }

        .card-value {
            font-size: 24px;
            font-weight: 700;
            color: var(--primary);
            margin: 10px 0;
        }

        .card-subtitle {
            font-size: 12px;
            color: var(--dark);
            margin-bottom: 10px;
        }

        .card-icon {
            font-size: 24px;
            color: var(--secondary);
        }

        .chart-container {
            height: 200px;
            margin-top: 15px;
            width: 100%;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1002;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: var(--white);
            padding: 20px;
            border-radius: var(--border-radius);
            width: 100%;
            max-width: 1000px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-height: 80vh;
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .modal-content::-webkit-scrollbar {
            display: none;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        .modal-title {
            font-size: 14px;
            font-weight: 700;
            color: var(--primary);
        }

        .close {
            color: var(--dark);
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: var(--danger);
        }

        .modal-body {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .modal-section {
            flex: 1;
            min-width: 300px;
        }

        .modal-section h4 {
            font-size: 14px;
            font-weight: 600;
            color: var(--primary);
        }

        .modal-section p, .modal-section ul li {
            font-size: 12px;
            color: var(--dark);
        }

        .modal-chart-container {
            height: 300px;
            margin-top: 20px;
            width: 100%;
        }

        .modal.active ~ .wrapper #sidebar,
        .modal.active ~ .wrapper .content {
            filter: blur(5px);
            transition: filter 0.3s ease;
        }

        #sidebar,
        .content {
            filter: none;
            transition: filter 0.3s ease;
        }

        @media (max-width: 991px) {
            .content {
                margin-left: 0;
                width: 100%;
            }

            .content.expanded {
                margin-left: 80px;
                width: calc(100% - 80px);
            }

            .dashboard-container {
                padding: 15px;
            }

            .dashboard-title {
                font-size: 14px;
            }

            .dashboard-row {
                flex-direction: column;
                gap: 15px;
            }

            .card {
                min-width: 100%;
            }

            .modal-content {
                max-width: 95%;
                padding: 15px;
            }

            .modal-body {
                flex-direction: column;
                gap: 15px;
            }

            .modal-section {
                min-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .content {
                padding: 5px;
            }

            .content.expanded {
                margin-left: 60px;
                width: calc(100% - 60px);
            }

            .dashboard-container {
                padding: 10px;
            }

            .dashboard-header {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .dashboard-title {
                font-size: 12px;
            }

            .card {
                min-width: 100%;
                padding: 15px;
            }

            .card-title {
                font-size: 12px;
            }

            .card-value {
                font-size: 20px;
            }

            .card-subtitle, .modal-section p, .modal-section ul li {
                font-size: 10px;
            }

            .card-icon {
                font-size: 20px;
            }

            .chart-container {
                height: 150px;
            }

            .modal-chart-container {
                height: 200px;
            }

            .modal-content {
                padding: 10px;
                max-width: 90%;
            }

            .modal-title {
                font-size: 12px;
            }

            .modal-section h4 {
                font-size: 12px;
            }
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <?php $this->load->view('base/navbar'); ?>
    <div class="wrapper">
        <?php $this->load->view('base/sidebar'); ?>
        <div class="content" id="abc">
            <div class="container-fluid">
                <div id="datetime"></div>
                <div class="dashboard-container">
                    <div class="dashboard-header">
                        <h2 class="dashboard-title">EV Charging Station Dashboard</h2>
                    </div>
                    <div class="dashboard-row">
                        <!-- Total Chargers Card -->
                        <div class="card" onclick="showModal('totalChargers')">
                            <div class="card-header">
                                <h5 class="card-title">Total Chargers</h5>
                                <i class="fas fa-charging-station card-icon"></i>
                            </div>
                            <div class="card-value">204000</div>
                            <div class="card-subtitle">99.5% Operational</div>
                            <div class="chart-container">
                                <canvas id="totalChargersChart"></canvas>
                            </div>
                        </div>
                        <!-- Available Chargers Card -->
                        <div class="card" onclick="showModal('availableChargers')">
                            <div class="card-header">
                                <h5 class="card-title">Available Chargers</h5>
                                <i class="fas fa-plug card-icon" style="color: var(--success);"></i>
                            </div>
                            <div class="card-value">183600</div>
                            <div class="card-subtitle">90% Availability</div>
                            <div class="chart-container">
                                <canvas id="availableChargersChart"></canvas>
                            </div>
                        </div>
                        <!-- In Use Chargers Card -->
                        <div class="card" onclick="showModal('inUseChargers')">
                            <div class="card-header">
                                <h5 class="card-title">In Use Chargers</h5>
                                <i class="fas fa-bolt card-icon" style="color: var(--warning);"></i>
                            </div>
                            <div class="card-value">10200</div>
                            <div class="card-subtitle">20% Utilization</div>
                            <div class="chart-container">
                                <canvas id="inUseChargersChart"></canvas>
                            </div>
                        </div>
                        <!-- Unavailable Chargers Card -->
                        <div class="card" onclick="showModal('unavailableChargers')">
                            <div class="card-header">
                                <h5 class="card-title">Unavailable Chargers</h5>
                                <i class="fas fa-exclamation-triangle card-icon" style="color: var(--danger);"></i>
                            </div>
                            <div class="card-value">2040</div>
                            <div class="card-subtitle">1% Downtime</div>
                            <div class="chart-container">
                                <canvas id="unavailableChargersChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Station Details Row -->
                    <div class="dashboard-row">
                        <!-- Tesla Station Card -->
                        <div class="card" onclick="showModal('teslaStation')">
                            <div class="card-header">
                                <h5 class="card-title">Tesla Station</h5>
                                <i class="fas fa-car card-icon"></i>
                            </div>
                            <div class="card-subtitle">Type: DC</div>
                            <div class="card-value">2.5 miles</div>
                            <div class="card-subtitle">Price: $0.35/kWh</div>
                            <div class="card-subtitle">Slots: 12</div>
                        </div>
                        <!-- Benz Station Card -->
                        <div class="card" onclick="showModal('benzStation')">
                            <div class="card-header">
                                <h5 class="card-title">Benz Station</h5>
                                <i class="fas fa-car card-icon"></i>
                            </div>
                            <div class="card-subtitle">Type: DC</div>
                            <div class="card-value">3.8 miles</div>
                            <div class="card-subtitle">Price: $0.42/kWh</div>
                            <div class="card-subtitle">Slots: 8</div>
                        </div>
                        <!-- Nissan Station Card -->
                        <div class="card" onclick="showModal('nissanStation')">
                            <div class="card-header">
                                <h5 class="card-title">Nissan Station</h5>
                                <i class="fas fa-car card-icon"></i>
                            </div>
                            <div class="card-subtitle">Type: DC</div>
                            <div class="card-value">2.6 miles</div>
                            <div class="card-subtitle">Price: $0.28/kWh</div>
                            <div class="card-subtitle">Slots: 10</div>
                        </div>
                        <!-- SUV Station Card -->
                        <div class="card" onclick="showModal('suvStation')">
                            <div class="card-header">
                                <h5 class="card-title">SUV Station</h5>
                                <i class="fas fa-car card-icon"></i>
                            </div>
                            <div class="card-subtitle">Type: DC</div>
                            <div class="card-value">1.6 miles</div>
                            <div class="card-subtitle">Price: $0.22/kWh</div>
                            <div class="card-subtitle">Slots: 16</div>
                        </div>
                    </div>
                    <!-- Station Usage and Location Row -->
                    <div class="dashboard-row">
                        <!-- Station Usage Card -->
                        <div class="card" onclick="showModal('stationUsage')">
                            <div class="card-header">
                                <h5 class="card-title">Station Usage</h5>
                                <i class="fas fa-chart-line card-icon"></i>
                            </div>
                            <div class="card-subtitle">Last 30 Days</div>
                            <div class="modal-chart-container">
                                <canvas id="stationUsageChart"></canvas>
                            </div>
                        </div>
                        <!-- Station Location Card -->
                        <div class="card" onclick="showModal('stationLocation')">
                            <div class="card-header">
                                <h5 class="card-title">Station Location</h5>
                                <i class="fas fa-map-marker-alt card-icon"></i>
                            </div>
                            <div class="modal-chart-container">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215393916234!2d-73.987844924164!3d40.7484409713896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1712345678910!5m2!1sen!2sus" width="100%" height="300" style="border:0; border-radius: var(--border-radius);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                    <!-- Environment and Revenue Row -->
                    <div class="dashboard-row">
                        <!-- Environment Card -->
                        <div class="card" onclick="showModal('environment')">
                            <div class="card-header">
                                <h5 class="card-title">Environment</h5>
                                <i class="fas fa-leaf card-icon" style="color: var(--success);"></i>
                            </div>
                            <div class="card-subtitle">You've avoided</div>
                            <div class="card-value">20,000,000</div>
                            <div class="card-subtitle">metric tons of CO2</div>
                            <div class="card-subtitle">that's like planting</div>
                            <div class="card-value">1,000,000</div>
                            <div class="card-subtitle">trees and saving them for 10 years</div>
                        </div>
                        <!-- Total Revenue Card -->
                        <div class="card" onclick="showModal('totalRevenue')">
                            <div class="card-header">
                                <h5 class="card-title">Total Revenue</h5>
                                <i class="fas fa-dollar-sign card-icon" style="color: var(--success);"></i>
                            </div>
                            <div class="card-subtitle">Last Month</div>
                            <div class="modal-chart-container">
                                <canvas id="totalRevenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <!-- Total Chargers Modal -->
    <div id="totalChargersModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Total Chargers Analytics</h3>
                <span class="close" onclick="closeModal('totalChargersModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Overview</h4>
                    <p><strong>Total Chargers:</strong> 204,000</p>
                    <p><strong>Operational:</strong> 202,000 (99.5%)</p>
                    <p><strong>Under Maintenance:</strong> 2,000 (1%)</p>
                    <div class="modal-chart-container">
                        <canvas id="modalTotalChargersChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Charger Types</h4>
                    <ul>
                        <li>DC Fast: 40,800</li>
                        <li>AC Level 2: 163,200</li>
                        <li>Wireless: 0</li>
                    </ul>
                    <h4>Locations</h4>
                    <ul>
                        <li>Urban: 142,800</li>
                        <li>Highway: 40,800</li>
                        <li>Rural: 20,400</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Chargers Modal -->
    <div id="availableChargersModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Available Chargers Analytics</h3>
                <span class="close" onclick="closeModal('availableChargersModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Availability Overview</h4>
                    <p><strong>Available Chargers:</strong> 183,600</p>
                    <p><strong>Availability Rate:</strong> 90%</p>
                    <p><strong>Peak Availability:</strong> 95% (Weekdays 10AM-4PM)</p>
                    <div class="modal-chart-container">
                        <canvas id="modalAvailableChargersChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Availability by Location</h4>
                    <ul>
                        <li>Downtown: 64,800</li>
                        <li>Suburban: 51,840</li>
                        <li>Airports: 32,400</li>
                        <li>Malls: 34,560</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- In Use Chargers Modal -->
    <div id="inUseChargersModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">In Use Chargers Analytics</h3>
                <span class="close" onclick="closeModal('inUseChargersModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Utilization Overview</h4>
                    <p><strong>Chargers In Use:</strong> 10,200</p>
                    <p><strong>Utilization Rate:</strong> 20%</p>
                    <p><strong>Peak Utilization:</strong> 40% (Weekends 12PM-6PM)</p>
                    <div class="modal-chart-container">
                        <canvas id="modalInUseChargersChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Utilization by Charger Type</h4>
                    <ul>
                        <li>DC Fast: 6,120</li>
                        <li>AC Level 2: 3,528</li>
                        <li>Wireless: 0</li>
                    </ul>
                    <h4>Average Session Duration</h4>
                    <p>30 minutes</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Unavailable Chargers Modal -->
    <div id="unavailableChargersModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Unavailable Chargers Analytics</h3>
                <span class="close" onclick="closeModal('unavailableChargersModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Downtime Overview</h4>
                    <p><strong>Unavailable Chargers:</strong> 2,040</p>
                    <p><strong>Downtime Rate:</strong> 1%</p>
                    <p><strong>Average Repair Time:</strong> 4 hours</p>
                    <div class="modal-chart-container">
                        <canvas id="modalUnavailableChargersChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Reasons for Downtime</h4>
                    <ul>
                        <li>Maintenance: 1,020</li>
                        <li>Technical Issues: 612</li>
                        <li>Network Problems: 408</li>
                    </ul>
                    <h4>Maintenance Schedule</h4>
                    <ul>
                        <li>Weekly: 408</li>
                        <li>Monthly: 612</li>
                        <li>Emergency: 1,020</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Tesla Station Modal -->
    <div id="teslaStationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Tesla Station Details</h3>
                <span class="close" onclick="closeModal('teslaStationModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Station Information</h4>
                    <p><strong>Type:</strong> DC Fast</p>
                    <p><strong>Distance:</strong> 2.5 miles</p>
                    <p><strong>Price:</strong> $0.35/kWh</p>
                    <p><strong>Slots:</strong> 12</p>
                    <p><strong>Availability:</strong> 9 slots available</p>
                    <div class="modal-chart-container">
                        <canvas id="modalTeslaStationChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Usage Statistics</h4>
                    <p><strong>Average Sessions/Day:</strong> 120</p>
                    <p><strong>Peak Hours:</strong> 4PM-8PM</p>
                    <p><strong>Average Session Duration:</strong> 25 minutes</p>
                    <h4>User Ratings</h4>
                    <p>4.8/5 (1,200 reviews)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Benz Station Modal -->
    <div id="benzStationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Benz Station Details</h3>
                <span class="close" onclick="closeModal('benzStationModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Station Information</h4>
                    <p><strong>Type:</strong> DC Fast</p>
                    <p><strong>Distance:</strong> 3.8 miles</p>
                    <p><strong>Price:</strong> $0.42/kWh</p>
                    <p><strong>Slots:</strong> 8</p>
                    <p><strong>Availability:</strong> 6 slots available</p>
                    <div class="modal-chart-container">
                        <canvas id="modalBenzStationChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Usage Statistics</h4>
                    <p><strong>Average Sessions/Day:</strong> 80</p>
                    <p><strong>Peak Hours:</strong> 10AM-6PM</p>
                    <p><strong>Average Session Duration:</strong> 30 minutes</p>
                    <h4>User Ratings</h4>
                    <p>4.5/5 (800 reviews)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Nissan Station Modal -->
    <div id="nissanStationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Nissan Station Details</h3>
                <span class="close" onclick="closeModal('nissanStationModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Station Information</h4>
                    <p><strong>Type:</strong> DC Fast</p>
                    <p><strong>Distance:</strong> 2.6 miles</p>
                    <p><strong>Price:</strong> $0.28/kWh</p>
                    <p><strong>Slots:</strong> 10</p>
                    <p><strong>Availability:</strong> 8 slots available</p>
                    <div class="modal-chart-container">
                        <canvas id="modalNissanStationChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Usage Statistics</h4>
                    <p><strong>Average Sessions/Day:</strong> 100</p>
                    <p><strong>Peak Hours:</strong> 8AM-10PM</p>
                    <p><strong>Average Session Duration:</strong> 20 minutes</p>
                    <h4>User Ratings</h4>
                    <p>4.7/5 (900 reviews)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- SUV Station Modal -->
    <div id="suvStationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">SUV Station Details</h3>
                <span class="close" onclick="closeModal('suvStationModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Station Information</h4>
                    <p><strong>Type:</strong> DC Fast</p>
                    <p><strong>Distance:</strong> 1.6 miles</p>
                    <p><strong>Price:</strong> $0.22/kWh</p>
                    <p><strong>Slots:</strong> 16</p>
                    <p><strong>Availability:</strong> 13 slots available</p>
                    <div class="modal-chart-container">
                        <canvas id="modalSuvStationChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Usage Statistics</h4>
                    <p><strong>Average Sessions/Day:</strong> 160</p>
                    <p><strong>Peak Hours:</strong> 7AM-11PM</p>
                    <p><strong>Average Session Duration:</strong> 45 minutes</p>
                    <h4>User Ratings</h4>
                    <p>4.9/5 (1,500 reviews)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Station Usage Modal -->
    <div id="stationUsageModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Station Usage Analytics</h3>
                <span class="close" onclick="closeModal('stationUsageModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Usage Overview (Last 30 Days)</h4>
                    <p><strong>Total Sessions:</strong> 1,250,000</p>
                    <p><strong>Average Sessions/Day:</strong> 41,667</p>
                    <p><strong>Peak Day:</strong> Saturday (78,000 sessions)</p>
                    <div class="modal-chart-container">
                        <canvas id="modalStationUsageChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Usage by Time of Day</h4>
                    <ul>
                        <li>Morning (6AM-12PM): 30%</li>
                        <li>Afternoon (12PM-6PM): 45%</li>
                        <li>Evening (6PM-12AM): 20%</li>
                        <li>Night (12AM-6AM): 5%</li>
                    </ul>
                    <h4>Usage by Day of Week</h4>
                    <ul>
                        <li>Weekdays: 60%</li>
                        <li>Weekends: 40%</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Station Location Modal -->
    <div id="stationLocationModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Station Location Analytics</h3>
                <span class="close" onclick="closeModal('stationLocationModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div style="width: 100%; height: 400px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.215393916234!2d-73.987844924164!3d40.7484409713896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259a9b3117469%3A0xd134e199a405a163!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1712345678910!5m2!1sen!2sus" width="100%" height="100%" style="border:0; border-radius: var(--border-radius);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="modal-section" style="width: 100%; margin-top: 20px;">
                    <h4>Location Distribution</h4>
                    <ul>
                        <li>Urban Areas: 70%</li>
                        <li>Suburban Areas: 20%</li>
                        <li>Highways: 10%</li>
                    </ul>
                    <h4>Popular Locations</h4>
                    <ol>
                        <li>Downtown Plaza</li>
                        <li>Central Mall</li>
                        <li>Airport Parking</li>
                        <li>University Campus</li>
                        <li>Highway Rest Stops</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Environment Modal -->
    <div id="environmentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Environment Impact</h3>
                <span class="close" onclick="closeModal('environmentModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Environmental Benefits</h4>
                    <p><strong>CO2 Avoided:</strong> 20,000,000 metric tons</p>
                    <p>Equivalent to planting <strong>1,000,000 trees</strong> and saving them for 10 years</p>
                    <p>Equivalent to driving <strong>50,000,000 fewer miles</strong> in a gasoline car</p>
                    <div class="modal-chart-container">
                        <canvas id="modalEnvironmentChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Energy Sources</h4>
                    <ul>
                        <li>Renewable: 65%</li>
                        <li>Grid: 30%</li>
                        <li>Solar: 5%</li>
                    </ul>
                    <h4>Sustainability Initiatives</h4>
                    <ul>
                        <li>100% renewable energy by 2025</li>
                        <li>Carbon-neutral operations by 2030</li>
                        <li>Recycling program for old batteries</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Revenue Modal -->
    <div id="totalRevenueModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Total Revenue Analytics</h3>
                <span class="close" onclick="closeModal('totalRevenueModal')">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-section">
                    <h4>Revenue Overview (Last Month)</h4>
                    <p><strong>Total Revenue:</strong> $6.41 billion</p>
                    <p><strong>Average Revenue/Day:</strong> $213.67 million</p>
                    <p><strong>Peak Revenue Day:</strong> 15th ($320 million)</p>
                    <div class="modal-chart-container">
                        <canvas id="modalTotalRevenueChart"></canvas>
                    </div>
                </div>
                <div class="modal-section">
                    <h4>Revenue by Source</h4>
                    <ul>
                        <li>Charging Fees: 70%</li>
                        <li>Subscription Plans: 20%</li>
                        <li>Advertisements: 10%</li>
                    </ul>
                    <h4>Revenue Growth</h4>
                    <p>Month-over-month growth: <strong>30%</strong></p>
                    <p>Year-over-year growth: <strong>25%</strong></p>
                    <h4>Projected Revenue</h4>
                    <p>Next month: <strong>$8.3 billion</strong></p>
                    <p>Next quarter: <strong>$24 billion</strong></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Sidebar Toggle
        $(document).ready(function () {
            // Toggle sidebar for desktop
            $('#sidebarToggle').on('click', function (e) {
                e.preventDefault();
                $('#sidebar').toggleClass('active');
                $('#abc').toggleClass('expanded');
                const toggleIcon = $(this).find('i');
                toggleIcon.toggleClass('fa-chevron-left fa-chevron-right');
            });

            // Toggle sidebar for mobile
            $('#navbarToggle').on('click', function (e) {
                e.preventDefault();
                $('#sidebar').toggleClass('active');
                $('#abc').toggleClass('expanded');
                const toggleIcon = $(this).find('i');
                toggleIcon.toggleClass('fa-bars fa-times');
            });

            // Handle dropdown toggle
            $('.dropdown-toggle').on('click', function(e) {
                e.preventDefault();
                if (!$('#sidebar').hasClass('active')) {
                    var target = $(this).data('target');
                    $('.list-unstyled').not(target).removeClass('show');
                    $(target).toggleClass('show');
                    $(this).attr('aria-expanded', $(this).attr('aria-expanded') === 'true' ? 'false' : 'true');
                }
            });

            // Update navbar heading based on clicked link
            const sidebarLinks = document.querySelectorAll("#sidebar a:not(.dropdown-toggle)");
            sidebarLinks.forEach(link => {
                link.addEventListener("click", function () {
                    if (!$('#sidebar').hasClass('active')) {
                        const sectionName = link.textContent.trim();
                        document.getElementById("navbarHeading").textContent = sectionName;
                        localStorage.setItem("sectionName", sectionName);
                    }
                });
            });

            // Set default section name
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

        // Update DateTime
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

        // Initialize Charts
        function initCharts() {
            // Total Chargers Chart
            const totalChargersCtx = document.getElementById('totalChargersChart').getContext('2d');
            new Chart(totalChargersCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Operational', 'Maintenance'],
                    datasets: [{
                        data: [202000, 2000],
                        backgroundColor: ['#28a745', '#dc3545'],
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Available Chargers Chart
            const availableChargersCtx = document.getElementById('availableChargersChart').getContext('2d');
            new Chart(availableChargersCtx, {
                type: 'bar',
                data: {
                    labels: ['Downtown', 'Suburban', 'Airports', 'Malls'],
                    datasets: [{
                        label: 'Available Chargers',
                        data: [64800, 51840, 32400, 34560],
                        backgroundColor: '#28a745',
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // In Use Chargers Chart
            const inUseChargersCtx = document.getElementById('inUseChargersChart').getContext('2d');
            new Chart(inUseChargersCtx, {
                type: 'pie',
                data: {
                    labels: ['DC Fast', 'AC Level 2', 'Wireless'],
                    datasets: [{
                        data: [6120, 3528, 0],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Unavailable Chargers Chart
            const unavailableChargersCtx = document.getElementById('unavailableChargersChart').getContext('2d');
            new Chart(unavailableChargersCtx, {
                type: 'polarArea',
                data: {
                    labels: ['Maintenance', 'Technical Issues', 'Network Problems'],
                    datasets: [{
                        data: [1020, 612, 408],
                        backgroundColor: ['#ffc107', '#dc3545', '#6c757d'],
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Station Usage Chart
            const stationUsageCtx = document.getElementById('stationUsageChart').getContext('2d');
            new Chart(stationUsageCtx, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Sessions',
                        data: [320000, 350000, 400000, 420000, 480000, 500000, 550000, 580000, 600000, 650000, 700000, 750000],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });

            // Total Revenue Chart
            const totalRevenueCtx = document.getElementById('totalRevenueChart').getContext('2d');
            new Chart(totalRevenueCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    datasets: [{
                        label: 'Revenue ($B)',
                        data: [5.09, 5.2, 5.3, 5.4, 5.5, 5.6, 5.7, 5.8, 5.9, 6.0, 6.1, 6.41],
                        backgroundColor: '#28a745',
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        // Show Modal
        function showModal(modalType) {
            const modalId = modalType + "Modal";
            const modal = document.getElementById(modalId);
            modal.style.display = "flex";
            modal.classList.add('active');
            // Initialize modal-specific charts
            if (modalType === 'totalChargers') {
                initModalTotalChargersChart();
            } else if (modalType === 'availableChargers') {
                initModalAvailableChargersChart();
            } else if (modalType === 'inUseChargers') {
                initModalInUseChargersChart();
            } else if (modalType === 'unavailableChargers') {
                initModalUnavailableChargersChart();
            } else if (modalType === 'teslaStation') {
                initModalTeslaStationChart();
            } else if (modalType === 'benzStation') {
                initModalBenzStationChart();
            } else if (modalType === 'nissanStation') {
                initModalNissanStationChart();
            } else if (modalType === 'suvStation') {
                initModalSuvStationChart();
            } else if (modalType === 'stationUsage') {
                initModalStationUsageChart();
            } else if (modalType === 'environment') {
                initModalEnvironmentChart();
            } else if (modalType === 'totalRevenue') {
                initModalTotalRevenueChart();
            }
        }

        // Close Modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.style.display = "none";
            modal.classList.remove('active');
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            const modals = document.getElementsByClassName('modal');
            for (let modal of modals) {
                if (event.target === modal) {
                    modal.style.display = "none";
                    modal.classList.remove('active');
                }
            }
        }

        // Initialize Modal Charts
        function initModalTotalChargersChart() {
            const ctx = document.getElementById('modalTotalChargersChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['DC Fast', 'AC Level 2', 'Wireless'],
                    datasets: [{
                        data: [40800, 163200, 0],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalAvailableChargersChart() {
            const ctx = document.getElementById('modalAvailableChargersChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Morning', 'Afternoon', 'Evening', 'Night'],
                    datasets: [{
                        label: 'Availability Rate',
                        data: [92, 98, 95, 88],
                        backgroundColor: '#28a745',
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalInUseChargersChart() {
            const ctx = document.getElementById('modalInUseChargersChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Weekdays', 'Weekends'],
                    datasets: [{
                        data: [60, 40],
                        backgroundColor: ['#007bff', '#28a745'],
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalUnavailableChargersChart() {
            const ctx = document.getElementById('modalUnavailableChargersChart').getContext('2d');
            new Chart(ctx, {
                type: 'polarArea',
                data: {
                    labels: ['Hardware', 'Software', 'Network'],
                    datasets: [{
                        data: [816, 612, 612],
                        backgroundColor: ['#dc3545', '#ffc107', '#6c757d'],
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalTeslaStationChart() {
            const ctx = document.getElementById('modalTeslaStationChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                    datasets: [{
                        label: 'Sessions',
                        data: [100, 120, 110, 130, 140, 150, 130],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalBenzStationChart() {
            const ctx = document.getElementById('modalBenzStationChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Morning', 'Afternoon', 'Evening', 'Night'],
                    datasets: [{
                        label: 'Sessions',
                        data: [60, 80, 70, 50],
                        backgroundColor: '#28a745',
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalNissanStationChart() {
            const ctx = document.getElementById('modalNissanStationChart').getContext('2d');
            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: ['Speed', 'Reliability', 'Availability', 'User Rating', 'Maintenance'],
                    datasets: [{
                        label: 'Performance',
                        data: [9, 8, 9, 8, 7],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalSuvStationChart() {
            const ctx = document.getElementById('modalSuvStationChart').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Regular Users', 'New Users', 'Occasional Users'],
                    datasets: [{
                        data: [100, 40, 20],
                        backgroundColor: ['#007bff', '#28a745', '#ffc107'],
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalStationUsageChart() {
            const ctx = document.getElementById('modalStationUsageChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
                    datasets: [{
                        label: 'Sessions',
                        data: [280000, 320000, 350000, 300000],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalEnvironmentChart() {
            const ctx = document.getElementById('modalEnvironmentChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: 'CO2 Avoided (tons)',
                        data: [3000000, 3200000, 3500000, 3600000, 3800000, 4000000],
                        backgroundColor: '#28a745',
                        borderWidth: 1
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        function initModalTotalRevenueChart() {
            const ctx = document.getElementById('modalTotalRevenueChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['2020', '2021', '2022', '2023', '2024'],
                    datasets: [{
                        label: 'Annual Revenue ($B)',
                        data: [2.5, 3.2, 4.1, 5.09, 6.41],
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        borderWidth: 2,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: { responsive: true, maintainAspectRatio: false }
            });
        }

        // Initialize all charts on page load
        $(document).ready(function() {
            initCharts();
        });
    </script>
</body>
</html>