<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
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
        .add-user-btn {
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
        .add-user-btn:hover {
            background: #1557b0;
        }
        .users-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }
        .users-table th, .users-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
            font-size: 12px;
        }
        .users-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .users-table tr:hover {
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
        .delete-btn {
            background: #dc3545;
            color: #fff;
        }
        .delete-btn:hover {
            background: #c82333;
        }
        .status-enabled i {
            color: #28a745;
        }
        .status-disabled i {
            color: #dc3545;
        }
        .user-modal {
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
        .user-modal.active {
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
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 12px;
            box-sizing: border-box;
        }
        .form-group input.error,
        .form-group select.error {
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
        .users-table-wrapper {
            overflow-x: auto;
        }
        .user-modal.active ~ .wrapper #sidebar,
        .user-modal.active ~ .wrapper .content {
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
            .add-user-btn {
                min-width: 140px;
                font-size: 10px;
                padding: 10px 20px;
            }
            .users-table th, .users-table td {
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
            .add-user-btn {
                min-width: 120px;
                font-size: 9px;
                padding: 8px 15px;
            }
            .users-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .users-table th, .users-table td {
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
                        <h2 class="dashboard-title">User Management</h2>
                        <a href="#" class="add-user-btn" id="addUserBtn">Add New User</a>
                    </div>
                    <div class="users-table-wrapper">
                        <table class="users-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="usersTbody">
                                <?php
                                $users = [
                                    ['id' => 1, 'username' => 'john_doe', 'email' => 'john@example.com', 'role' => 'Admin', 'status' => 'Active'],
                                    ['id' => 2, 'username' => 'jane_smith', 'email' => 'jane@example.com', 'role' => 'Station Operator', 'status' => 'Active'],
                                    ['id' => 3, 'username' => 'mike_tech', 'email' => 'mike@example.com', 'role' => 'Maintenance Technician', 'status' => 'Inactive'],
                                    ['id' => 4, 'username' => 'guest_user', 'email' => 'guest@example.com', 'role' => 'Guest', 'status' => 'Active'],
                                    ['id' => 5, 'username' => 'alice_ev', 'email' => 'alice@example.com', 'role' => 'Station Operator', 'status' => 'Active']
                                ];
                                foreach ($users as $user) {
                                    $statusIcon = $user['status'] === 'Active' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>';
                                    $statusClass = $user['status'] === 'Active' ? 'status-enabled' : 'status-disabled';
                                    echo "<tr data-id=\"" . htmlspecialchars($user['id']) . "\">";
                                    echo "<td>" . htmlspecialchars($user['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                                    echo "<td>" . htmlspecialchars($user['role']) . "</td>";
                                    echo "<td class=\"$statusClass\">$statusIcon</td>";
                                    echo "<td>";
                                    echo "<button class='action-btn edit-btn' onclick='editUser(" . $user['id'] . ")'>Edit</button>";
                                    echo "<button class='action-btn delete-btn' onclick='deleteUser(" . $user['id'] . ", \"" . htmlspecialchars($user['username']) . "\")'>Delete</button>";
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

    <!-- User Modal -->
    <div id="userModal" class="user-modal">
        <div class="modal-content">
            <div class="modal-header" id="modalTitle">Add New User</div>
            <form id="userForm">
                <input type="hidden" id="editId" value="">
                <div class="form-group">
                    <label for="userId">User ID</label>
                    <input type="number" id="userId" name="userId" required min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="userIdError">
                    <div class="error-message" id="userIdError">User ID must be a positive number.</div>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required minlength="3" maxlength="50" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="usernameError">
                    <div class="error-message" id="usernameError">Username must be 3-50 characters.</div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="emailError">
                    <div class="error-message" id="emailError">Valid email is required.</div>
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" name="role" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="roleError">
                        <option value="">Select Role</option>
                        <option value="Admin">Admin</option>
                        <option value="Station Operator">Station Operator</option>
                        <option value="Maintenance Technician">Maintenance Technician</option>
                        <option value="Guest">Guest</option>
                    </select>
                    <div class="error-message" id="roleError">Role is required.</div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" aria-describedby="statusError">
                        <option value="">Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
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

        // Users data
        let users = <?php echo json_encode($users); ?>;
        let currentEditId = null;

        // Render table
        function renderTable() {
            const tbody = document.getElementById('usersTbody');
            tbody.innerHTML = '';
            users.forEach(user => {
                const statusIcon = user.status === 'Active' ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>';
                const statusClass = user.status === 'Active' ? 'status-enabled' : 'status-disabled';
                const tr = document.createElement('tr');
                tr.setAttribute('data-id', user.id);
                tr.innerHTML = `
                    <td>${user.id}</td>
                    <td>${user.username}</td>
                    <td>${user.email}</td>
                    <td>${user.role}</td>
                    <td class="${statusClass}">${statusIcon}</td>
                    <td>
                        <button class="action-btn edit-btn" onclick="editUser(${user.id})">Edit</button>
                        <button class="action-btn delete-btn" onclick="deleteUser(${user.id}, '${user.username}')">Delete</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Open Modal
        function openModal(mode, id = null) {
            const modal = document.getElementById('userModal');
            const form = document.getElementById('userForm');
            const title = document.getElementById('modalTitle');
            form.reset();
            clearErrors();
            modal.dataset.mode = mode;
            if (mode === 'add') {
                title.textContent = 'Add New User';
                document.getElementById('userId').readOnly = false;
                document.getElementById('editId').value = '';
                currentEditId = null;
            } else {
                title.textContent = 'Edit User';
                document.getElementById('userId').readOnly = true;
                const user = users.find(u => parseInt(u.id) === parseInt(id));
                if (user) {
                    document.getElementById('editId').value = id;
                    document.getElementById('userId').value = user.id;
                    document.getElementById('username').value = user.username;
                    document.getElementById('email').value = user.email;
                    document.getElementById('role').value = user.role;
                    document.getElementById('status').value = user.status;
                    currentEditId = id;
                }
            }
            modal.classList.add('active');
        }

        // Close Modal
        function closeModal() {
            const modal = document.getElementById('userModal');
            modal.classList.remove('active');
            clearErrors();
        }

        // Close on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('userModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Form Submission
        function handleFormSubmit(e) {
            e.preventDefault();
            if (validateForm()) {
                const mode = document.getElementById('userModal').dataset.mode;
                const userId = parseInt(document.getElementById('userId').value);
                const username = document.getElementById('username').value.trim();
                const email = document.getElementById('email').value.trim();
                const role = document.getElementById('role').value;
                const status = document.getElementById('status').value;

                if (mode === 'add') {
                    if (users.some(u => parseInt(u.id) === userId)) {
                        showError(document.getElementById('userId'), 'User ID already exists.');
                        return;
                    }
                    users.push({ id: userId, username, email, role, status });
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'User added successfully!',
                        confirmButtonColor: '#1a73e8'
                    });
                } else {
                    if (userId !== parseInt(currentEditId) && users.some(u => parseInt(u.id) === userId)) {
                        showError(document.getElementById('userId'), 'User ID already exists.');
                        return;
                    }
                    const idx = users.findIndex(u => parseInt(u.id) === parseInt(currentEditId));
                    if (idx !== -1) {
                        users[idx].id = userId;
                        users[idx].username = username;
                        users[idx].email = email;
                        users[idx].role = role;
                        users[idx].status = status;
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User updated successfully!',
                            confirmButtonColor: '#1a73e8'
                        });
                    }
                }
                renderTable();
                closeModal();
            }
        }

        // Edit User
        function editUser(id) {
            openModal('edit', id);
        }

        // Delete User
        function deleteUser(id, username) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete user ${username} (ID: ${id}). This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    users = users.filter(u => parseInt(u.id) !== parseInt(id));
                    renderTable();
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: `User ${username} has been deleted.`,
                        confirmButtonColor: '#1a73e8'
                    });
                }
            });
        }

        // Form Validation
        function validateForm() {
            const inputs = document.querySelectorAll('#userForm input, #userForm select');
            let isValid = true;
            clearErrors();

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    showError(input);
                    isValid = false;
                }
            });

            const userId = parseInt(document.getElementById('userId').value);
            if (isNaN(userId) || userId < 1) {
                showError(document.getElementById('userId'), 'User ID must be a positive number.');
                isValid = false;
            }

            const email = document.getElementById('email').value.trim();
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                showError(document.getElementById('email'), 'Valid email is required.');
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
            const errors = document.querySelectorAll('#userForm .error-message');
            errors.forEach(error => error.style.display = 'none');
            const inputs = document.querySelectorAll('#userForm input, #userForm select');
            inputs.forEach(input => input.classList.remove('error'));
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            renderTable();
            document.getElementById("addUserBtn").addEventListener("click", function (e) {
                e.preventDefault();
                openModal('add');
            });

            const form = document.getElementById("userForm");
            form.addEventListener("submit", handleFormSubmit);

            const inputs = form.querySelectorAll('input, select');
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