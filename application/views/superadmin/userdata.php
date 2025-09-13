<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Data Management</title>
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

        /* User Data Management Dashboard Styles */
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

        .add-data-btn {
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

        .add-data-btn:hover {
            background: #1557b0;
        }

        .user-data-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .user-data-table th, .user-data-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }

        .user-data-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .user-data-table tr:hover {
            background: #f9f9f9;
        }

        .action-btn {
            padding: 8px 15px;
            margin: 0 5px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
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

        .view-btn {
            background: #6c757d;
            color: #fff;
        }

        .view-btn:hover {
            background: #5a6268;
        }

        /* Form and Modal Styles */
        .data-form-container {
            display: none;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .data-form-container.active {
            display: block;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input:disabled,
        .form-group textarea:disabled {
            background: #f5f5f5;
            cursor: not-allowed;
        }

        .form-group input.error,
        .form-group textarea.error {
            border-color: #dc3545;
        }

        .error-message {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
            display: none;
        }

        .form-actions {
            display: flex;
            gap: 10px;
        }

        .submit-btn,
        .cancel-btn,
        .close-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
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

        .cancel-btn,
        .close-btn {
            background: #6c757d;
            color: #fff;
        }

        .cancel-btn:hover,
        .close-btn:hover {
            background: #5a6268;
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
            font-size: 18px;
            font-weight: 700;
            color: #1a73e8;
            margin-bottom: 20px;
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

            .add-data-btn {
                min-width: 160px;
                font-size: 15px;
                padding: 10px 20px;
            }

            .user-data-table th, .user-data-table td {
                padding: 12px;
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

            .add-data-btn {
                min-width: 140px;
                font-size: 14px;
                padding: 10px 20px;
            }

            .user-data-table th, .user-data-table td {
                padding: 10px;
                font-size: 13px;
            }

            .form-group input,
            .form-group textarea {
                font-size: 13px;
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

            .add-data-btn {
                min-width: 120px;
                font-size: 12px;
                padding: 8px 15px;
            }

            .user-data-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .user-data-table th, .user-data-table td {
                min-width: 100px;
                font-size: 12px;
                padding: 8px;
            }

            .form-group input,
            .form-group textarea {
                font-size: 12px;
            }

            .action-btn {
                padding: 5px 10px;
                font-size: 12px;
            }

            .form-actions {
                flex-direction: column;
                gap: 8px;
            }

            .submit-btn,
            .cancel-btn,
            .close-btn {
                width: 100%;
                padding: 8px;
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
                        <h2 class="dashboard-title">User Data Management</h2>
                        <a href="#" class="add-data-btn" id="addDataBtn">Add User Data</a>
                    </div>
                    <div class="data-form-container" id="dataForm">
                        <form id="userDataForm">
                            <div class="form-group">
                                <label for="userId">User ID</label>
                                <input type="text" id="userId" name="userId" required aria-describedby="userIdError">
                                <div class="error-message" id="userIdError">User ID is required and must be a number.</div>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" required aria-describedby="usernameError">
                                <div class="error-message" id="usernameError">Username is required (3-20 characters).</div>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required aria-describedby="emailError">
                                <div class="error-message" id="emailError">Valid email is required.</div>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" required aria-describedby="phoneError">
                                <div class="error-message" id="phoneError">Valid phone number is required (e.g., +1234567890).</div>
                            </div>
                            <div class="form-group">
                                <label for="preferences">Preferences</label>
                                <textarea id="preferences" name="preferences" rows="4" aria-describedby="preferencesError"></textarea>
                                <div class="error-message" id="preferencesError">Preferences must be less than 500 characters.</div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="submit-btn">Submit</button>
                                <button type="button" class="cancel-btn" id="cancelForm">Cancel</button>
                            </div>
                        </form>
                    </div>
                    <!-- View/Edit Modal -->
                    <div class="modal" id="viewEditModal">
                        <div class="modal-content">
                            <div class="modal-header" id="modalHeader"></div>
                            <form id="viewEditForm">
                                <div class="form-group">
                                    <label for="viewEditUserId">User ID</label>
                                    <input type="text" id="viewEditUserId" name="viewEditUserId" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="viewEditUsername">Username</label>
                                    <input type="text" id="viewEditUsername" name="viewEditUsername" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="viewEditEmail">Email</label>
                                    <input type="email" id="viewEditEmail" name="viewEditEmail" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="viewEditPhone">Phone Number</label>
                                    <input type="text" id="viewEditPhone" name="viewEditPhone" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="viewEditPreferences">Preferences</label>
                                    <textarea id="viewEditPreferences" name="viewEditPreferences" rows="4" disabled></textarea>
                                </div>
                                <div class="form-actions" id="modalActions">
                                    <button type="button" class="close-btn" id="closeModal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="user-data-table-wrapper">
                        <table class="user-data-table">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Preferences</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Dummy data for user data
                                $userData = [
                                    [
                                        'id' => 1,
                                        'username' => 'john_doe',
                                        'email' => 'john@example.com',
                                        'phone' => '+911234567890',
                                        'preferences' => 'Receive email notifications, prefer fast charging'
                                    ],
                                    [
                                        'id' => 2,
                                        'username' => 'jane_smith',
                                        'email' => 'jane@example.com',
                                        'phone' => '+919876543210',
                                        'preferences' => 'SMS alerts, eco-friendly charging'
                                    ],
                                    [
                                        'id' => 3,
                                        'username' => 'mike_tech',
                                        'email' => 'mike@example.com',
                                        'phone' => '+918765432109',
                                        'preferences' => 'No notifications'
                                    ],
                                    [
                                        'id' => 4,
                                        'username' => 'guest_user',
                                        'email' => 'guest@example.com',
                                        'phone' => '+917654321098',
                                        'preferences' => 'Guest mode, QR code access'
                                    ],
                                    [
                                        'id' => 5,
                                        'username' => 'alice_ev',
                                        'email' => 'alice@example.com',
                                        'phone' => '+916543210987',
                                        'preferences' => 'Mobile app notifications'
                                    ]
                                ];

                                foreach ($userData as $data) {
                                    echo "<tr>";
                                    echo "<td>" . $data['id'] . "</td>";
                                    echo "<td>" . $data['username'] . "</td>";
                                    echo "<td>" . $data['email'] . "</td>";
                                    echo "<td>" . $data['phone'] . "</td>";
                                    echo "<td>" . (strlen($data['preferences']) > 50 ? substr($data['preferences'], 0, 47) . '...' : $data['preferences']) . "</td>";
                                    echo "<td>";
                                    echo "<a href='#' class='action-btn view-btn' onclick='viewData(" . json_encode($data) . ")'>View</a>";
                                    echo "<a href='#' class='action-btn edit-btn' onclick='editData(" . json_encode($data) . ")'>Edit</a>";
                                    echo "<a href='#' class='action-btn delete-btn' onclick='deleteData(" . $data['id'] . ", \"" . $data['username'] . "\")'>Delete</a>";
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
            // Form toggle and validation for Add User Data form
            const addDataBtn = document.getElementById("addDataBtn");
            const dataForm = document.getElementById("dataForm");
            const cancelFormBtn = document.getElementById("cancelForm");
            const form = document.getElementById("userDataForm");
            const modal = document.getElementById("viewEditModal");
            const closeModalBtn = document.getElementById("closeModal");
            const viewEditForm = document.getElementById("viewEditForm");

            addDataBtn.addEventListener("click", function (e) {
                e.preventDefault();
                dataForm.classList.toggle("active");
                form.reset();
                clearErrors();
                document.getElementById("dataForm").dataset.mode = "add";
            });

            cancelFormBtn.addEventListener("click", function () {
                dataForm.classList.remove("active");
                form.reset();
                clearErrors();
            });

            form.addEventListener("submit", function (e) {
                e.preventDefault();
                let isValid = true;
                clearErrors();

                const userId = document.getElementById("userId");
                const username = document.getElementById("username");
                const email = document.getElementById("email");
                const phone = document.getElementById("phone");
                const preferences = document.getElementById("preferences");

                // Validate User ID (numeric)
                if (!userId.value || isNaN(userId.value)) {
                    showError("userId", "User ID is required and must be a number.");
                    isValid = false;
                }

                // Validate Username (3-20 characters)
                if (!username.value.trim() || username.value.length < 3 || username.value.length > 20) {
                    showError("username", "Username is required (3-20 characters).");
                    isValid = false;
                }

                // Validate Email
                if (!email.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                    showError("email", "Valid email is required.");
                    isValid = false;
                }

                // Validate Phone (e.g., +1234567890)
                if (!phone.value || !/^\+\d{10,12}$/.test(phone.value)) {
                    showError("phone", "Valid phone number is required (e.g., +1234567890).");
                    isValid = false;
                }

                // Validate Preferences (optional, max 500 characters)
                if (preferences.value.length > 500) {
                    showError("preferences", "Preferences must be less than 500 characters.");
                    isValid = false;
                }

                if (isValid) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'User data ' + (form.dataset.mode === 'add' ? 'added' : 'updated') + ' successfully!',
                        confirmButtonColor: '#1a73e8'
                    });
                    form.reset();
                    dataForm.classList.remove("active");
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
                const fields = ["userId", "username", "email", "phone", "preferences"];
                fields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    const error = document.getElementById(`${fieldId}Error`);
                    field.classList.remove("error");
                    error.style.display = "none";
                });
            }

            // View button functionality (show modal with read-only fields)
            window.viewData = function (data) {
                document.getElementById("modalHeader").textContent = "View User Data";
                document.getElementById("viewEditUserId").value = data.id;
                document.getElementById("viewEditUsername").value = data.username;
                document.getElementById("viewEditEmail").value = data.email;
                document.getElementById("viewEditPhone").value = data.phone;
                document.getElementById("viewEditPreferences").value = data.preferences;
                document.getElementById("modalActions").innerHTML = `
                    <button type="button" class="close-btn" id="closeModal">Close</button>
                `;
                modal.classList.add("active");
                // Reattach close button listener
                document.getElementById("closeModal").addEventListener("click", closeModal);
            };

            // Edit button functionality (show modal with editable fields)
            window.editData = function (data) {
                document.getElementById("modalHeader").textContent = "Edit User Data";
                document.getElementById("viewEditUserId").value = data.id;
                document.getElementById("viewEditUsername").value = data.username;
                document.getElementById("viewEditEmail").value = data.email;
                document.getElementById("viewEditPhone").value = data.phone;
                document.getElementById("viewEditPreferences").value = data.preferences;
                // Enable fields for editing
                document.getElementById("viewEditUserId").disabled = true; // Keep ID read-only
                document.getElementById("viewEditUsername").disabled = false;
                document.getElementById("viewEditEmail").disabled = false;
                document.getElementById("viewEditPhone").disabled = false;
                document.getElementById("viewEditPreferences").disabled = false;
                document.getElementById("modalActions").innerHTML = `
                    <button type="submit" class="submit-btn">Save</button>
                    <button type="button" class="cancel-btn" id="closeModal">Cancel</button>
                `;
                modal.classList.add("active");
                // Reattach close button listener
                document.getElementById("closeModal").addEventListener("click", closeModal);
                // Handle form submission
                viewEditForm.onsubmit = function (e) {
                    e.preventDefault();
                    let isValid = true;
                    // Clear any previous errors
                    document.querySelectorAll("#viewEditForm .error-message").forEach(error => {
                        error.style.display = "none";
                    });
                    document.querySelectorAll("#viewEditForm input, #viewEditForm textarea").forEach(field => {
                        field.classList.remove("error");
                    });

                    const username = document.getElementById("viewEditUsername");
                    const email = document.getElementById("viewEditEmail");
                    const phone = document.getElementById("viewEditPhone");
                    const preferences = document.getElementById("viewEditPreferences");

                    // Validate Username (3-20 characters)
                    if (!username.value.trim() || username.value.length < 3 || username.value.length > 20) {
                        showModalError("viewEditUsername", "Username is required (3-20 characters).");
                        isValid = false;
                    }

                    // Validate Email
                    if (!email.value || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value)) {
                        showModalError("viewEditEmail", "Valid email is required.");
                        isValid = false;
                    }

                    // Validate Phone (e.g., +1234567890)
                    if (!phone.value || !/^\+\d{10,12}$/.test(phone.value)) {
                        showModalError("viewEditPhone", "Valid phone number is required (e.g., +1234567890).");
                        isValid = false;
                    }

                    // Validate Preferences (optional, max 500 characters)
                    if (preferences.value.length > 500) {
                        showModalError("viewEditPreferences", "Preferences must be less than 500 characters.");
                        isValid = false;
                    }

                    if (isValid) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'User data updated successfully!',
                            confirmButtonColor: '#1a73e8'
                        });
                        modal.classList.remove("active");
                    }
                };
            };

            function showModalError(fieldId, message) {
                const field = document.getElementById(fieldId);
                let error = document.getElementById(`${fieldId}Error`);
                if (!error) {
                    error = document.createElement("div");
                    error.className = "error-message";
                    error.id = `${fieldId}Error`;
                    field.parentNode.appendChild(error);
                }
                field.classList.add("error");
                error.style.display = "block";
                error.textContent = message;
            }

            function closeModal() {
                modal.classList.remove("active");
                viewEditForm.reset();
                document.querySelectorAll("#viewEditForm .error-message").forEach(error => {
                    error.style.display = "none";
                });
                document.querySelectorAll("#viewEditForm input, #viewEditForm textarea").forEach(field => {
                    field.classList.remove("error");
                    field.disabled = true; // Reset to read-only
                });
            }

            // Delete button functionality with SweetAlert2
            window.deleteData = function (id, username) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to delete user data for ${username}. This action cannot be undone.`,
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
                            text: `User data for ${username} has been deleted.`,
                            confirmButtonColor: '#1a73e8'
                        });
                    }
                });
            };

            // Close modal when clicking outside
            modal.addEventListener("click", function (e) {
                if (e.target === modal) {
                    closeModal();
                }
            });
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