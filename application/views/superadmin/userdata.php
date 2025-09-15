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
    font-size: 12px;
}

.wrapper {
    overflow-y: auto;
    display: flex;
    width: 100%;
}

.logo {
    background-color: #f1f1f1;
    width: 100%;
    padding: 8px 0;
    text-align: center;
}

.logo img {
    width: 180px;
    margin: 0 auto;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 30px 0;
}

.content {
    width: 100%;
    padding: 8px;
    transition: all 0.3s;
}

#datetime {
    font-size: 12px;
    color: #333;
    padding: 8px 0;
    background: #e6f0ff;
    margin-top: 40px;
    text-align: center;
    border-radius: 4px;
}

#datetime span {
    font-weight: bold;
}

/* User Data Management Dashboard Styles */
.dashboard-container {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.dashboard-title {
    font-size: 20px;
    font-weight: 800;
    color: #1a73e8;
}

.add-data-btn {
    min-width: 150px;
    font-size: 14px;
    padding: 10px 20px;
    background: #1a73e8;
    color: #ffffff;
    border: none;
    border-radius: 8px;
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
    border-radius: 8px;
    overflow: hidden;
}

.user-data-table th, .user-data-table td {
    padding: 12px;
    text-align: left;
    color: #333;
    border-bottom: 1px solid #e0e0e0;
    font-size: 12px;
}

.user-data-table th {
    background: #f5f7fa;
    color: #333;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.8px;
}

.user-data-table tr:hover {
    background: #f9f9f9;
}

.action-btn {
    padding: 6px 12px;
    margin: 0 4px;
    border: none;
    border-radius: 4px;
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

.view-btn {
    background: #6c757d;
    color: #fff;
}

.view-btn:hover {
    background: #5a6268;
}

/* Form and Modal Styles */
.data-form-modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.data-form-modal.active {
    display: flex;
}

.data-form-container {
    background: #ffffff;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 450px;
}

.form-group {
    margin-bottom: 12px;
}

.form-group label {
    display: block;
    font-weight: 600;
    margin-bottom: 4px;
    color: #333;
    font-size: 12px;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    font-size: 12px;
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
    font-size: 10px;
    margin-top: 4px;
    display: none;
}

.form-actions {
    display: flex;
    gap: 8px;
}

.submit-btn,
.cancel-btn,
.close-btn {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    font-size: 12px;
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
    backdrop-filter: blur(4px);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

.modal.active {
    display: flex;
}

.modal-content {
    background: #ffffff;
    padding: 15px;
    border-radius: 8px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 3px 12px rgba(0, 0, 0, 0.2);
}

.modal-header {
    font-size: 16px;
    font-weight: 700;
    color: #1a73e8;
    margin-bottom: 15px;
}

/* Responsive Styles */
@media (max-width: 1024px) {
    .dashboard-container {
        padding: 15px;
    }

    .dashboard-header {
        flex-direction: column;
        gap: 12px;
    }

    .dashboard-title {
        font-size: 18px;
    }

    .add-data-btn {
        min-width: 140px;
        font-size: 13px;
        padding: 8px 15px;
    }

    .user-data-table th, .user-data-table td {
        padding: 10px;
        font-size: 11px;
    }

    .modal-content,
    .data-form-container {
        max-width: 90%;
    }
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 12px;
    }

    .dashboard-title {
        font-size: 16px;
    }

    .add-data-btn {
        min-width: 120px;
        font-size: 12px;
        padding: 8px 15px;
    }

    .user-data-table th, .user-data-table td {
        padding: 8px;
        font-size: 11px;
    }

    .form-group input,
    .form-group textarea {
        font-size: 11px;
    }

    .action-btn {
        padding: 5px 10px;
        font-size: 11px;
    }
}

@media (max-width: 480px) {
    .dashboard-container {
        padding: 8px;
    }

    .dashboard-header {
        flex-direction: column;
        gap: 8px;
    }

    .dashboard-title {
        font-size: 14px;
    }

    .add-data-btn {
        min-width: 100px;
        font-size: 11px;
        padding: 6px 12px;
    }

    .user-data-table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }

    .user-data-table th, .user-data-table td {
        min-width: 80px;
        font-size: 10px;
        padding: 6px;
    }

    .form-group input,
    .form-group textarea {
        font-size: 10px;
    }

    .action-btn {
        padding: 4px 8px;
        font-size: 10px;
    }

    .form-actions {
        flex-direction: column;
        gap: 6px;
    }

    .submit-btn,
    .cancel-btn,
    .close-btn {
        width: 100%;
        padding: 6px;
    }

    .modal-content,
    .data-form-container {
        max-width: 95%;
        padding: 12px;
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
                    <!-- Add User Data Modal -->
                    <div class="data-form-modal" id="dataFormModal">
                        <div class="data-form-container">
                            <div class="modal-header">Add User Data</div>
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
            const dataFormModal = document.getElementById("dataFormModal");
            const cancelFormBtn = document.getElementById("cancelForm");
            const form = document.getElementById("userDataForm");
            const modal = document.getElementById("viewEditModal");
            const closeModalBtn = document.getElementById("closeModal");
            const viewEditForm = document.getElementById("viewEditForm");

            addDataBtn.addEventListener("click", function (e) {
                e.preventDefault();
                dataFormModal.classList.add("active");
                form.reset();
                clearErrors();
                form.dataset.mode = "add";
            });

            cancelFormBtn.addEventListener("click", function () {
                dataFormModal.classList.remove("active");
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
                    dataFormModal.classList.remove("active");
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

            // Close modals when clicking outside
            dataFormModal.addEventListener("click", function (e) {
                if (e.target === dataFormModal) {
                    dataFormModal.classList.remove("active");
                    form.reset();
                    clearErrors();
                }
            });

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