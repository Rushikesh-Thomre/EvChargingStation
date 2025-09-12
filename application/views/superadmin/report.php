<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Overall Report</title>
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

        /* Report Dashboard Styles */
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

        .reports-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .reports-table th, .reports-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }

        .reports-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .reports-table tr:hover {
            background: #f9f9f9;
        }

        .status-completed, .status-resolved, .status-paid {
            color: #28a745;
            font-weight: 600;
            background: rgba(40, 167, 69, 0.1);
            padding: 4px 8px;
            border-radius: 12px;
        }

        .status-active, .status-failed {
            color: #dc3545;
            font-weight: 600;
            background: rgba(220, 53, 69, 0.1);
            padding: 4px 8px;
            border-radius: 12px;
        }

        .status-pending {
            color: #ffc107;
            font-weight: 600;
            background: rgba(255, 193, 7, 0.1);
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
        .report-modal {
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

        .report-modal.active {
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

        .reports-table-wrapper {
            overflow-x: auto;
        }

        .report-summary {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 16px;
            font-weight: 600;
            color: #333;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .report-summary span {
            color: #1a73e8;
            font-weight: 800;
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

            .report-summary {
                grid-template-columns: 1fr;
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

            .reports-table th, .reports-table td {
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

            .report-summary {
                font-size: 14px;
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

            .reports-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .reports-table th, .reports-table td {
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

            .report-summary {
                font-size: 13px;
            }
        }

        /* Blur Sidebar and Content when Modal is Active */
        .report-modal.active ~ .wrapper #sidebar,
        .report-modal.active ~ .wrapper .content {
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
                    <div class="report-summary" id="reportSummary">
                        <!-- Summary metrics will be calculated and inserted by JavaScript -->
                    </div>
                    <div class="dashboard-header">
                        <h2 class="dashboard-title">Overall Report History</h2>
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
                            <label for="reportType">Report Type</label>
                            <select id="reportType" name="reportType" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">All Types</option>
                                <option value="Session">Session</option>
                                <option value="Power">Power</option>
                                <option value="Load">Load</option>
                                <option value="Alert">Alert</option>
                                <option value="Payment">Payment</option>
                            </select>
                            <div class="error-message" id="reportTypeError">Please select a valid report type.</div>
                        </div>
                        <div class="form-group">
                            <label for="user">User</label>
                            <input type="text" id="user" name="user" maxlength="50" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="userError">User name must be 2-50 characters (letters, spaces, dots, hyphens).</div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="filter-btn" onclick="applyFilters()">Apply Filters</button>
                            <button type="button" class="clear-filter-btn" onclick="toggleFilterForm()">Cancel</button>
                        </div>
                    </div>
                    <div class="reports-table-wrapper">
                        <table class="reports-table">
                            <thead>
                                <tr>
                                    <th>Report ID</th>
                                    <th>Type</th>
                                    <th>User</th>
                                    <th>Timestamp</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="reportsTbody">
                                <?php
                                // Sample report data (aggregated from previous pages)
                                $reports = [
                                    [
                                        'report_id' => 1,
                                        'type' => 'Session',
                                        'user' => 'John Doe',
                                        'timestamp' => '2025-09-12 14:30:00',
                                        'status' => 'Completed',
                                        'details' => [
                                            'session_id' => 1001,
                                            'charger_id' => 1,
                                            'duration' => '01:45:00',
                                            'energy' => 15.5
                                        ]
                                    ],
                                    [
                                        'report_id' => 2,
                                        'type' => 'Power',
                                        'user' => 'Jane Smith',
                                        'timestamp' => '2025-09-11 13:45:00',
                                        'status' => 'Completed',
                                        'details' => [
                                            'session_id' => 1002,
                                            'charger_id' => 2,
                                            'energy' => 12.3,
                                            'power' => 7.4
                                        ]
                                    ],
                                    [
                                        'report_id' => 3,
                                        'type' => 'Load',
                                        'user' => 'Mike Johnson',
                                        'timestamp' => '2025-09-10 15:15:00',
                                        'status' => 'Active',
                                        'details' => [
                                            'session_id' => 1003,
                                            'charger_id' => 4,
                                            'load_percentage' => 85
                                        ]
                                    ],
                                    [
                                        'report_id' => 4,
                                        'type' => 'Alert',
                                        'user' => 'System',
                                        'timestamp' => '2025-09-12 14:30:25',
                                        'status' => 'Active',
                                        'details' => [
                                            'alert_id' => 2001,
                                            'charger_id' => 1,
                                            'alert_type' => 'Error',
                                            'message' => 'Charger offline due to power failure'
                                        ]
                                    ],
                                    [
                                        'report_id' => 5,
                                        'type' => 'Payment',
                                        'user' => 'John Doe',
                                        'timestamp' => '2025-09-12 15:45:00',
                                        'status' => 'Paid',
                                        'details' => [
                                            'payment_id' => 3001,
                                            'session_id' => 1001,
                                            'charger_id' => 1,
                                            'amount' => 25.50
                                        ]
                                    ],
                                    [
                                        'report_id' => 6,
                                        'type' => 'Payment',
                                        'user' => 'Sarah Wilson',
                                        'timestamp' => '2025-09-09 13:00:00',
                                        'status' => 'Pending',
                                        'details' => [
                                            'payment_id' => 3004,
                                            'session_id' => 1004,
                                            'charger_id' => 3,
                                            'amount' => 18.75
                                        ]
                                    ]
                                ];

                                foreach ($reports as $report) {
                                    $statusClass = in_array(strtolower($report['status']), ['completed', 'resolved', 'paid']) ? 'status-completed' :
                                                  (in_array(strtolower($report['status']), ['active', 'failed']) ? 'status-active' : 'status-pending');
                                    echo "<tr data-report-id='" . $report['report_id'] . "'>";
                                    echo "<td><strong>#" . $report['report_id'] . "</strong></td>";
                                    echo "<td>" . htmlspecialchars($report['type']) . "</td>";
                                    echo "<td>" . htmlspecialchars($report['user']) . "</td>";
                                    echo "<td>" . date('Y-m-d H:i:s', strtotime($report['timestamp'])) . "</td>";
                                    echo "<td><span class='$statusClass'>" . $report['status'] . "</span></td>";
                                    echo "<td>";
                                    echo "<button class='action-btn' onclick='viewReport(" . json_encode($report) . ")'>View</button>";
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

    <!-- Report Details Modal -->
    <div id="reportModal" class="report-modal">
        <div class="modal-content">
            <div class="modal-header" id="reportModalTitle">Report Details</div>
            <div class="detail-grid" id="reportDetails">
                <!-- Dynamic content populated by JavaScript -->
            </div>
            <div class="form-actions">
                <button type="button" class="close-btn" onclick="closeReportModal()">Close</button>
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
        // Reports data
        let reports = <?php echo json_encode($reports); ?>;
        let filteredReports = [...reports];

        // Calculate and display summary metrics
        function updateReportSummary() {
            const totalSessions = filteredReports.filter(r => r.type === 'Session').length;
            const totalEnergy = filteredReports
                .filter(r => r.type === 'Session' || r.type === 'Power')
                .reduce((sum, r) => sum + (r.details.energy || 0), 0)
                .toFixed(2);
            const totalAlerts = filteredReports.filter(r => r.type === 'Alert').length;
            const totalRevenue = filteredReports
                .filter(r => r.type === 'Payment' && r.status.toLowerCase() === 'paid')
                .reduce((sum, r) => sum + Number(r.details.amount || 0), 0)
                .toFixed(2);

            document.getElementById('reportSummary').innerHTML = `
                <div>Total Sessions: <span>${totalSessions}</span></div>
                <div>Total Energy Consumed: <span>${totalEnergy} kWh</span></div>
                <div>Total Alerts: <span>${totalAlerts}</span></div>
                <div>Total Revenue (Paid): <span>$${totalRevenue}</span></div>
            `;
        }

        // Render reports table
        function renderReportsTable() {
            const tbody = document.getElementById('reportsTbody');
            tbody.innerHTML = '';
            filteredReports.forEach(report => {
                const statusClass = ['completed', 'resolved', 'paid'].includes(report.status.toLowerCase()) ? 'status-completed' :
                                   ['active', 'failed'].includes(report.status.toLowerCase()) ? 'status-active' : 'status-pending';
                const tr = document.createElement('tr');
                tr.setAttribute('data-report-id', report.report_id);
                tr.innerHTML = `
                    <td><strong>#${report.report_id}</strong></td>
                    <td>${report.type}</td>
                    <td>${report.user}</td>
                    <td>${new Date(report.timestamp).toLocaleString('en-IN')}</td>
                    <td><span class="${statusClass}">${report.status}</span></td>
                    <td>
                        <button class="action-btn" onclick="viewReport(${JSON.stringify(report).replace(/"/g, '&quot;')})">View</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
            updateReportSummary();
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
                const reportType = document.getElementById('reportType').value;
                const user = document.getElementById('user').value.trim().toLowerCase();

                filteredReports = reports.filter(report => {
                    let isMatch = true;

                    if (startDate) {
                        const reportDate = new Date(report.timestamp);
                        const filterStart = new Date(startDate);
                        filterStart.setHours(0, 0, 0, 0);
                        isMatch = isMatch && reportDate >= filterStart;
                    }
                    if (endDate) {
                        const reportDate = new Date(report.timestamp);
                        const filterEnd = new Date(endDate);
                        filterEnd.setHours(23, 59, 59, 999);
                        isMatch = isMatch && reportDate <= filterEnd;
                    }
                    if (reportType) {
                        isMatch = isMatch && report.type === reportType;
                    }
                    if (user) {
                        isMatch = isMatch && report.user.toLowerCase().includes(user);
                    }

                    return isMatch;
                });

                renderReportsTable();
                toggleFilterForm();
                Swal.fire({
                    icon: 'success',
                    title: 'Filters Applied',
                    text: 'Overall report history has been filtered successfully.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }

        // Clear Filters
        function clearFilters() {
            const filterForm = document.getElementById('filterForm');
            filterForm.reset();
            filteredReports = [...reports];
            clearErrors();
            renderReportsTable();
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
            const userInput = document.getElementById('user');
            const reportTypeInput = document.getElementById('reportType');
            let isValid = true;

            clearErrors();

            const currentDate = new Date('2025-09-12T17:41:00+05:30');

            // Validate at least one filter is provided
            if (!startDateInput.value && !endDateInput.value && !reportTypeInput.value && !userInput.value) {
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

            // Validate user
            if (userInput.value) {
                const userRegex = /^[a-zA-Z\s.-]{2,50}$/;
                if (!userRegex.test(userInput.value)) {
                    showError(userInput, 'User name must be 2-50 characters (letters, spaces, dots, hyphens).');
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

        // Open Report Modal
        function viewReport(report) {
            document.getElementById('reportModalTitle').textContent = `Report #${report.report_id} Details`;
            const detailsContainer = document.getElementById('reportDetails');
            let detailsHTML = `
                <div class="detail-item">
                    <div class="detail-label">Report ID</div>
                    <div class="detail-value">#${report.report_id}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Type</div>
                    <div class="detail-value">${report.type}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">User</div>
                    <div class="detail-value">${report.user}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Timestamp</div>
                    <div class="detail-value">${new Date(report.timestamp).toLocaleString('en-IN')}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Status</div>
                    <div class="detail-value">${report.status}</div>
                </div>
            `;

            // Add type-specific details
            if (report.type === 'Session') {
                detailsHTML += `
                    <div class="detail-item">
                        <div class="detail-label">Session ID</div>
                        <div class="detail-value">#${report.details.session_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Charger ID</div>
                        <div class="detail-value">Charger ${report.details.charger_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Duration</div>
                        <div class="detail-value">${report.details.duration}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Energy Consumed</div>
                        <div class="detail-value">${report.details.energy} kWh</div>
                    </div>
                `;
            } else if (report.type === 'Power') {
                detailsHTML += `
                    <div class="detail-item">
                        <div class="detail-label">Session ID</div>
                        <div class="detail-value">#${report.details.session_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Charger ID</div>
                        <div class="detail-value">Charger ${report.details.charger_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Energy Consumed</div>
                        <div class="detail-value">${report.details.energy} kWh</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Power Output</div>
                        <div class="detail-value">${report.details.power} kW</div>
                    </div>
                `;
            } else if (report.type === 'Load') {
                detailsHTML += `
                    <div class="detail-item">
                        <div class="detail-label">Session ID</div>
                        <div class="detail-value">#${report.details.session_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Charger ID</div>
                        <div class="detail-value">Charger ${report.details.charger_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Load Percentage</div>
                        <div class="detail-value">${report.details.load_percentage}%</div>
                    </div>
                `;
            } else if (report.type === 'Alert') {
                detailsHTML += `
                    <div class="detail-item">
                        <div class="detail-label">Alert ID</div>
                        <div class="detail-value">#${report.details.alert_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Charger ID</div>
                        <div class="detail-value">Charger ${report.details.charger_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Alert Type</div>
                        <div class="detail-value">${report.details.alert_type}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Message</div>
                        <div class="detail-value">${report.details.message}</div>
                    </div>
                `;
            } else if (report.type === 'Payment') {
                const transactionFee = (report.details.amount * 0.02).toFixed(2);
                detailsHTML += `
                    <div class="detail-item">
                        <div class="detail-label">Payment ID</div>
                        <div class="detail-value">#${report.details.payment_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Session ID</div>
                        <div class="detail-value">#${report.details.session_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Charger ID</div>
                        <div class="detail-value">Charger ${report.details.charger_id}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Amount</div>
                        <div class="detail-value">$${Number(report.details.amount).toFixed(2)}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Transaction Fee (2%)</div>
                        <div class="detail-value">$${transactionFee}</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Total Charged</div>
                        <div class="detail-value">$${Number(report.details.amount + Number(transactionFee)).toFixed(2)}</div>
                    </div>
                `;
            }

            detailsContainer.innerHTML = detailsHTML;
            document.getElementById('reportModal').classList.add('active');
        }

        // Close Report Modal
        function closeReportModal() {
            document.getElementById('reportModal').classList.remove('active');
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('reportModal');
            if (event.target === modal) {
                closeReportModal();
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
                    } else if (e.target.id === 'user') {
                        const userRegex = /^[a-zA-Z\s.-]{2,50}$/;
                        if (e.target.value && !userRegex.test(e.target.value)) {
                            showError(e.target, 'User name must be 2-50 characters (letters, spaces, dots, hyphens).');
                        } else {
                            hideError(e.target);
                        }
                    } else {
                        hideError(e.target);
                    }
                });
            });

            // Initial render
            renderReportsTable();
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