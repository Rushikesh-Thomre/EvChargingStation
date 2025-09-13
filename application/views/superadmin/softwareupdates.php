<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Software Updates</title>
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

        /* Software Updates Dashboard Styles */
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

        .check-updates-btn {
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

        .check-updates-btn:hover {
            background: #1557b0;
        }

        .updates-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }

        .updates-table th, .updates-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
        }

        .updates-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .updates-table tr:hover {
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

        .install-btn {
            background: #1a73e8;
            color: #fff;
        }

        .install-btn:hover {
            background: #1557b0;
        }

        .view-btn {
            background: #6c757d;
            color: #fff;
        }

        .view-btn:hover {
            background: #5a6268;
        }

        .status-completed {
            color: #28a745;
            font-weight: 600;
        }

        .status-pending {
            color: #ffc107;
            font-weight: 600;
        }

        .status-failed {
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

        .form-actions {
            display: flex;
            gap: 10px;
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

        /* Progress Bar for SweetAlert2 */
        .progress-bar {
            width: 100%;
            height: 10px;
            background: #e0e0e0;
            border-radius: 5px;
            margin-top: 15px;
            overflow: hidden;
        }

        .progress {
            width: 0;
            height: 100%;
            background: #1a73e8;
            transition: width 3s ease;
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

            .check-updates-btn {
                min-width: 160px;
                font-size: 15px;
                padding: 10px 20px;
            }

            .updates-table th, .updates-table td {
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

            .check-updates-btn {
                min-width: 140px;
                font-size: 14px;
                padding: 10px 20px;
            }

            .updates-table th, .updates-table td {
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

            .check-updates-btn {
                min-width: 120px;
                font-size: 12px;
                padding: 8px 15px;
            }

            .updates-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }

            .updates-table th, .updates-table td {
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
                        <h2 class="dashboard-title">Software Updates</h2>
                        <a href="#" class="check-updates-btn" id="checkUpdatesBtn">Check for Updates</a>
                    </div>
                    <!-- View Modal -->
                    <div class="modal" id="viewModal">
                        <div class="modal-content">
                            <div class="modal-header">View Update Details</div>
                            <form id="viewForm">
                                <div class="form-group">
                                    <label for="viewUpdateId">Update ID</label>
                                    <input type="text" id="viewUpdateId" name="viewUpdateId" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="viewVersion">Version</label>
                                    <input type="text" id="viewVersion" name="viewVersion" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="viewDescription">Description</label>
                                    <textarea id="viewDescription" name="viewDescription" rows="4" disabled></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="viewReleaseDate">Release Date</label>
                                    <input type="text" id="viewReleaseDate" name="viewReleaseDate" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="viewStatus">Status</label>
                                    <input type="text" id="viewStatus" name="viewStatus" disabled>
                                </div>
                                <div class="form-actions">
                                    <button type="button" class="close-btn" id="closeViewModal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="updates-table-wrapper">
                        <table class="updates-table">
                            <thead>
                                <tr>
                                    <th>Update ID</th>
                                    <th>Version</th>
                                    <th>Description</th>
                                    <th>Release Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Dummy data for software updates
                                $updates = [
                                    [
                                        'id' => 1,
                                        'version' => 'Charger Firmware v3.2.1',
                                        'description' => 'Enhanced charging efficiency and improved user interface.',
                                        'release_date' => '2025-09-10',
                                        'status' => 'Completed'
                                    ],
                                    [
                                        'id' => 2,
                                        'version' => 'Dashboard Update v2.1.0',
                                        'description' => 'New analytics features and bug fixes.',
                                        'release_date' => '2025-09-05',
                                        'status' => 'Pending'
                                    ],
                                    [
                                        'id' => 3,
                                        'version' => 'Security Patch v1.0.3',
                                        'description' => 'Critical security update for payment processing.',
                                        'release_date' => '2025-08-30',
                                        'status' => 'Failed'
                                    ]
                                ];

                                foreach ($updates as $update) {
                                    $statusClass = strtolower($update['status']) === 'completed' ? 'status-completed' :
                                        (strtolower($update['status']) === 'pending' ? 'status-pending' : 'status-failed');
                                    echo "<tr data-id=\"" . $update['id'] . "\">";
                                    echo "<td>" . $update['id'] . "</td>";
                                    echo "<td>" . $update['version'] . "</td>";
                                    echo "<td>" . (strlen($update['description']) > 50 ? substr($update['description'], 0, 47) . '...' : $update['description']) . "</td>";
                                    echo "<td>" . $update['release_date'] . "</td>";
                                    echo "<td class='$statusClass'>" . $update['status'] . "</td>";
                                    echo "<td>";
                                    echo "<a href='#' class='action-btn view-btn' onclick='viewUpdate(" . json_encode($update) . ")'>View</a>";
                                    echo "<a href='#' class='action-btn install-btn' onclick='installUpdate(\"" . $update['version'] . "\", \"" . $update['status'] . "\")'>" . ($update['status'] === 'Failed' ? 'Retry' : 'Install') . "</a>";
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
            // Check Updates button functionality
            const checkUpdatesBtn = document.getElementById("checkUpdatesBtn");
            const viewModal = document.getElementById("viewModal");
            const closeViewModalBtn = document.getElementById("closeViewModal");

            checkUpdatesBtn.addEventListener("click", function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Checking for Updates...',
                    text: 'Please wait while we check for new software updates.',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        setTimeout(() => {
                            Swal.fire({
                                icon: 'info',
                                title: 'No New Updates',
                                text: 'Your system is up to date.',
                                confirmButtonColor: '#1a73e8'
                            });
                        }, 2000);
                    }
                });
            });

            // View Update button functionality
            window.viewUpdate = function (update) {
                document.getElementById("viewUpdateId").value = update.id;
                document.getElementById("viewVersion").value = update.version;
                document.getElementById("viewDescription").value = update.description;
                document.getElementById("viewReleaseDate").value = update.release_date;
                document.getElementById("viewStatus").value = update.status;
                viewModal.classList.add("active");
            };

            // Close View Modal
            closeViewModalBtn.addEventListener("click", closeViewModal);
            viewModal.addEventListener("click", function (e) {
                if (e.target === viewModal) {
                    closeViewModal();
                }
            });

            function closeViewModal() {
                viewModal.classList.remove("active");
                document.getElementById("viewForm").reset();
            }

            // Install Update button functionality
            window.installUpdate = function (version, status) {
                Swal.fire({
                    title: status === 'Failed' ? 'Retrying Update...' : 'Installing Update...',
                    html: `Processing <strong>${version}</strong> <div class="progress-bar"><div class="progress"></div></div>`,
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        const progress = document.querySelector('.progress');
                        progress.style.width = '100%';
                        setTimeout(() => {
                            Swal.fire({
                                icon: 'success',
                                title: status === 'Failed' ? 'Retry Successful!' : 'Installation Complete!',
                                text: `${version} has been ${status === 'Failed' ? 'retried' : 'installed'} successfully.`,
                                confirmButtonColor: '#1a73e8'
                            });
                        }, 3000);
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