<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System Alerts</title>
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

        /* System Alerts Dashboard Styles */
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

        .alerts-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .alerts-table th, .alerts-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }

        .alerts-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .alerts-table tr:hover {
            background: #f9f9f9;
        }

        .status-resolved {
            color: #28a745;
            font-weight: 600;
            background: rgba(40, 167, 69, 0.1);
            padding: 4px 8px;
            border-radius: 12px;
        }

        .status-active {
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
        .alert-modal {
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

        .alert-modal.active {
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

        .alerts-table-wrapper {
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

            .alerts-table th, .alerts-table td {
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

            .alerts-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .alerts-table th, .alerts-table td {
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
        .alert-modal.active ~ .wrapper #sidebar,
        .alert-modal.active ~ .wrapper .content {
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
                        <h2 class="dashboard-title">System Alerts History</h2>
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
                            <label for="alertType">Alert Type</label>
                            <select id="alertType" name="alertType" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">All Types</option>
                                <option value="Error">Error</option>
                                <option value="Warning">Warning</option>
                                <option value="Info">Info</option>
                            </select>
                            <div class="error-message" id="alertTypeError">Please select a valid alert type.</div>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <input type="text" id="message" name="message" maxlength="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="messageError">Message must be 2-100 characters (letters, numbers, spaces, or punctuation).</div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="filter-btn" onclick="applyFilters()">Apply Filters</button>
                            <button type="button" class="clear-filter-btn" onclick="toggleFilterForm()">Cancel</button>
                        </div>
                    </div>
                    <div class="alerts-table-wrapper">
                        <table class="alerts-table">
                            <thead>
                                <tr>
                                    <th>Alert ID</th>
                                    <th>Charger ID</th>
                                    <th>Alert Type</th>
                                    <th>Message</th>
                                    <th>Timestamp</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="alertsTbody">
                                <?php
                                // Sample alert data
                                $alerts = [
                                    [
                                        'alert_id' => 2001,
                                        'charger_id' => 1,
                                        'alert_type' => 'Error',
                                        'message' => 'Charger offline due to power failure',
                                        'timestamp' => '2025-09-12 14:30:25',
                                        'status' => 'Active'
                                    ],
                                    [
                                        'alert_id' => 2002,
                                        'charger_id' => 2,
                                        'alert_type' => 'Warning',
                                        'message' => 'High temperature detected',
                                        'timestamp' => '2025-09-11 13:45:10',
                                        'status' => 'Resolved'
                                    ],
                                    [
                                        'alert_id' => 2003,
                                        'charger_id' => 4,
                                        'alert_type' => 'Info',
                                        'message' => 'Maintenance scheduled',
                                        'timestamp' => '2025-09-10 15:10:30',
                                        'status' => 'Resolved'
                                    ],
                                    [
                                        'alert_id' => 2004,
                                        'charger_id' => 3,
                                        'alert_type' => 'Error',
                                        'message' => 'Connection error with vehicle',
                                        'timestamp' => '2025-09-09 12:15:00',
                                        'status' => 'Active'
                                    ]
                                ];

                                foreach ($alerts as $alert) {
                                    $statusClass = strtolower($alert['status']) === 'resolved' ? 'status-resolved' : 'status-active';
                                    echo "<tr data-alert-id='" . $alert['alert_id'] . "'>";
                                    echo "<td><strong>#" . $alert['alert_id'] . "</strong></td>";
                                    echo "<td>Charger " . $alert['charger_id'] . "</td>";
                                    echo "<td>" . htmlspecialchars($alert['alert_type']) . "</td>";
                                    echo "<td>" . htmlspecialchars($alert['message']) . "</td>";
                                    echo "<td>" . date('Y-m-d H:i:s', strtotime($alert['timestamp'])) . "</td>";
                                    echo "<td><span class='$statusClass'>" . $alert['status'] . "</span></td>";
                                    echo "<td>";
                                    echo "<button class='action-btn' onclick='viewAlert(" . json_encode($alert) . ")'>View</button>";
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

    <!-- Alert Details Modal -->
    <div id="alertModal" class="alert-modal">
        <div class="modal-content">
            <div class="modal-header" id="alertModalTitle">Alert Details</div>
            <div class="detail-grid" id="alertDetails">
                <!-- Dynamic content populated by JavaScript -->
            </div>
            <div class="form-actions">
                <button type="button" class="close-btn" onclick="closeAlertModal()">Close</button>
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
        // Alerts data
        let alerts = <?php echo json_encode($alerts); ?>;
        let filteredAlerts = [...alerts];

        // Render alerts table
        function renderAlertsTable() {
            const tbody = document.getElementById('alertsTbody');
            tbody.innerHTML = '';
            filteredAlerts.forEach(alert => {
                const statusClass = alert.status.toLowerCase() === 'resolved' ? 'status-resolved' : 'status-active';
                const tr = document.createElement('tr');
                tr.setAttribute('data-alert-id', alert.alert_id);
                tr.innerHTML = `
                    <td><strong>#${alert.alert_id}</strong></td>
                    <td>Charger ${alert.charger_id}</td>
                    <td>${alert.alert_type}</td>
                    <td>${alert.message}</td>
                    <td>${new Date(alert.timestamp).toLocaleString('en-IN')}</td>
                    <td><span class="${statusClass}">${alert.status}</span></td>
                    <td>
                        <button class="action-btn" onclick="viewAlert(${JSON.stringify(alert).replace(/"/g, '&quot;')})">View</button>
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
                const alertType = document.getElementById('alertType').value;
                const message = document.getElementById('message').value.trim().toLowerCase();

                filteredAlerts = alerts.filter(alert => {
                    let isMatch = true;

                    if (startDate) {
                        const alertTimestamp = new Date(alert.timestamp);
                        const filterStart = new Date(startDate);
                        filterStart.setHours(0, 0, 0, 0);
                        isMatch = isMatch && alertTimestamp >= filterStart;
                    }
                    if (endDate) {
                        const alertTimestamp = new Date(alert.timestamp);
                        const filterEnd = new Date(endDate);
                        filterEnd.setHours(23, 59, 59, 999);
                        isMatch = isMatch && alertTimestamp <= filterEnd;
                    }
                    if (alertType) {
                        isMatch = isMatch && alert.alert_type === alertType;
                    }
                    if (message) {
                        isMatch = isMatch && alert.message.toLowerCase().includes(message);
                    }

                    return isMatch;
                });

                renderAlertsTable();
                toggleFilterForm();
                Swal.fire({
                    icon: 'success',
                    title: 'Filters Applied',
                    text: 'System alerts history has been filtered successfully.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }

        // Clear Filters
        function clearFilters() {
            const filterForm = document.getElementById('filterForm');
            filterForm.reset();
            filteredAlerts = [...alerts];
            clearErrors();
            renderAlertsTable();
            if (filterForm.style.display === 'flex') {
                toggleFilterForm();
            }
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
            const messageInput = document.getElementById('message');
            const alertTypeInput = document.getElementById('alertType');
            let isValid = true;

            clearErrors();

            const currentDate = new Date('2025-09-12');

            // Validate at least one filter is provided
            if (!startDateInput.value && !endDateInput.value && !alertTypeInput.value && !messageInput.value) {
                showError(startDateInput, 'At least one filter must be provided.');
                isValid = false;
            }

            // Validate start date
            if (startDateInput.value) {
                if (!isValidDate(startDateInput.value)) {
                    showError(startDateInput, 'Please select a valid start date.');
                    isValid = false;
                } else if (new Date(startDateInput.value) > currentDate) {
                    showError(startDateInput, 'Start date cannot be in the future.');
                    isValid = false;
                }
            }

            // Validate end date
            if (endDateInput.value) {
                if (!isValidDate(endDateInput.value)) {
                    showError(endDateInput, 'Please select a valid end date.');
                    isValid = false;
                } else if (new Date(endDateInput.value) > currentDate) {
                    showError(endDateInput, 'End date cannot be in the future.');
                    isValid = false;
                } else if (startDateInput.value && new Date(startDateInput.value) > new Date(endDateInput.value)) {
                    showError(endDateInput, 'End date must be after start date.');
                    isValid = false;
                }
            }

            // Validate message
            if (messageInput.value) {
                const messageRegex = /^[a-zA-Z0-9\s.,!?-]{2,100}$/;
                if (!messageRegex.test(messageInput.value)) {
                    showError(messageInput, 'Message must be 2-100 characters (letters, numbers, spaces, or punctuation).');
                    isValid = false;
                }
            }

            return isValid;
        }

        function isValidDate(dateString) {
            const date = new Date(dateString);
            return date instanceof Date && !isNaN(date);
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

        // Open Alert Modal
        function viewAlert(alert) {
            document.getElementById('alertModalTitle').textContent = `Alert #${alert.alert_id} Details`;
            const detailsContainer = document.getElementById('alertDetails');
            detailsContainer.innerHTML = `
                <div class="detail-item">
                    <div class="detail-label">Alert ID</div>
                    <div class="detail-value">#${alert.alert_id}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Charger ID</div>
                    <div class="detail-value">Charger ${alert.charger_id}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Alert Type</div>
                    <div class="detail-value">${alert.alert_type}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Message</div>
                    <div class="detail-value">${alert.message}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Timestamp</div>
                    <div class="detail-value">${new Date(alert.timestamp).toLocaleString('en-IN')}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">${alert.status}</div>
                </div>
            `;

            document.getElementById('alertModal').classList.add('active');
        }

        // Close Alert Modal
        function closeAlertModal() {
            document.getElementById('alertModal').classList.remove('active');
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('alertModal');
            if (event.target === modal) {
                closeAlertModal();
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
                    if (!isValidDate(e.target.value) && e.target.type === 'date') {
                        showError(e.target, `Please select a valid ${e.target.id === 'startDate' ? 'start' : 'end'} date.`);
                    } else if (e.target.id === 'message') {
                        const messageRegex = /^[a-zA-Z0-9\s.,!?-]{2,100}$/;
                        if (e.target.value && !messageRegex.test(e.target.value)) {
                            showError(e.target, 'Message must be 2-100 characters (letters, numbers, spaces, or punctuation).');
                        } else {
                            hideError(e.target);
                        }
                    } else {
                        hideError(e.target);
                    }
                });
            });

            // Initial render
            renderAlertsTable();
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