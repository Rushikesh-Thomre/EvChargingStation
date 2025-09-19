<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Revenue Report</title>
    <link rel="icon" href="<?php echo base_url('Images/logo.png'); ?>" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            flex-wrap: wrap;
            gap: 12px;
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
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }
        .form-group {
            flex: 1;
            min-width: 180px;
            margin-bottom: 15px;
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
        .revenue-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }
        .revenue-table th, .revenue-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
            font-size: 12px;
        }
        .revenue-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .revenue-table tr:hover {
            background: #f9f9f9;
        }
        .status-paid {
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
        .status-pending {
            color: #ffc107;
            font-weight: 600;
            background: rgba(255, 193, 7, 0.1);
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
            text-decoration: none;
            display: inline-block;
            background: #1a73e8;
            color: #fff;
        }
        .action-btn:hover {
            background: #1557b0;
        }
        .revenue-modal {
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
        .revenue-modal.active {
            display: flex;
        }
        .modal-content {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 550px;
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
            gap: 12px;
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
            justify-content: flex-end;
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
        .revenue-table-wrapper {
            overflow-x: auto;
        }
        .revenue-summary {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 14px;
            font-weight: 600;
            color: #333;
        }
        .revenue-summary span {
            color: #1a73e8;
            font-weight: 800;
        }
        .revenue-modal.active ~ .wrapper #sidebar,
        .revenue-modal.active ~ .wrapper .content {
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
            .revenue-table th, .revenue-table td {
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
            .revenue-summary {
                font-size: 12px;
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
                align-items: flex-start;
            }
            .dashboard-title {
                font-size: 12px;
            }
            .filter-btn, .clear-filter-btn {
                min-width: 120px;
                font-size: 9px;
                padding: 8px 15px;
            }
            .revenue-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .revenue-table th, .revenue-table td {
                min-width: 80px;
                font-size: 10px;
                padding: 8px;
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
            .revenue-summary {
                font-size: 11px;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php $this->load->view('base/navbar'); ?>
    <div class="wrapper">
        <?php $this->load->view('base/sidebar'); ?>
        <div class="content" id="abc">
            <div class="container-fluid">
                <div id="datetime"></div>
                <div class="dashboard-container">
                    <div class="revenue-summary" id="totalRevenue">
                        <!-- Total revenue will be calculated and inserted by JavaScript -->
                    </div>
                    <div class="dashboard-header">
                        <h2 class="dashboard-title">Revenue Report History</h2>
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
                            <label for="paymentStatus">Payment Status</label>
                            <select id="paymentStatus" name="paymentStatus" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">All Statuses</option>
                                <option value="Paid">Paid</option>
                                <option value="Pending">Pending</option>
                                <option value="Failed">Failed</option>
                            </select>
                            <div class="error-message" id="paymentStatusError">Please select a valid status.</div>
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
                    <div class="revenue-table-wrapper">
                        <table class="revenue-table">
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>Session ID</th>
                                    <th>Charger ID</th>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Payment Status</th>
                                    <th>Payment Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="revenueTbody">
                                <?php
                                $revenues = [
                                    [
                                        'payment_id' => 3001,
                                        'session_id' => 1001,
                                        'charger_id' => 1,
                                        'user' => 'John Doe',
                                        'amount' => 25.50,
                                        'payment_status' => 'Paid',
                                        'payment_date' => '2025-09-12 15:45:00'
                                    ],
                                    [
                                        'payment_id' => 3002,
                                        'session_id' => 1002,
                                        'charger_id' => 2,
                                        'user' => 'Jane Smith',
                                        'amount' => 20.00,
                                        'payment_status' => 'Paid',
                                        'payment_date' => '2025-09-11 14:30:00'
                                    ],
                                    [
                                        'payment_id' => 3003,
                                        'session_id' => 1003,
                                        'charger_id' => 4,
                                        'user' => 'Mike Johnson',
                                        'amount' => 0.00,
                                        'payment_status' => 'Failed',
                                        'payment_date' => '2025-09-10 15:15:30'
                                    ],
                                    [
                                        'payment_id' => 3004,
                                        'session_id' => 1004,
                                        'charger_id' => 3,
                                        'user' => 'Sarah Wilson',
                                        'amount' => 18.75,
                                        'payment_status' => 'Pending',
                                        'payment_date' => '2025-09-09 13:00:00'
                                    ]
                                ];
                                foreach ($revenues as $revenue) {
                                    $statusClass = strtolower($revenue['payment_status']) === 'paid' ? 'status-paid' :
                                                  (strtolower($revenue['payment_status']) === 'failed' ? 'status-failed' : 'status-pending');
                                    echo "<tr data-payment-id='" . $revenue['payment_id'] . "'>";
                                    echo "<td><strong>#" . $revenue['payment_id'] . "</strong></td>";
                                    echo "<td>#" . $revenue['session_id'] . "</td>";
                                    echo "<td>Charger " . $revenue['charger_id'] . "</td>";
                                    echo "<td>" . htmlspecialchars($revenue['user']) . "</td>";
                                    echo "<td>$" . number_format($revenue['amount'], 2) . "</td>";
                                    echo "<td><span class='$statusClass'>" . $revenue['payment_status'] . "</span></td>";
                                    echo "<td>" . date('Y-m-d H:i:s', strtotime($revenue['payment_date'])) . "</td>";
                                    echo "<td>";
                                    echo "<button class='action-btn' onclick='viewRevenue(" . json_encode($revenue) . ")'>View</button>";
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
    <div id="revenueModal" class="revenue-modal">
        <div class="modal-content">
            <div class="modal-header" id="revenueModalTitle">Revenue Details</div>
            <div class="detail-grid" id="revenueDetails">
            </div>
            <div class="form-actions">
                <button type="button" class="close-btn" onclick="closeRevenueModal()">Close</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
            integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#sidebarToggle').on('click', function (e) {
                e.preventDefault();
                $('#sidebar').toggleClass('active');
                $('#abc').toggleClass('expanded');
                const toggleIcon = $(this).find('i');
                toggleIcon.toggleClass('fa-chevron-left fa-chevron-right');
            });
            $('#navbarToggle').on('click', function (e) {
                e.preventDefault();
                $('#sidebar').toggleClass('active');
                $('#abc').toggleClass('expanded');
                const toggleIcon = $(this).find('i');
                toggleIcon.toggleClass('fa-bars fa-times');
            });
            $('.dropdown-toggle').on('click', function(e) {
                e.preventDefault();
                if (!$('#sidebar').hasClass('active')) {
                    var target = $(this).data('target');
                    $('.list-unstyled').not(target).removeClass('show');
                    $(target).toggleClass('show');
                    $(this).attr('aria-expanded', $(this).attr('aria-expanded') === 'true' ? 'false' : 'true');
                }
            });
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
        let revenues = <?php echo json_encode($revenues); ?>;
        let filteredRevenues = [...revenues];
        function updateTotalRevenue() {
            const total = filteredRevenues
                .filter(revenue => revenue.payment_status.toLowerCase() === 'paid')
                .reduce((sum, revenue) => sum + Number(revenue.amount), 0)
                .toFixed(2);
            document.getElementById('totalRevenue').innerHTML = `Total Revenue (Paid): <span>$${total}</span>`;
        }
        function renderRevenueTable() {
            const tbody = document.getElementById('revenueTbody');
            tbody.innerHTML = '';
            filteredRevenues.forEach(revenue => {
                const statusClass = revenue.payment_status.toLowerCase() === 'paid' ? 'status-paid' :
                                   revenue.payment_status.toLowerCase() === 'failed' ? 'status-failed' : 'status-pending';
                const tr = document.createElement('tr');
                tr.setAttribute('data-payment-id', revenue.payment_id);
                tr.innerHTML = `
                    <td><strong>#${revenue.payment_id}</strong></td>
                    <td>#${revenue.session_id}</td>
                    <td>Charger ${revenue.charger_id}</td>
                    <td>${revenue.user}</td>
                    <td>$${Number(revenue.amount).toFixed(2)}</td>
                    <td><span class="${statusClass}">${revenue.payment_status}</span></td>
                    <td>${new Date(revenue.payment_date).toLocaleString('en-IN')}</td>
                    <td>
                        <button class="action-btn" onclick="viewRevenue(${JSON.stringify(revenue).replace(/"/g, '&quot;')})">View</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
            updateTotalRevenue();
        }
        function toggleFilterForm() {
            const filterForm = document.getElementById('filterForm');
            filterForm.style.display = filterForm.style.display === 'none' ? 'flex' : 'none';
        }
        function applyFilters() {
            if (validateFilterForm()) {
                const startDate = document.getElementById('startDate').value;
                const endDate = document.getElementById('endDate').value;
                const paymentStatus = document.getElementById('paymentStatus').value;
                const user = document.getElementById('user').value.trim().toLowerCase();
                filteredRevenues = revenues.filter(revenue => {
                    let isMatch = true;
                    if (startDate) {
                        const paymentDate = new Date(revenue.payment_date);
                        const filterStart = new Date(startDate);
                        filterStart.setHours(0, 0, 0, 0);
                        isMatch = isMatch && paymentDate >= filterStart;
                    }
                    if (endDate) {
                        const paymentDate = new Date(revenue.payment_date);
                        const filterEnd = new Date(endDate);
                        filterEnd.setHours(23, 59, 59, 999);
                        isMatch = isMatch && paymentDate <= filterEnd;
                    }
                    if (paymentStatus) {
                        isMatch = isMatch && revenue.payment_status === paymentStatus;
                    }
                    if (user) {
                        isMatch = isMatch && revenue.user.toLowerCase().includes(user);
                    }
                    return isMatch;
                });
                renderRevenueTable();
                toggleFilterForm();
                Swal.fire({
                    icon: 'success',
                    title: 'Filters Applied',
                    text: 'Revenue report history has been filtered successfully.',
                    timer: 1500,
                    showConfirmButton: false
                });
            }
        }
        function clearFilters() {
            const filterForm = document.getElementById('filterForm');
            filterForm.reset();
            filteredRevenues = [...revenues];
            clearErrors();
            renderRevenueTable();
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
        function validateFilterForm() {
            const startDateInput = document.getElementById('startDate');
            const endDateInput = document.getElementById('endDate');
            const userInput = document.getElementById('user');
            const paymentStatusInput = document.getElementById('paymentStatus');
            let isValid = true;
            clearErrors();
            const currentDate = new Date('2025-09-19T12:10:00+05:30');
            if (!startDateInput.value && !endDateInput.value && !paymentStatusInput.value && !userInput.value) {
                showError(startDateInput, 'At least one filter must be provided.');
                isValid = false;
            }
            if (startDateInput.value) {
                if (!isValidDate(startDateInput.value)) {
                    showError(startDateInput, 'Please select a valid start date.');
                    isValid = false;
                } else if (new Date(startDateInput.value) > currentDate) {
                    showError(startDateInput, 'Start date cannot be in the future.');
                    isValid = false;
                }
            }
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
        function viewRevenue(revenue) {
            document.getElementById('revenueModalTitle').textContent = `Revenue #${revenue.payment_id} Details`;
            const detailsContainer = document.getElementById('revenueDetails');
            const transactionFee = (revenue.amount * 0.02).toFixed(2);
            detailsContainer.innerHTML = `
                <div class="detail-item">
                    <div class="detail-label">Payment ID</div>
                    <div class="detail-value">#${revenue.payment_id}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Session ID</div>
                    <div class="detail-value">#${revenue.session_id}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Charger ID</div>
                    <div class="detail-value">Charger ${revenue.charger_id}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">User Name</div>
                    <div class="detail-value">${revenue.user}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Amount</div>
                    <div class="detail-value">$${Number(revenue.amount).toFixed(2)}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Transaction Fee (2%)</div>
                    <div class="detail-value">$${transactionFee}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Total Charged</div>
                    <div class="detail-value">$${Number(revenue.amount + Number(transactionFee)).toFixed(2)}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Payment Status</div>
                    <div class="detail-value">${revenue.payment_status}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">Payment Date</div>
                    <div class="detail-value">${new Date(revenue.payment_date).toLocaleString('en-IN')}</div>
                </div>
            `;
            const modal = document.getElementById('revenueModal');
            modal.classList.add('active');
            const closeModalBtn = document.querySelector('#revenueModal .close-btn');
            closeModalBtn.removeEventListener('click', closeRevenueModal);
            closeModalBtn.addEventListener('click', closeRevenueModal);
        }
        function closeRevenueModal() {
            document.getElementById('revenueModal').classList.remove('active');
        }
        window.onclick = function(event) {
            const modal = document.getElementById('revenueModal');
            if (event.target === modal) {
                closeRevenueModal();
            }
        }
        document.addEventListener("DOMContentLoaded", function () {
            renderRevenueTable();
            document.getElementById('filterBtn').addEventListener('click', toggleFilterForm);
            document.getElementById('clearFilterBtn').addEventListener('click', clearFilters);
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
        });
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