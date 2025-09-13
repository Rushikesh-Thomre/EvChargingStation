<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Management</title>
    <link rel="icon" href="<?php echo base_url('Images\logo.png'); ?>" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <style>
    body {
    font-family: 'Montserrat', sans-serif !important;
    background: #fafafa;
    margin: 0;
    overflow-x: hidden;
    font-size: 14px;  /* Reduced from default 16px */
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
    font-size: 12px;  /* Reduced from 14px */
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

/* User Management Dashboard Styles */
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
    font-size: 18px;  /* Reduced from 24px */
    font-weight: 800;
    color: #1a73e8;
}

.add-user-btn {
    min-width: 180px;
    font-size: 12px;  /* Reduced from 16px */
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
    font-size: 12px;  /* Reduced from default */
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
    font-size: 12px;  /* Reduced from 14px */
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

/* Modal Styles */
.modal {
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

.modal.active {
    display: flex;
}

.modal-content {
    background: #ffffff;
    padding: 20px;
    border-radius: 10px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
}

.modal-header {
    font-size: 14px;  /* Reduced from 18px */
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
    font-size: 12px;  /* Reduced from default */
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    font-size: 12px;  /* Reduced from 14px */
}

.form-group input.error,
.form-group select.error {
    border-color: #dc3545;
}

.error-message {
    color: #dc3545;
    font-size: 10px;  /* Reduced from 12px */
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
    font-size: 12px;  /* Reduced from 14px */
    cursor: pointer;
    transition: background 0.3s ease;
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
        font-size: 16px;  /* Reduced from 22px */
    }

    .add-user-btn {
        min-width: 160px;
        font-size: 11px;  /* Reduced from 15px */
        padding: 10px 20px;
    }

    .users-table th, .users-table td {
        padding: 12px;
        font-size: 11px;  /* Reduced from default */
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
        font-size: 14px;  /* Reduced from 20px */
    }

    .add-user-btn {
        min-width: 140px;
        font-size: 10px;  /* Reduced from 14px */
        padding: 10px 20px;
    }

    .users-table th, .users-table td {
        padding: 10px;
        font-size: 10px;  /* Reduced from 13px */
    }

    .form-group input,
    .form-group select {
        font-size: 11px;  /* Reduced from 13px */
    }

    .action-btn {
        padding: 6px 12px;
        font-size: 10px;  /* Reduced from 13px */
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
        font-size: 12px;  /* Reduced from 18px */
    }

    .add-user-btn {
        min-width: 120px;
        font-size: 9px;  /* Reduced from 12px */
        padding: 8px 15px;
    }

    .users-table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    .users-table th, .users-table td {
        min-width: 100px;
        font-size: 9px;  /* Reduced from 12px */
        padding: 8px;
    }

    .form-group input,
    .form-group select {
        font-size: 10px;  /* Reduced from 12px */
    }

    .action-btn {
        padding: 5px 10px;
        font-size: 9px;  /* Reduced from 12px */
    }

    .form-actions {
        flex-direction: column;
        gap: 8px;
    }

    .submit-btn,
    .cancel-btn {
        width: 100%;
        padding: 8px;
        font-size: 10px;  /* Reduced from 14px */
    }

    .modal-content {
        max-width: 95%;
        padding: 15px;
    }
}
   </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>
    <?php $this->load->view('base/base') ?>

    <div class="wrapper">
        <div class="content" id="abc">
            <div class="container-fluid">
                <div id="datetime"></div>
                <div class="dashboard-container">
                    <div class="dashboard-header">
                        <h2 class="dashboard-title">User Management</h2>
                        <a href="#" class="add-user-btn" id="addUserBtn">Add New User</a>
                    </div>
                    <!-- User Form Modal -->
                    <div class="modal" id="userModal">
                        <div class="modal-content">
                            <div class="modal-header" id="modalHeader"></div>
                            <form id="userForm">
                                <div class="form-group">
                                    <label for="userId">User ID</label>
                                    <input type="text" id="userId" name="userId" required aria-describedby="userIdError">
                                    <div class="error-message" id="userIdError">User ID is required and must be a number.</div>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" id="username" name="username" required aria-describedby="usernameError">
                                    <div class="error-message" id="usernameError">Username is required (minimum 3 characters).</div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" required aria-describedby="emailError">
                                    <div class="error-message" id="emailError">Valid email is required.</div>
                                </div>
                                <div class="form-group">
                                    <label for="role">Role</label>
                                    <select id="role" name="role" required aria-describedby="roleError">
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
                                    <select id="status" name="status" required aria-describedby="statusError">
                                        <option value="">Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Inactive">Inactive</option>
                                    </select>
                                    <div class="error-message" id="statusError">Status is required.</div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="submit-btn">Submit</button>
                                    <button type="button" class="cancel-btn" id="cancelModal">Cancel</button>
                                </div>
                            </form>
                        </div>
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
                            <tbody>
                                <?php
                                // Dummy data for users
                                $users = [
                                    ['id' => 1, 'username' => 'john_doe', 'email' => 'john@example.com', 'role' => 'Admin', 'status' => 'Active'],
                                    ['id' => 2, 'username' => 'jane_smith', 'email' => 'jane@example.com', 'role' => 'Station Operator', 'status' => 'Active'],
                                    ['id' => 3, 'username' => 'mike_tech', 'email' => 'mike@example.com', 'role' => 'Maintenance Technician', 'status' => 'Inactive'],
                                    ['id' => 4, 'username' => 'guest_user', 'email' => 'guest@example.com', 'role' => 'Guest', 'status' => 'Active'],
                                    ['id' => 5, 'username' => 'alice_ev', 'email' => 'alice@example.com', 'role' => 'Station Operator', 'status' => 'Active']
                                ];

                                foreach ($users as $user) {
                                    $statusIcon = $user['status'] === 'Active' ? '<i class="fas fa-check" style="color: #28a745;"></i>' : '<i class="fas fa-times" style="color: #dc3545;"></i>';
                                    $statusClass = $user['status'] === 'Active' ? 'status-enabled' : 'status-disabled';
                                    echo "<tr data-id=\"" . $user['id'] . "\">";
                                    echo "<td>" . $user['id'] . "</td>";
                                    echo "<td>" . $user['username'] . "</td>";
                                    echo "<td>" . $user['email'] . "</td>";
                                    echo "<td>" . $user['role'] . "</td>";
                                    echo "<td class=\"$statusClass\">$statusIcon</td>";
                                    echo "<td>";
                                    echo "<a href='#' class='action-btn edit-btn' onclick='editUser(" . json_encode($user) . ")'>Edit</a>";
                                    echo "<a href='#' class='action-btn delete-btn' onclick='deleteUser(" . $user['id'] . ", \"" . $user['username'] . "\")'>Delete</a>";
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
        document.addEventListener("DOMContentLoaded", function () {
            // Modal and form handling
            const addUserBtn = document.getElementById("addUserBtn");
            const userModal = document.getElementById("userModal");
            const cancelModalBtn = document.getElementById("cancelModal");
            const form = document.getElementById("userForm");

            addUserBtn.addEventListener("click", function (e) {
                e.preventDefault();
                document.getElementById("modalHeader").textContent = "Add New User";
                form.reset();
                clearErrors();
                document.getElementById("userForm").dataset.mode = "add";
                document.getElementById("userId").disabled = false;
                userModal.classList.add("active");
            });

            cancelModalBtn.addEventListener("click", closeModal);

            userModal.addEventListener("click", function (e) {
                if (e.target === userModal) {
                    closeModal();
                }
            });

            form.addEventListener("submit", function (e) {
                e.preventDefault();
                let isValid = true;
                clearErrors();

                const userId = document.getElementById("userId");
                const username = document.getElementById("username");
                const email = document.getElementById("email");
                const role = document.getElementById("role");
                const status = document.getElementById("status");

                if (!userId.value || isNaN(userId.value)) {
                    showError("userId", "User ID is required and must be a number.");
                    isValid = false;
                }

                if (!username.value.trim() || username.value.length < 3) {
                    showError("username", "Username is required (minimum 3 characters).");
                    isValid = false;
                }

                if (!email.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                    showError("email", "Valid email is required.");
                    isValid = false;
                }

                if (!role.value) {
                    showError("role", "Role is required.");
                    isValid = false;
                }

                if (!status.value) {
                    showError("status", "Status is required.");
                    isValid = false;
                }

                if (isValid) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'User ' + (form.dataset.mode === 'add' ? 'added' : 'updated') + ' successfully!',
                        confirmButtonColor: '#1a73e8'
                    });
                    closeModal();
                }
            });

            function showError(fieldId, message) {
                const field = document.getElementById(fieldId);
                const error = document.getElementById(`${fieldId}Error`);
                field.classList.add("error");
                error.style.display = "block";
                error.textContent = message;
            }

            function clearErrors() {
                const fields = ["userId", "username", "email", "role", "status"];
                fields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    const error = document.getElementById(`${fieldId}Error`);
                    field.classList.remove("error");
                    error.style.display = "none";
                });
            }

            function closeModal() {
                userModal.classList.remove("active");
                form.reset();
                clearErrors();
            }

            // Edit button functionality
            window.editUser = function (user) {
                document.getElementById("modalHeader").textContent = "Edit User";
                document.getElementById("userForm").dataset.mode = "edit";
                document.getElementById("userId").value = user.id;
                document.getElementById("userId").disabled = true; // Prevent editing ID
                document.getElementById("username").value = user.username;
                document.getElementById("email").value = user.email;
                document.getElementById("role").value = user.role;
                document.getElementById("status").value = user.status;
                clearErrors();
                userModal.classList.add("active");
            };

            // Delete button functionality with SweetAlert2
            window.deleteUser = function (id, username) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete user ${username} (ID: ${id}). This action cannot be undone.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1a73e8',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: `User ${username} has been deleted.`,
                            confirmButtonColor: '#1a73e8'
                        });
                    }
                });
            };
        });
    </script>

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