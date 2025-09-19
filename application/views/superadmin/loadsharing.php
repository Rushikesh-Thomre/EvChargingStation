<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Load Sharing</title>
    <link rel="icon" href="<?php echo base_url('Images/logo.png'); ?>" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
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
            transition: all 0.3s ease;
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
            font-size: 18px;
            font-weight: 800;
            color: #1a73e8;
        }
        .filter-btn, .clear-filter-btn {
            min-width: 180px;
            font-size: 12px;
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
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        .form-group {
            flex: 1;
            min-width: 180px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
            font-size: 12px;
        }
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 12px;
            box-sizing: border-box;
        }
        .form-group input.error, .form-group select.error {
            border-color: #dc3545;
        }
        .error-message {
            color: #dc3545;
            font-size: 10px;
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
            font-size: 12px;
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
            padding: 3px 6px;
            border-radius: 10px;
        }
        .status-failed {
            color: #dc3545;
            font-weight: 600;
            background: rgba(220, 53, 69, 0.1);
            padding: 3px 6px;
            border-radius: 10px;
        }
        .action-btn {
            padding: 8px 15px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            transition: background 0.3s ease;
            background: #1a73e8;
            color: #fff;
        }
        .action-btn:hover {
            background: #1557b0;
        }
        .load-sharing-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: 1002;
            justify-content: center;
            align-items: center;
        }
        .load-sharing-modal.active {
            display: flex;
        }
        .modal-content {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 500px;
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
            font-size: 14px;
            font-weight: 700;
            color: #1a73e8;
            margin-bottom: 20px;
        }
        .detail-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        .detail-item {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 6px;
        }
        .detail-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 5px;
            font-size: 12px;
        }
        .detail-value {
            color: #666;
            font-size: 12px;
        }
        .form-actions {
            display: flex;
            gap: 10px;
        }
        .close-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
            background: #6c757d;
            color: #fff;
            flex: 1;
        }
        .close-btn:hover {
            background: #5a6268;
        }
        .sessions-table-wrapper {
            overflow-x: auto;
        }
        .load-sharing-modal.active ~ .wrapper #sidebar,
        .load-sharing-modal.active ~ .wrapper .content {
            filter: blur(5px);
            transition: filter 0.3s ease;
        }
        #sidebar,
        .content {
            filter: none;
            transition: filter 0.3s ease;
        }
        @media (max-width: 768px) {
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
            .filter-btn, .clear-filter-btn {
                min-width: 140px;
                font-size: 10px;
                padding: 10px 20px;
            }
            .sessions-table th, .sessions-table td {
                padding: 10px;
                font-size: 11px;
            }
            .form-group input,
            .form-group select {
                font-size: 11px;
            }
            .action-btn {
                padding: 6px 12px;
                font-size: 11px;
            }
            .filter-form {
                flex-direction: column;
            }
            .form-group {
                min-width: 100%;
            }
            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
        @media (max-width: 480px) {
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
            }
            .dashboard-title {
                font-size: 12px;
            }
            .filter-btn, .clear-filter-btn {
                min-width: 120px;
                font-size: 9px;
                padding: 8px 15px;
            }
            .sessions-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .sessions-table th, .sessions-table td {
                min-width: 100px;
                font-size: 10px;
                padding: 8px;
            }
            .form-group input,
            .form-group select {
                font-size: 10px;
            }
            .action-btn {
                padding: 5px 10px;
                font-size: 10px;
            }
            .form-actions {
                flex-direction: column;
                gap: 8px;
            }
            .close-btn {
                width: 100%;
                padding: 8px;
                font-size: 10px;
            }
            .modal-content {
                max-width: 95%;
                padding: 15px;
            }
        }
    </style>
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
                        <h2 class="dashboard-title">Load Sharing History</h2>
                        <div>
                            <button class="filter-btn" id="filterBtn"><i class="fas fa-filter me-2"></i>Filter</button>
                            <button class="clear-filter-btn" id="clearFilterBtn"><i class="fas fa-times me-2"></i>Clear Filters</button>
                        </div>
                    </div>
                    <div class="filter-form" id="filterForm" style="display: none;">
                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="date" id="startDate" name="startDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="startDateError">
                            <div class="error-message" id="startDateError">Please select a valid start date.</div>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" id="endDate" name="endDate" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="endDateError">
                            <div class="error-message" id="endDateError">End date must be after start date.</div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="statusError">
                                <option value="">All Statuses</option>
                                <option value="Completed">Completed</option>
                                <option value="Failed">Failed</option>
                            </select>
                            <div class="error-message" id="statusError">Please select a valid status.</div>
                        </div>
                        <div class="form-group">
                            <label for="user">User</label>
                            <input type="text" id="user" name="user" maxlength="50" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="userError">
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sessionsTbody">
                                <?php
                                $sessions = [
                                    [
                                        'id' => 1001,
                                        'charger_id' => 1,
                                        'user' => 'John Doe',
                                        'vehicle' => 'Tesla Model 3',
                                        'status' => 'Completed',
                                        'start_time' => '2025-09-12 14:30:25',
                                        'end_time' => '2025-09-12 15:30:25',
                                        'energy_delivered' => '18.5 kWh'
                                    ],
                                    [
                                        'id' => 1002,
                                        'charger_id' => 2,
                                        'user' => 'Jane Smith',
                                        'vehicle' => 'Nissan Leaf',
                                        'status' => 'Completed',
                                        'start_time' => '2025-09-11 13:45:10',
                                        'end_time' => '2025-09-11 14:20:45',
                                        'energy_delivered' => '15.2 kWh'
                                    ],
                                    [
                                        'id' => 1003,
                                        'charger_id' => 4,
                                        'user' => 'Mike Johnson',
                                        'vehicle' => 'Chevrolet Bolt',
                                        'status' => 'Failed',
                                        'start_time' => '2025-09-10 15:10:30',
                                        'end_time' => '2025-09-10 15:15:30',
                                        'energy_delivered' => '0 kWh'
                                    ],
                                    [
                                        'id' => 1004,
                                        'charger_id' => 3,
                                        'user' => 'Sarah Wilson',
                                        'vehicle' => 'BMW i3',
                                        'status' => 'Completed',
                                        'start_time' => '2025-09-09 12:15:00',
                                        'end_time' => '2025-09-09 13:00:00',
                                        'energy_delivered' => '12.8 kWh'
                                    ]
                                ];
                                foreach ($sessions as $session) {
                                    $statusClass = strtolower($session['status']) === 'completed' ? 'status-completed' : 'status-failed';
                                    echo "<tr data-session-id='" . htmlspecialchars($session['id']) . "'>";
                                    echo "<td><strong>#" . htmlspecialchars($session['id']) . "</strong></td>";
                                    echo "<td>Charger " . htmlspecialchars($session['charger_id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($session['user']) . "</td>";
                                    echo "<td>" . htmlspecialchars($session['vehicle']) . "</td>";
                                    echo "<td><span class='$statusClass'>" . htmlspecialchars($session['status']) . "</span></td>";
                                    echo "<td>" . date('Y-m-d H:i:s', strtotime($session['start_time'])) . "</td>";
                                    echo "<td>" . date('Y-m-d H:i:s', strtotime($session['end_time'])) . "</td>";
                                    echo "<td>" . htmlspecialchars($session['energy_delivered']) . "</td>";
                                    echo "<td>";
                                    echo "<button class='action-btn' onclick='viewSession(" . $session['id'] . ")'>View</button>";
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

    <!-- Load Sharing Modal -->
    <div id="loadSharingModal" class="load-sharing-modal">
        <div class="modal-content">
            <div class="modal-header" id="modalTitle">Load Sharing Details</div>
            <div class="detail-grid" id="sessionDetails">
                <!-- Dynamic content populated by JavaScript -->
            </div>
            <div class="form-actions">
                <button type="button" class="close-btn" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
                    <td>
                        <button class="action-btn" onclick="viewSession(${session.id})">View</button>
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
                        const sessionStart = new Date(session.start_time);
                        const filterStart = new Date(startDate);
                        filterStart.setHours(0, 0, 0, 0);
                        isMatch = isMatch && sessionStart >= filterStart;
                    }
                    if (endDate) {
                        const sessionEnd = new Date(session.end_time);
                        const filterEnd = new Date(endDate);
                        filterEnd.setHours(23, 59, 59, 999);
                        isMatch = isMatch && sessionEnd <= filterEnd;
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
                    text: 'Load sharing history has been filtered successfully.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }

        // Clear Filters
        function clearFilters() {
            const filterForm = document.getElementById('filterForm');
            filterForm.reset();
            filteredSessions = [...sessions];
            clearErrors();
            renderSessionsTable();
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
            const statusInput = document.getElementById('status');
            let isValid = true;

            clearErrors();

            const currentDate = new Date('2025-09-19');

            // Validate at least one filter is provided
            if (!startDateInput.value && !endDateInput.value && !statusInput.value && !userInput.value) {
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
            if (userInput.value && (userInput.value.length < 2 || userInput.value.length > 50)) {
                showError(userInput, 'User name must be 2-50 characters.');
                isValid = false;
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

        // View Session
        function viewSession(id) {
            const session = sessions.find(s => parseInt(s.id) === parseInt(id));
            if (session) {
                document.getElementById('modalTitle').textContent = `Load Sharing #${session.id} Details`;
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
                `;
                document.getElementById('loadSharingModal').classList.add('active');
            }
        }

        // Close Modal
        function closeModal() {
            document.getElementById('loadSharingModal').classList.remove('active');
        }

        // Close on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('loadSharingModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            renderSessionsTable();
            document.getElementById('filterBtn').addEventListener('click', toggleFilterForm);
            document.getElementById('clearFilterBtn').addEventListener('click', clearFilters);

            const filterInputs = document.querySelectorAll('#filterForm input, #filterForm select');
            filterInputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    if (!isValidDate(e.target.value) && e.target.type === 'date') {
                        showError(e.target, `Please select a valid ${e.target.id === 'startDate' ? 'start' : 'end'} date.`);
                    } else if (e.target.id === 'user' && e.target.value && (e.target.value.length < 2 || e.target.value.length > 50)) {
                        showError(e.target, 'User name must be 2-50 characters.');
                    } else {
                        const errorId = e.target.id + 'Error';
                        const errorElement = document.getElementById(errorId);
                        if (errorElement) {
                            errorElement.style.display = 'none';
                            e.target.classList.remove('error');
                        }
                    }
                });
            });
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