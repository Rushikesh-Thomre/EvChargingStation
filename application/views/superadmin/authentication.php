<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentication Management</title>
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
        .configure-auth-btn {
            min-width: 180px;
            font-size: 12px;
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
        .configure-auth-btn:hover {
            background: #1557b0;
        }
        .auth-methods-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }
        .auth-methods-table th, .auth-methods-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
            font-size: 12px;
        }
        .auth-methods-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .auth-methods-table tr:hover {
            background: #f9f9f9;
        }
        .action-btn {
            padding: 8px 15px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            transition: background 0.3s ease;
        }
        .edit-btn {
            background: #1a73e8;
            color: #fff;
        }
        .edit-btn:hover {
            background: #1557b0;
        }
        .toggle-btn {
            background: #28a745;
            color: #fff;
        }
        .toggle-btn:hover {
            background: #218838;
        }
        .toggle-btn.disabled {
            background: #6c757d;
        }
        .toggle-btn.disabled:hover {
            background: #5a6268;
        }
        .status-enabled i {
            color: #28a745;
        }
        .status-disabled i {
            color: #dc3545;
        }
        .auth-modal {
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
        .auth-modal.active {
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
            font-size: 12px;
        }
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 12px;
            box-sizing: border-box;
        }
        .form-group input.error,
        .form-group select.error,
        .form-group textarea.error {
            border-color: #dc3545;
        }
        .error-message {
            color: #dc3545;
            font-size: 10px;
            margin-top: 5px;
            display: none;
        }
        .form-actions {
            display: flex;
            gap: 10px;
        }
        .submit-btn,
        .cancel-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 12px;
            cursor: pointer;
            transition: background 0.3s ease;
            flex: 1;
        }
        .submit-btn {
            background: #1a73e8;
            color: #fff;
        }
        .submit-btn:hover {
            background: #1557b0;
        }
        .cancel-btn {
            background: #6c757d;
            color: #fff;
        }
        .cancel-btn:hover {
            background: #5a6268;
        }
        .auth-methods-table-wrapper {
            overflow-x: auto;
        }
        .auth-modal.active ~ .wrapper #sidebar,
        .auth-modal.active ~ .wrapper .content {
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
            .configure-auth-btn {
                min-width: 140px;
                font-size: 10px;
                padding: 10px 20px;
            }
            .auth-methods-table th, .auth-methods-table td {
                padding: 10px;
                font-size: 11px;
            }
            .form-group input,
            .form-group select,
            .form-group textarea {
                font-size: 11px;
            }
            .action-btn {
                padding: 6px 12px;
                font-size: 11px;
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
            .configure-auth-btn {
                min-width: 120px;
                font-size: 9px;
                padding: 8px 15px;
            }
            .auth-methods-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .auth-methods-table th, .auth-methods-table td {
                min-width: 100px;
                font-size: 10px;
                padding: 8px;
            }
            .form-group input,
            .form-group select,
            .form-group textarea {
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
            .submit-btn,
            .cancel-btn {
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
                        <h2 class="dashboard-title">Authentication Management</h2>
                        <a href="#" class="configure-auth-btn" id="configureAuthBtn">Configure New Method</a>
                    </div>
                    <div class="auth-methods-table-wrapper">
                        <table class="auth-methods-table">
                            <thead>
                                <tr>
                                    <th>Method ID</th>
                                    <th>Method Name</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="authMethodsTbody">
                                <?php
                                $authMethods = [
                                    [
                                        'id' => 1,
                                        'name' => 'RFID Card',
                                        'description' => 'Authenticate users via RFID card scanning at charging stations.',
                                        'status' => 'Enabled'
                                    ],
                                    [
                                        'id' => 2,
                                        'name' => 'Mobile App',
                                        'description' => 'Login using mobile app with username and password.',
                                        'status' => 'Enabled'
                                    ],
                                    [
                                        'id' => 3,
                                        'name' => 'Two-Factor Authentication',
                                        'description' => 'Requires email OTP after password login.',
                                        'status' => 'Disabled'
                                    ],
                                    [
                                        'id' => 4,
                                        'name' => 'Guest Access',
                                        'description' => 'Temporary access for unregistered users via QR code.',
                                        'status' => 'Enabled'
                                    ]
                                ];
                                foreach ($authMethods as $method) {
                                    $statusClass = strtolower($method['status']) === 'enabled' ? 'status-enabled' : 'status-disabled';
                                    $statusIcon = $method['status'] === 'Enabled' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>';
                                    $toggleText = $method['status'] === 'Enabled' ? 'Disable' : 'Enable';
                                    $buttonClass = $method['status'] === 'Enabled' ? '' : 'disabled';
                                    echo "<tr data-id=\"" . htmlspecialchars($method['id']) . "\">";
                                    echo "<td>" . htmlspecialchars($method['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($method['name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($method['description']) . "</td>";
                                    echo "<td class=\"$statusClass\">$statusIcon</td>";
                                    echo "<td>";
                                    echo "<button class='action-btn edit-btn' onclick='editAuthMethod(" . $method['id'] . ")'>Edit</button>";
                                    echo "<button class='action-btn toggle-btn $buttonClass' onclick='toggleAuthMethod(" . $method['id'] . ", \"" . htmlspecialchars($method['name']) . "\", \"" . $method['status'] . "\")'>$toggleText</button>";
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

    <!-- Authentication Modal -->
    <div id="authModal" class="auth-modal">
        <div class="modal-content">
            <div class="modal-header" id="modalTitle">Configure New Method</div>
            <form id="authMethodForm">
                <input type="hidden" id="editId" value="">
                <div class="form-group">
                    <label for="methodId">Method ID</label>
                    <input type="number" id="methodId" name="methodId" required min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="methodIdError">
                    <div class="error-message" id="methodIdError">Method ID must be a positive number.</div>
                </div>
                <div class="form-group">
                    <label for="methodName">Method Name</label>
                    <input type="text" id="methodName" name="methodName" required minlength="3" maxlength="50" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="methodNameError">
                    <div class="error-message" id="methodNameError">Method Name must be 3-50 characters.</div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" required minlength="10" maxlength="200" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="descriptionError"></textarea>
                    <div class="error-message" id="descriptionError">Description must be 10-200 characters.</div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="statusError">
                        <option value="">Select Status</option>
                        <option value="Enabled">Enabled</option>
                        <option value="Disabled">Disabled</option>
                    </select>
                    <div class="error-message" id="statusError">Status is required.</div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn">Submit</button>
                    <button type="button" class="cancel-btn" onclick="closeModal()">Close</button>
                </div>
            </form>
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

        // Authentication methods data
        let authMethods = <?php echo json_encode($authMethods); ?>;
        let currentEditId = null;

        // Render table
        function renderTable() {
            const tbody = document.getElementById('authMethodsTbody');
            tbody.innerHTML = '';
            authMethods.forEach(method => {
                const statusClass = method.status.toLowerCase() === 'enabled' ? 'status-enabled' : 'status-disabled';
                const statusIcon = method.status === 'Enabled' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>';
                const toggleText = method.status === 'Enabled' ? 'Disable' : 'Enable';
                const buttonClass = method.status === 'Enabled' ? '' : 'disabled';
                const tr = document.createElement('tr');
                tr.setAttribute('data-id', method.id);
                tr.innerHTML = `
                    <td>${method.id}</td>
                    <td>${method.name}</td>
                    <td>${method.description}</td>
                    <td class="${statusClass}">${statusIcon}</td>
                    <td>
                        <button class="action-btn edit-btn" onclick="editAuthMethod(${method.id})">Edit</button>
                        <button class="action-btn toggle-btn ${buttonClass}" onclick="toggleAuthMethod(${method.id}, '${method.name}', '${method.status}')">${toggleText}</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Open Modal
        function openModal(mode, id = null) {
            const modal = document.getElementById('authModal');
            const form = document.getElementById('authMethodForm');
            const title = document.getElementById('modalTitle');
            form.reset();
            clearErrors();
            modal.dataset.mode = mode;
            if (mode === 'add') {
                title.textContent = 'Configure New Method';
                document.getElementById('methodId').readOnly = false;
                document.getElementById('editId').value = '';
                currentEditId = null;
            } else {
                title.textContent = 'Edit Authentication Method';
                document.getElementById('methodId').readOnly = true;
                const method = authMethods.find(m => parseInt(m.id) === parseInt(id));
                if (method) {
                    document.getElementById('editId').value = id;
                    document.getElementById('methodId').value = method.id;
                    document.getElementById('methodName').value = method.name;
                    document.getElementById('description').value = method.description;
                    document.getElementById('status').value = method.status;
                    currentEditId = id;
                }
            }
            modal.classList.add('active');
        }

        // Close Modal
        function closeModal() {
            const modal = document.getElementById('authModal');
            modal.classList.remove('active');
            clearErrors();
        }

        // Close on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('authModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Form Submission
        function handleFormSubmit(e) {
            e.preventDefault();
            if (validateForm()) {
                const mode = document.getElementById('authModal').dataset.mode;
                const methodId = parseInt(document.getElementById('methodId').value);
                const methodName = document.getElementById('methodName').value.trim();
                const description = document.getElementById('description').value.trim();
                const status = document.getElementById('status').value;

                if (mode === 'add') {
                    if (authMethods.some(m => parseInt(m.id) === methodId)) {
                        showError(document.getElementById('methodId'), 'Method ID already exists.');
                        return;
                    }
                    authMethods.push({ id: methodId, name: methodName, description, status });
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Authentication method added successfully!',
                        confirmButtonColor: '#1a73e8'
                    });
                } else {
                    if (methodId !== parseInt(currentEditId) && authMethods.some(m => parseInt(m.id) === methodId)) {
                        showError(document.getElementById('methodId'), 'Method ID already exists.');
                        return;
                    }
                    const idx = authMethods.findIndex(m => parseInt(m.id) === parseInt(currentEditId));
                    if (idx !== -1) {
                        authMethods[idx].id = methodId;
                        authMethods[idx].name = methodName;
                        authMethods[idx].description = description;
                        authMethods[idx].status = status;
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Authentication method updated successfully!',
                            confirmButtonColor: '#1a73e8'
                        });
                    }
                }
                renderTable();
                closeModal();
            }
        }

        // Edit Authentication Method
        function editAuthMethod(id) {
            openModal('edit', id);
        }

        // Toggle Authentication Method
        function toggleAuthMethod(id, name, currentStatus) {
            const newStatus = currentStatus === 'Enabled' ? 'Disabled' : 'Enabled';
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to ${newStatus.toLowerCase()} authentication method ${name} (ID: ${id}).`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1a73e8',
                cancelButtonColor: '#6c757d',
                confirmButtonText: `Yes, ${newStatus.toLowerCase()} it!`
            }).then((result) => {
                if (result.isConfirmed) {
                    const idx = authMethods.findIndex(m => parseInt(m.id) === parseInt(id));
                    if (idx !== -1) {
                        authMethods[idx].status = newStatus;
                        renderTable();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: `Authentication method ${newStatus.toLowerCase()} successfully!`,
                            confirmButtonColor: '#1a73e8'
                        });
                    }
                }
            });
        }

        // Form Validation
        function validateForm() {
            const inputs = document.querySelectorAll('#authMethodForm input, #authMethodForm select, #authMethodForm textarea');
            let isValid = true;
            clearErrors();

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    showError(input);
                    isValid = false;
                }
            });

            const methodId = parseInt(document.getElementById('methodId').value);
            if (isNaN(methodId) || methodId < 1) {
                showError(document.getElementById('methodId'), 'Method ID must be a positive number.');
                isValid = false;
            }

            return isValid;
        }

        function showError(input, customMessage = null) {
            const errorId = input.id + 'Error';
            const errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.style.display = 'block';
                if (customMessage) errorElement.textContent = customMessage;
                input.classList.add('error');
            }
        }

        function hideError(input) {
            const errorId = input.id + 'Error';
            const errorElement = document.getElementById(errorId);
            if (errorElement) errorElement.style.display = 'none';
            input.classList.remove('error');
        }

        function clearErrors() {
            const errors = document.querySelectorAll('#authMethodForm .error-message');
            errors.forEach(error => error.style.display = 'none');
            const inputs = document.querySelectorAll('#authMethodForm input, #authMethodForm select, #authMethodForm textarea');
            inputs.forEach(input => input.classList.remove('error'));
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            renderTable();
            document.getElementById("configureAuthBtn").addEventListener("click", function (e) {
                e.preventDefault();
                openModal('add');
            });

            const form = document.getElementById("authMethodForm");
            form.addEventListener("submit", handleFormSubmit);

            const inputs = form.querySelectorAll('input, select, textarea');
            inputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    if (!e.target.checkValidity()) {
                        showError(e.target);
                    } else {
                        hideError(e.target);
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