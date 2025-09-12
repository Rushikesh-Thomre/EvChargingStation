<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Session History</title>
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

        /* Session History Dashboard Styles */
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
            flex-wrap: wrap;
            gap: 15px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 800;
            color: #1a73e8;
        }

        .filter-btn, .clear-filter-btn {
            min-width: 140px;
            font-size: 16px;
            padding: 12px 25px;
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

        .filter-btn {
            background: #1a73e8;
            color: #ffffff;
        }

        .filter-btn:hover {
            background: #1557b0;
        }

        .clear-filter-btn {
            background: #6c757d;
            color: #ffffff;
        }

        .clear-filter-btn:hover {
            background: #5a6268;
        }

        .filter-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input.error, .form-group select.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: none;
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

        .status-completed {
            color: #28a745;
            font-weight: 600;
            background: rgba(40, 167, 69, 0.1);
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
            background: #1a73e8;
            color: #fff;
        }

        .action-btn:hover {
            background: #1557b0;
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
                align-items: flex-start;
            }

            .filter-btn, .clear-filter-btn {
                min-width: 160px;
                font-size: 15px;
                padding: 10px 20px;
            }

            .modal-content {
                max-width: 90%;
            }

            .filter-form {
                flex-direction: column;
            }

            .form-group {
                min-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 15px;
            }

            .dashboard-title {
                font-size: 20px;
            }

            .filter-btn, .clear-filter-btn {
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
                gap: 10px;
            }

            .dashboard-title {
                font-size: 18px;
            }

            .filter-btn, .clear-filter-btn {
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
                        <h2 class="dashboard-title">Session History</h2>
                        <div>
                            <button class="filter-btn" id="filterBtn"><i class="fas fa-filter me-2"></i>Filter</button>
                            <button class="clear-filter-btn" id="clearFilterBtn"><i class="fas fa-times me-2"></i>Clear Filters</button>
                        </div>
                    </div>
                    <div class="filter-form" id="filterForm" style="display: none;">
                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="date" id="startDate" name="startDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="startDateError">Please select a valid start date.</div>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" id="endDate" name="endDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="endDateError">End date must be after start date.</div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">All Statuses</option>
                                <option value="Completed">Completed</option>
                                <option value="Failed">Failed</option>
                            </select>
                            <div class="error-message" id="statusError">Please select a valid status.</div>
                        </div>
                        <div class="form-group">
                            <label for="user">User</label>
                            <input type="text" id="user" name="user" maxlength="50" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="userError">User name must be 2-50 characters.</div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="filter-btn" onclick="applyFilters()">Apply Filters</button>
                            <button type="button" class="clear-filter-btn" onclick="toggleFilterForm()">Cancel</button>
                        </div>
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
                                    <th>End Time</th>
                                    <th>Energy Delivered</th>
                                    <th>Cost</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sessionsTbody">
                                <?php
                                // Sample session history data
                                $sessions = [
                                    [
                                        'id' => 1001,
                                        'charger_id' => 1,
                                        'user' => 'John Doe',
                                        'vehicle' => 'Tesla Model 3',
                                        'status' => 'Completed',
                                        'start_time' => '2025-09-12 14:30:25',
                                        'end_time' => '2025-09-12 15:30:25',
                                        'energy_delivered' => '18.5 kWh',
                                        'cost' => '$3.70'
                                    ],
                                    [
                                        'id' => 1002,
                                        'charger_id' => 2,
                                        'user' => 'Jane Smith',
                                        'vehicle' => 'Nissan Leaf',
                                        'status' => 'Completed',
                                        'start_time' => '2025-09-11 13:45:10',
                                        'end_time' => '2025-09-11 14:20:45',
                                        'energy_delivered' => '15.2 kWh',
                                        'cost' => '$3.04'
                                    ],
                                    [
                                        'id' => 1003,
                                        'charger_id' => 4,
                                        'user' => 'Mike Johnson',
                                        'vehicle' => 'Chevrolet Bolt',
                                        'status' => 'Failed',
                                        'start_time' => '2025-09-10 15:10:30',
                                        'end_time' => '2025-09-10 15:15:30',
                                        'energy_delivered' => '0 kWh',
                                        'cost' => '$0.00'
                                    ],
                                    [
                                        'id' => 1004,
                                        'charger_id' => 3,
                                        'user' => 'Sarah Wilson',
                                        'vehicle' => 'BMW i3',
                                        'status' => 'Completed',
                                        'start_time' => '2025-09-09 12:15:00',
                                        'end_time' => '2025-09-09 13:00:00',
                                        'energy_delivered' => '12.8 kWh',
                                        'cost' => '$2.56'
                                    ]
                                ];

                                foreach ($sessions as $session) {
                                    $statusClass = strtolower($session['status']) === 'completed' ? 'status-completed' : 'status-failed';
                                    echo "<tr data-session-id='" . $session['id'] . "'>";
                                    echo "<td><strong>#" . $session['id'] . "</strong></td>";
                                    echo "<td>Charger " . $session['charger_id'] . "</td>";
                                    echo "<td>" . htmlspecialchars($session['user']) . "</td>";
                                    echo "<td>" . htmlspecialchars($session['vehicle']) . "</td>";
                                    echo "<td><span class='$statusClass'>" . $session['status'] . "</span></td>";
                                    echo "<td>" . date('Y-m-d H:i:s', strtotime($session['start_time'])) . "</td>";
                                    echo "<td>" . date('Y-m-d H:i:s', strtotime($session['end_time'])) . "</td>";
                                    echo "<td>" . $session['energy_delivered'] . "</td>";
                                    echo "<td>" . $session['cost'] . "</td>";
                                    echo "<td>";
                                    echo "<button class='action-btn' onclick='viewSession(" . json_encode($session) . ")'>View</button>";
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
        let filteredSessions = [...sessions];

        // Render sessions table
        function renderSessionsTable() {
            const tbody = document.getElementById('sessionsTbody');
            tbody.innerHTML = '';
            filteredSessions.forEach(session => {
                const statusClass = session.status.toLowerCase() === 'completed' ? 'status-completed' : 'status-failed';
                const tr = document.createElement('tr');
                tr.setAttribute('data-session-id', session.id);
                tr.innerHTML = `
                    <td><strong>#${session.id}</strong></td>
                    <td>Charger ${session.charger_id}</td>
                    <td>${session.user}</td>
                    <td>${session.vehicle}</td>
                    <td><span class="${statusClass}">${session.status}</span></td>
                    <td>${new Date(session.start_time).toLocaleString('en-IN')}</td>
                    <td>${new Date(session.end_time).toLocaleString('en-IN')}</td>
                    <td>${session.energy_delivered}</td>
                    <td>${session.cost}</td>
                    <td>
                        <button class="action-btn" onclick="viewSession(${JSON.stringify(session).replace(/"/g, '&quot;')})">View</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Toggle Filter Form
        function toggleFilterForm() {
            const filterForm = document.getElementById('filterForm');
            filterForm.style.display = filterForm.style.display === 'none' ? 'flex' : 'none';
        }

        // Apply Filters
        function applyFilters() {
            if (validateFilterForm()) {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const status = document.getElementById('status').value;
                const user = document.getElementById('user').value.trim().toLowerCase();

                filteredSessions = sessions.filter(session => {
                    let isMatch = true;

                    if (startDate) {
                        isMatch = isMatch && new Date(session.start_time) >= new Date(startDate);
                    }
                    if (endDate) {
                        isMatch = isMatch && new Date(session.end_time) <= new Date(endDate + ' 23:59:59');
                    }
                    if (status) {
                        isMatch = isMatch && session.status === status;
                    }
                    if (user) {
                        isMatch = isMatch && session.user.toLowerCase().includes(user);
                    }

                    return isMatch;
                });

                renderSessionsTable();
                toggleFilterForm();
                Swal.fire({
                    icon: 'success',
                    title: 'Filters Applied',
                    text: 'Session history has been filtered successfully.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }

        // Clear Filters
        function clearFilters() {
            document.getElementById('filterForm').reset();
            filteredSessions = [...sessions];
            renderSessionsTable();
            toggleFilterForm();
            Swal.fire({
                icon: 'success',
                title: 'Filters Cleared',
                text: 'All filters have been reset.',
                timer: 1500,
                showConfirmButton: false
            });
        }

        // Validate Filter Form
        function validateFilterForm() {
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            const userInput = document.getElementById('user');
            let isValid = true;

            clearErrors();

            if (startDateInput.value && endDateInput.value && new Date(startDateInput.value) > new Date(endDateInput.value)) {
                showError(endDateInput, 'End date must be after start date.');
                isValid = false;
            }

            if (userInput.value && (userInput.value.length < 2 || userInput.value.length > 50)) {
                showError(userInput, 'User name must be 2-50 characters.');
                isValid = false;
            }

            return isValid;
        }

        function showError(input, message) {
            const errorId = input.id + 'Error';
            const errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
                input.classList.add('error');
            }
        }

        function clearErrors() {
            const errors = document.querySelectorAll('#filterForm .error-message');
            errors.forEach(error => error.style.display = 'none');
            const inputs = document.querySelectorAll('#filterForm input, #filterForm select');
            inputs.forEach(input => input.classList.remove('error'));
        }

        // Open Session Modal
        function viewSession(session) {
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
                <div class="detail-item">
                    <div class="detail-label">End Time</div>
                    <div class="detail-value">${new Date(session.end_time).toLocaleString('en-IN')}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Duration</div>
                    <div class="detail-value">${Math.round((new Date(session.end_time) - new Date(session.start_time)) / 60000)} minutes</div>
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

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('sessionModal');
            if (event.target === modal) {
                closeSessionModal();
            }
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            // Filter button
            document.getElementById('filterBtn').addEventListener('click', toggleFilterForm);

            // Clear filter button
            document.getElementById('clearFilterBtn').addEventListener('click', clearFilters);

            // Real-time validation for filter form
            const inputs = document.querySelectorAll('#filterForm input, #filterForm select');
            inputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    if (!e.target.checkValidity()) {
                        showError(e.target, e.target.validationMessage);
                    } else {
                        hideError(e.target);
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

        // Helper function to hide error
        function hideError(input) {
            const errorId = input.id + 'Error';
            const errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.style.display = 'none';
                input.classList.remove('error');
            }
        }
    </script>
</body>
</html>