<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Software Updates</title>
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
        .check-updates-btn {
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
            font-size: 12px;
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
            font-size: 12px;
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
            font-size: 12px;
        }
        .status-pending {
            color: #ffc107;
            font-weight: 600;
            font-size: 12px;
        }
        .status-failed {
            color: #dc3545;
            font-weight: 600;
            font-size: 12px;
        }
        .update-modal {
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
        .update-modal.active {
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
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 12px;
            box-sizing: border-box;
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
        .updates-table-wrapper {
            overflow-x: auto;
        }
        .update-modal.active ~ .wrapper #sidebar,
        .update-modal.active ~ .wrapper .content {
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
            .check-updates-btn {
                min-width: 140px;
                font-size: 10px;
                padding: 10px 20px;
            }
            .updates-table th, .updates-table td {
                padding: 10px;
                font-size: 11px;
            }
            .form-group input,
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
            .check-updates-btn {
                min-width: 120px;
                font-size: 9px;
                padding: 8px 15px;
            }
            .updates-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .updates-table th, .updates-table td {
                min-width: 100px;
                font-size: 10px;
                padding: 8px;
            }
            .form-group input,
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
                        <h2 class="dashboard-title">Software Updates</h2>
                        <a href="#" class="check-updates-btn" id="checkUpdatesBtn">Check for Updates</a>
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
                            <tbody id="updatesTbody">
                                <?php
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
                                    echo "<td>" . htmlspecialchars($update['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($update['version']) . "</td>";
                                    echo "<td>" . (strlen($update['description']) > 50 ? substr($update['description'], 0, 47) . '...' : htmlspecialchars($update['description'])) . "</td>";
                                    echo "<td>" . htmlspecialchars($update['release_date']) . "</td>";
                                    echo "<td class='$statusClass'>" . htmlspecialchars($update['status']) . "</td>";
                                    echo "<td>";
                                    echo "<button class='action-btn view-btn' onclick='viewUpdate(" . json_encode($update) . ")'>View</button>";
                                    echo "<button class='action-btn install-btn' onclick='installUpdate(\"" . $update['version'] . "\", \"" . $update['status'] . "\")'>" . ($update['status'] === 'Failed' ? 'Retry' : 'Install') . "</button>";
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

    <!-- View Update Modal -->
    <div id="viewModal" class="update-modal">
        <div class="modal-content">
            <div class="modal-header">View Update Details</div>
            <form id="viewForm">
                <div class="form-group">
                    <label for="viewUpdateId">Update ID</label>
                    <input type="text" id="viewUpdateId" name="viewUpdateId" disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="form-group">
                    <label for="viewVersion">Version</label>
                    <input type="text" id="viewVersion" name="viewVersion" disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="form-group">
                    <label for="viewDescription">Description</label>
                    <textarea id="viewDescription" name="viewDescription" rows="4" disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg"></textarea>
                </div>
                <div class="form-group">
                    <label for="viewReleaseDate">Release Date</label>
                    <input type="text" id="viewReleaseDate" name="viewReleaseDate" disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="form-group">
                    <label for="viewStatus">Status</label>
                    <input type="text" id="viewStatus" name="viewStatus" disabled class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                </div>
                <div class="form-actions">
                    <button type="button" class="close-btn" onclick="closeModal('viewModal')">Close</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Sidebar and Navbar functionality
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

        // Updates data
        let updates = <?php echo json_encode($updates); ?>;

        // Render table
        function renderTable() {
            const tbody = document.getElementById('updatesTbody');
            tbody.innerHTML = '';
            updates.forEach(update => {
                const statusClass = update.status.toLowerCase() === 'completed' ? 'status-completed' :
                    (update.status.toLowerCase() === 'pending' ? 'status-pending' : 'status-failed');
                const tr = document.createElement('tr');
                tr.setAttribute('data-id', update.id);
                tr.innerHTML = `
                    <td>${update.id}</td>
                    <td>${update.version}</td>
                    <td>${update.description.length > 50 ? update.description.substring(0, 47) + '...' : update.description}</td>
                    <td>${update.release_date}</td>
                    <td class="${statusClass}">${update.status}</td>
                    <td>
                        <button class="action-btn view-btn" onclick='viewUpdate(${JSON.stringify(update)})'>View</button>
                        <button class="action-btn install-btn" onclick='installUpdate("${update.version}", "${update.status}")'>${update.status === 'Failed' ? 'Retry' : 'Install'}</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // View Update
        function viewUpdate(update) {
            document.getElementById('viewUpdateId').value = update.id;
            document.getElementById('viewVersion').value = update.version;
            document.getElementById('viewDescription').value = update.description;
            document.getElementById('viewReleaseDate').value = update.release_date;
            document.getElementById('viewStatus').value = update.status;
            document.getElementById('viewModal').classList.add('active');
        }

        // Close Modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('active');
            if (modalId === 'viewModal') {
                document.getElementById('viewForm').reset();
            }
        }

        // Close modals on outside click
        window.onclick = function(event) {
            const viewModal = document.getElementById('viewModal');
            if (event.target === viewModal) {
                closeModal('viewModal');
            }
        }

        // Install Update
        function installUpdate(version, status) {
            Swal.fire({
                title: status === 'Failed' ? 'Retrying Update...' : 'Installing Update...',
                html: `Processing <strong>${version}</strong> <div class="progress-bar"><div class="progress"></div></div>`,
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                    const progress = document.querySelector('.progress');
                    progress.style.width = '100%';
                    setTimeout(() => {
                        const idx = updates.findIndex(u => u.version === version);
                        if (idx !== -1) {
                            updates[idx].status = 'Completed';
                            renderTable();
                        }
                        Swal.fire({
                            icon: 'success',
                            title: status === 'Failed' ? 'Retry Successful!' : 'Installation Complete!',
                            text: `${version} has been ${status === 'Failed' ? 'retried' : 'installed'} successfully.`,
                            confirmButtonColor: '#1a73e8'
                        });
                    }, 3000);
                }
            });
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            renderTable();
            document.getElementById('checkUpdatesBtn').addEventListener('click', function (e) {
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
        });

        // DateTime Update
        function updateDateTime() {
            const datetimeElement = document.getElementById('datetime');
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