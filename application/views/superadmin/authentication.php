<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Authentication Management</title>
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

        /* Authentication Management Dashboard Styles */
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

        .configure-auth-btn {
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

        .status-enabled {
            color: #28a745;
            font-weight: 600;
        }

        .status-disabled {
            color: #dc3545;
            font-weight: 600;
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
            font-size: 18px;
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
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group input.error,
        .form-group select.error,
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
        .cancel-btn {
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
                font-size: 22px;
            }

            .configure-auth-btn {
                min-width: 160px;
                font-size: 15px;
                padding: 10px 20px;
            }

            .auth-methods-table th, .auth-methods-table td {
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

            .configure-auth-btn {
                min-width: 140px;
                font-size: 14px;
                padding: 10px 20px;
            }

            .auth-methods-table th, .auth-methods-table td {
                padding: 10px;
                font-size: 13px;
            }

            .form-group input,
            .form-group select,
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

            .configure-auth-btn {
                min-width: 120px;
                font-size: 12px;
                padding: 8px 15px;
            }

            .auth-methods-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .auth-methods-table th, .auth-methods-table td {
                min-width: 100px;
                font-size: 12px;
                padding: 8px;
            }

            .form-group input,
            .form-group select,
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
            .cancel-btn {
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
                        <h2 class="dashboard-title">Authentication Management</h2>
                        <a href="#" class="configure-auth-btn" id="configureAuthBtn">Configure New Method</a>
                    </div>
                    <!-- Form Modal -->
                    <div class="modal" id="authModal">
                        <div class="modal-content">
                            <div class="modal-header" id="modalHeader"></div>
                            <form id="authMethodForm">
                                <div class="form-group">
                                    <label for="methodId">Method ID</label>
                                    <input type="text" id="methodId" name="methodId" required aria-describedby="methodIdError">
                                    <div class="error-message" id="methodIdError">Method ID is required and must be a number.</div>
                                </div>
                                <div class="form-group">
                                    <label for="methodName">Method Name</label>
                                    <input type="text" id="methodName" name="methodName" required aria-describedby="methodNameError">
                                    <div class="error-message" id="methodNameError">Method Name is required (minimum 3 characters).</div>
                                </div>
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea id="description" name="description" rows="4" required aria-describedby="descriptionError"></textarea>
                                    <div class="error-message" id="descriptionError">Description is required (minimum 10 characters).</div>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" required aria-describedby="statusError">
                                        <option value="">Select Status</option>
                                        <option value="Enabled">Enabled</option>
                                        <option value="Disabled">Disabled</option>
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
                            <tbody>
                                <?php
                                // Dummy data for authentication methods
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
                                    $statusIcon = $method['status'] === 'Enabled' ? '<i class="fas fa-check" style="color: #28a745;"></i>' : '<i class="fas fa-times" style="color: #dc3545;"></i>';
                                    $toggleText = $method['status'] === 'Enabled' ? 'Disable' : 'Enable';
                                    $buttonClass = $method['status'] === 'Enabled' ? '' : 'disabled';
                                    echo "<tr data-id=\"" . $method['id'] . "\">";
                                    echo "<td>" . $method['id'] . "</td>";
                                    echo "<td>" . $method['name'] . "</td>";
                                    echo "<td>" . $method['description'] . "</td>";
                                    echo "<td class=\"status $statusClass\">$statusIcon</td>";
                                    echo "<td>";
                                    echo "<a href='#' class='action-btn edit-btn' onclick='editAuthMethod(" . json_encode($method) . ")'>Edit</a>";
                                    echo "<a href='#' class='action-btn toggle-btn $buttonClass' onclick='toggleAuthMethod(" . $method['id'] . ", \"" . $method['status'] . "\")'>$toggleText</a>";
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
            const configureAuthBtn = document.getElementById("configureAuthBtn");
            const authModal = document.getElementById("authModal");
            const cancelModalBtn = document.getElementById("cancelModal");
            const form = document.getElementById("authMethodForm");

            configureAuthBtn.addEventListener("click", function (e) {
                e.preventDefault();
                document.getElementById("modalHeader").textContent = "Configure New Method";
                form.reset();
                clearErrors();
                document.getElementById("authMethodForm").dataset.mode = "add";
                document.getElementById("methodId").disabled = false;
                authModal.classList.add("active");
            });

            cancelModalBtn.addEventListener("click", closeModal);

            authModal.addEventListener("click", function (e) {
                if (e.target === authModal) {
                    closeModal();
                }
            });

            form.addEventListener("submit", function (e) {
                e.preventDefault();
                let isValid = true;
                clearErrors();

                const methodId = document.getElementById("methodId");
                const methodName = document.getElementById("methodName");
                const description = document.getElementById("description");
                const status = document.getElementById("status");

                if (!methodId.value || isNaN(methodId.value)) {
                    showError("methodId", "Method ID is required and must be a number.");
                    isValid = false;
                }

                if (!methodName.value.trim() || methodName.value.length < 3) {
                    showError("methodName", "Method Name is required (minimum 3 characters).");
                    isValid = false;
                }

                if (!description.value.trim() || description.value.length < 10) {
                    showError("description", "Description is required (minimum 10 characters).");
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
                        text: 'Authentication method ' + (form.dataset.mode === 'add' ? 'added' : 'updated') + ' successfully!',
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
                const fields = ["methodId", "methodName", "description", "status"];
                fields.forEach(fieldId => {
                    const field = document.getElementById(fieldId);
                    const error = document.getElementById(`${fieldId}Error`);
                    field.classList.remove("error");
                    error.style.display = "none";
                });
            }

            function closeModal() {
                authModal.classList.remove("active");
                form.reset();
                clearErrors();
            }

            // Edit button functionality
            window.editAuthMethod = function (method) {
                document.getElementById("modalHeader").textContent = "Edit Authentication Method";
                document.getElementById("authMethodForm").dataset.mode = "edit";
                document.getElementById("methodId").value = method.id;
                document.getElementById("methodId").disabled = true; // Prevent editing ID
                document.getElementById("methodName").value = method.name;
                document.getElementById("description").value = method.description;
                document.getElementById("status").value = method.status;
                clearErrors();
                authModal.classList.add("active");
            };

            // Toggle button functionality
            window.toggleAuthMethod = function (id, currentStatus) {
                const newStatus = currentStatus === 'Enabled' ? 'Disabled' : 'Enabled';
                Swal.fire({
                    title: 'Are you sure?',
                    text: `You are about to ${newStatus.toLowerCase()} this authentication method (ID: ${id}).`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#1a73e8',
                    cancelButtonColor: '#dc3545',
                    confirmButtonText: `Yes, ${newStatus.toLowerCase()} it!`,
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Update DOM
                        const newClass = newStatus === 'Enabled' ? 'status-enabled' : 'status-disabled';
                        const newIcon = newStatus === 'Enabled' ? '<i class="fas fa-check" style="color: #28a745;"></i>' : '<i class="fas fa-times" style="color: #dc3545;"></i>';
                        const newToggleText = newStatus === 'Enabled' ? 'Disable' : 'Enable';
                        const newButtonClass = newStatus === 'Enabled' ? '' : 'disabled';

                        const tr = document.querySelector(`tr[data-id="${id}"]`);
                        const statusTd = tr.querySelector('.status');
                        statusTd.innerHTML = newIcon;
                        statusTd.className = `status ${newClass}`;

                        const button = tr.querySelector('.toggle-btn');
                        button.textContent = newToggleText;
                        button.className = `action-btn toggle-btn ${newButtonClass}`;
                        button.setAttribute('onclick', `toggleAuthMethod(${id}, "${newStatus}")`);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: `Authentication method ${newStatus.toLowerCase()} successfully!`,
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