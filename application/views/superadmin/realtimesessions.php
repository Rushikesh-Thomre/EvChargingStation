<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Real-Time Sessions</title>
    <link rel="icon" href="<?php echo base_url('Images\logo.png'); ?>" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            font-family: 'Montserrat', sans-serif !important;
            background: #fafafa;
            margin: 0;
            overflow-x: hidden;
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

        .content {
            width: 100%;
            padding: 10px;
            min-height: 100vh;
            transition: all 0.3s;
        }

        #datetime {
            font-size: 14px;
            color: #333;
            padding: 10px 0;
            background: #e6f0ff;
            margin-top: 50px;
            text-align: center;
            border-radius: 5px;
        }

        #datetime span {
            font-weight: bold;
        }

        /* Real-Time Sessions Dashboard Styles */
        .dashboard-container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 25px;
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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
            font-size: 24px;
            font-weight: 800;
            color: #1a73e8;
        }

        .refresh-btn {
            min-width: 180px;
            font-size: 16px;
            padding: 12px 25px;
            background: #1a73e8;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            text-transform: uppercase;
        }

        .refresh-btn:hover {
            background: #1557b0;
        }

        .sessions-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .sessions-table th, .sessions-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }

        .sessions-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .sessions-table tr:hover {
            background: #f9f9f9;
        }

        .status-active {
            color: #28a745;
            font-weight: 600;
            background: rgba(40, 167, 69, 0.1);
            padding: 4px 8px;
            border-radius: 12px;
        }

        .status-completed {
            color: #17a2b8;
            font-weight: 600;
            background: rgba(23, 162, 184, 0.1);
            padding: 4px 8px;
            border-radius: 12px;
        }

        .status-failed {
            color: #dc3545;
            font-weight: 600;
            background: rgba(220, 53, 69, 0.1);
            padding: 4px 8px;
            border-radius: 12px;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
            margin-top: 5px;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #28a745, #20c997);
            transition: width 0.3s ease;
            border-radius: 4px;
        }

        .session-info {
            font-size: 13px;
            color: #666;
        }

        .action-btn {
            padding: 8px 15px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
            text-decoration: none;
            display: inline-block;
        }

        .view-btn {
            background: #1a73e8;
            color: #fff;
        }

        .view-btn:hover {
            background: #1557b0;
        }

        .stop-btn {
            background: #dc3545;
            color: #fff;
        }

        .stop-btn:hover {
            background: #c82333;
        }

        /* Modal Styles */
        .session-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .session-modal.active {
            display: flex;
        }

        .modal-content {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
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
            font-size: 18px;
            font-weight: 700;
            color: #1a73e8;
            margin-bottom: 20px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .detail-item {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
        }

        .detail-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
        }

        .detail-value {
            color: #666;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .close-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s ease;
            background: #6c757d;
            color: #fff;
        }

        .close-btn:hover {
            background: #5a6268;
        }

        .sessions-table-wrapper {
            overflow-x: auto;
        }

        /* Responsive Styles */
        @media (max-width: 1024px) {
            .dashboard-container {
                padding: 20px;
            }

            .dashboard-header {
                flex-direction: column;
                gap: 15px;
            }

            .dashboard-title {
                font-size: 22px;
            }

            .refresh-btn {
                min-width: 160px;
                font-size: 15px;
                padding: 10px 20px;
            }

            .modal-content {
                max-width: 90%;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 15px;
            }

            .dashboard-title {
                font-size: 20px;
            }

            .refresh-btn {
                min-width: 140px;
                font-size: 14px;
                padding: 10px 20px;
            }

            .sessions-table th, .sessions-table td {
                padding: 10px;
                font-size: 13px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }

            .action-btn {
                padding: 6px 12px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 10px;
            }

            .dashboard-header {
                flex-direction: column;
                gap: 10px;
            }

            .dashboard-title {
                font-size: 18px;
            }

            .refresh-btn {
                min-width: 120px;
                font-size: 12px;
                padding: 8px 15px;
            }

            .sessions-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .sessions-table th, .sessions-table td {
                min-width: 100px;
                font-size: 12px;
                padding: 8px;
            }

            .action-btn {
                padding: 5px 10px;
                font-size: 12px;
                margin: 2px;
            }

            .form-actions {
                flex-direction: column;
                gap: 8px;
            }

            .close-btn {
                width: 100%;
                padding: 8px;
            }

            .modal-content {
                max-width: 95%;
                padding: 15px;
            }
        }

        /* Blur Sidebar and Content when Modal is Active */
        .session-modal.active ~ .wrapper #sidebar,
        .session-modal.active ~ .wrapper .content {
            filter: blur(5px);
            transition: filter 0.3s ease;
        }

        #sidebar,
        .content {
            filter: none;
            transition: filter 0.3s ease;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php $this->load->view('base/base') ?>

    <div class="wrapper">
        <div class="content" id="abc">
            <div class="container-fluid">
                <div id="datetime"></div>
                <div class="dashboard-container">
                    <div class="dashboard-header">
                        <h2 class="dashboard-title">Real-Time Charging Sessions</h2>
                        <button class="refresh-btn" id="refreshBtn">
                            <i class="fas fa-sync-alt me-2"></i>Refresh
                        </button>
                    </div>
                    <div class="sessions-table-wrapper">
                        <table class="sessions-table">
                            <thead>
                                <tr>
                                    <th>Session ID</th>
                                    <th>Charger ID</th>
                                    <th>User</th>
                                    <th>Vehicle</th>
                                    <th>Status</th>
                                    <th>Start Time</th>
                                    <th>Progress</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sessionsTbody">
                                <?php
                                // Sample real-time session data
                                $sessions = [
                                    [
                                        'id' => 1001,
                                        'charger_id' => 1,
                                        'user' => 'John Doe',
                                        'vehicle' => 'Tesla Model 3',
                                        'status' => 'Active',
                                        'start_time' => '2025-09-12 14:30:25',
                                        'progress' => 65,
                                        'end_time' => null,
                                        'energy_delivered' => '12.5 kWh',
                                        'cost' => '$2.50'
                                    ],
                                    [
                                        'id' => 1002,
                                        'charger_id' => 2,
                                        'user' => 'Jane Smith',
                                        'vehicle' => 'Nissan Leaf',
                                        'status' => 'Completed',
                                        'start_time' => '2025-09-12 13:45:10',
                                        'progress' => 100,
                                        'end_time' => '2025-09-12 14:20:45',
                                        'energy_delivered' => '18.2 kWh',
                                        'cost' => '$3.64'
                                    ],
                                    [
                                        'id' => 1003,
                                        'charger_id' => 4,
                                        'user' => 'Mike Johnson',
                                        'vehicle' => 'Chevrolet Bolt',
                                        'status' => 'Active',
                                        'start_time' => '2025-09-12 15:10:30',
                                        'progress' => 25,
                                        'end_time' => null,
                                        'energy_delivered' => '4.8 kWh',
                                        'cost' => '$0.96'
                                    ],
                                    [
                                        'id' => 1004,
                                        'charger_id' => 3,
                                        'user' => 'Sarah Wilson',
                                        'vehicle' => 'BMW i3',
                                        'status' => 'Failed',
                                        'start_time' => '2025-09-12 12:15:00',
                                        'progress' => 0,
                                        'end_time' => '2025-09-12 12:20:15',
                                        'energy_delivered' => '0 kWh',
                                        'cost' => '$0.00'
                                    ]
                                ];

                                foreach ($sessions as $session) {
                                    $statusClass = strtolower($session['status']) === 'active' ? 'status-active' :
                                                 (strtolower($session['status']) === 'completed' ? 'status-completed' : 'status-failed');
                                    
                                    echo "<tr data-session-id='" . $session['id'] . "'>";
                                    echo "<td><strong>#" . $session['id'] . "</strong></td>";
                                    echo "<td>Charger " . $session['charger_id'] . "</td>";
                                    echo "<td>" . htmlspecialchars($session['user']) . "</td>";
                                    echo "<td>" . htmlspecialchars($session['vehicle']) . "</td>";
                                    echo "<td><span class='$statusClass'>" . $session['status'] . "</span></td>";
                                    echo "<td>" . date('H:i:s', strtotime($session['start_time'])) . "</td>";
                                    echo "<td>";
                                    echo "<div class='progress-bar'>";
                                    echo "<div class='progress-fill' style='width: " . $session['progress'] . "%'></div>";
                                    echo "</div>";
                                    echo "<div class='session-info'>" . $session['progress'] . "% Complete</div>";
                                    echo "</td>";
                                    echo "<td>";
                                    echo "<button class='action-btn view-btn' onclick='viewSession(" . json_encode($session) . ")'>View</button>";
                                    if ($session['status'] === 'Active') {
                                        echo "<button class='action-btn stop-btn' onclick='stopSession(" . $session['id'] . ")'>Stop</button>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Session Details Modal -->
    <div id="sessionModal" class="session-modal">
        <div class="modal-content">
            <div class="modal-header" id="sessionModalTitle">Session Details</div>
            <div class="detail-grid" id="sessionDetails">
                <!-- Dynamic content populated by JavaScript -->
            </div>
            <div class="form-actions">
                <button type="button" class="close-btn" onclick="closeSessionModal()">Close</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Sessions data
        let sessions = <?php echo json_encode($sessions); ?>;
        let currentSessionId = null;

        // Render sessions table
        function renderSessionsTable() {
            const tbody = document.getElementById('sessionsTbody');
            tbody.innerHTML = '';
            
            sessions.forEach(session => {
                const statusClass = session.status.toLowerCase() === 'active' ? 'status-active' :
                                   (session.status.toLowerCase() === 'completed' ? 'status-completed' : 'status-failed');
                
                const tr = document.createElement('tr');
                tr.setAttribute('data-session-id', session.id);
                tr.innerHTML = `
                    <td><strong>#${session.id}</strong></td>
                    <td>Charger ${session.charger_id}</td>
                    <td>${session.user}</td>
                    <td>${session.vehicle}</td>
                    <td><span class="${statusClass}">${session.status}</span></td>
                    <td>${new Date(session.start_time).toLocaleTimeString('en-IN', {hour: '2-digit', minute: '2-digit', second: '2-digit'})}</td>
                    <td>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: ${session.progress}%"></div>
                        </div>
                        <div class="session-info">${session.progress}% Complete</div>
                    </td>
                    <td>
                        <button class="action-btn view-btn" onclick="viewSession(${JSON.stringify(session).replace(/"/g, '&quot;')})">View</button>
                        ${session.status === 'Active' ? `<button class="action-btn stop-btn" onclick="stopSession(${session.id})">Stop</button>` : ''}
                    </td>
                `;
                tbody.appendChild(tr);
            });

            // Simulate real-time updates
            simulateRealTimeUpdates();
        }

        // Simulate real-time updates for active sessions
        function simulateRealTimeUpdates() {
            sessions.forEach(session => {
                if (session.status === 'Active' && session.progress < 100) {
                    // Simulate progress increase for active sessions
                    setTimeout(() => {
                        const idx = sessions.findIndex(s => s.id === session.id);
                        if (idx !== -1 && sessions[idx].status === 'Active') {
                            sessions[idx].progress = Math.min(100, sessions[idx].progress + Math.random() * 5);
                            if (sessions[idx].progress >= 100) {
                                sessions[idx].status = 'Completed';
                                sessions[idx].end_time = new Date().toISOString();
                                sessions[idx].energy_delivered = (Math.random() * 20 + 10).toFixed(1) + ' kWh';
                                sessions[idx].cost = '$' + (Math.random() * 5 + 2).toFixed(2);
                            }
                            renderSessionsTable();
                        }
                    }, Math.random() * 5000 + 2000); // Random update between 2-7 seconds
                }
            });
        }

        // Open Session Modal
        function viewSession(session) {
            currentSessionId = session.id;
            document.getElementById('sessionModalTitle').textContent = `Session #${session.id} Details`;
            
            const detailsContainer = document.getElementById('sessionDetails');
            detailsContainer.innerHTML = `
                <div class="detail-item">
                    <div class="detail-label">Charger ID</div>
                    <div class="detail-value">Charger ${session.charger_id}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">User Name</div>
                    <div class="detail-value">${session.user}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Vehicle Model</div>
                    <div class="detail-value">${session.vehicle}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">${session.status}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Start Time</div>
                    <div class="detail-value">${new Date(session.start_time).toLocaleString('en-IN')}</div>
                </div>
                ${session.end_time ? `
                <div class="detail-item">
                    <div class="detail-label">End Time</div>
                    <div class="detail-value">${new Date(session.end_time).toLocaleString('en-IN')}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Duration</div>
                    <div class="detail-value">${Math.round((new Date(session.end_time) - new Date(session.start_time)) / 60000)} minutes</div>
                </div>` : ''}
                <div class="detail-item">
                    <div class="detail-label">Progress</div>
                    <div class="detail-value">${session.progress}%</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Energy Delivered</div>
                    <div class="detail-value">${session.energy_delivered}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Cost</div>
                    <div class="detail-value">${session.cost}</div>
                </div>
            `;

            document.getElementById('sessionModal').classList.add('active');
        }

        // Close Session Modal
        function closeSessionModal() {
            document.getElementById('sessionModal').classList.remove('active');
        }

        // Stop Session
        function stopSession(sessionId) {
            Swal.fire({
                title: 'Stop Charging Session?',
                text: 'This will immediately stop the charging session and finalize the billing.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, stop it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const sessionIdx = sessions.findIndex(s => s.id === sessionId);
                    if (sessionIdx !== -1) {
                        sessions[sessionIdx].status = 'Completed';
                        sessions[sessionIdx].progress = 100;
                        sessions[sessionIdx].end_time = new Date().toISOString();
                        sessions[sessionIdx].energy_delivered = (Math.random() * 15 + 5).toFixed(1) + ' kWh';
                        sessions[sessionIdx].cost = '$' + (Math.random() * 3 + 1).toFixed(2);
                        
                        renderSessionsTable();
                        
                        Swal.fire({
                            icon: 'success',
                            title: 'Session Stopped!',
                            text: 'Charging session has been stopped successfully.',
                            confirmButtonColor: '#1a73e8'
                        });
                    }
                }
            });
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('sessionModal');
            if (event.target === modal) {
                closeSessionModal();
            }
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            // Refresh button
            document.getElementById("refreshBtn").addEventListener("click", function () {
                Swal.fire({
                    title: 'Refreshing...',
                    text: 'Updating real-time session data...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        setTimeout(() => {
                            // Simulate data refresh
                            sessions.forEach(session => {
                                if (session.status === 'Active') {
                                    session.progress = Math.min(100, session.progress + Math.random() * 10);
                                    if (session.progress >= 100) {
                                        session.status = 'Completed';
                                        session.end_time = new Date().toISOString();
                                        session.energy_delivered = (Math.random() * 20 + 10).toFixed(1) + ' kWh';
                                        session.cost = '$' + (Math.random() * 5 + 2).toFixed(2);
                                    }
                                }
                            });
                            renderSessionsTable();
                            Swal.fire({
                                icon: 'success',
                                title: 'Refreshed!',
                                text: 'Session data has been updated.',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }, 1500);
                    }
                });
            });

            // Initial render
            renderSessionsTable();
        });

        // DateTime Update
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