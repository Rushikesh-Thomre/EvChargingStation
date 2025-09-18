<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Charger Status</title>
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
        .add-charger-btn {
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
        .add-charger-btn:hover {
            background: #1557b0;
        }
        .chargers-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }
        .chargers-table th, .chargers-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
            font-size: 12px;
        }
        .chargers-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .chargers-table tr:hover {
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
        .start-btn, .edit-btn {
            background: #1a73e8;
            color: #fff;
        }
        .start-btn:hover, .edit-btn:hover {
            background: #1557b0;
        }
        .view-btn {
            background: #6c757d;
            color: #fff;
        }
        .view-btn:hover {
            background: #5a6268;
        }
        .charger-modal {
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
        .charger-modal.active {
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
        .progress-bar {
            width: 100%;
            height: 20px;
            background-color: #f3f4f6;
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #22c55e, #16a34a);
            width: 0%;
            transition: width 0.3s ease;
        }
        .chargers-table-wrapper {
            overflow-x: auto;
        }
        .charger-modal.active ~ .wrapper #sidebar,
        .charger-modal.active ~ .wrapper .content {
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
            .add-charger-btn {
                min-width: 140px;
                font-size: 10px;
                padding: 10px 20px;
            }
            .chargers-table th, .chargers-table td {
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
            .add-charger-btn {
                min-width: 120px;
                font-size: 9px;
                padding: 8px 15px;
            }
            .chargers-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .chargers-table th, .chargers-table td {
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
                        <h2 class="dashboard-title">Charger Status</h2>
                        <a href="#" class="add-charger-btn" id="addChargerBtn">Add New Charger</a>
                    </div>
                    <div class="chargers-table-wrapper">
                        <table class="chargers-table">
                            <thead>
                                <tr>
                                    <th>Charger ID</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Power</th>
                                    <th>Type</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="chargersTbody">
                                <?php
                                $chargers = [
                                    ['id' => 1, 'location' => 'New Delhi A1', 'status' => 'Available', 'power' => '50 kW', 'type' => 'CCS2'],
                                    ['id' => 2, 'location' => 'Mumbai A2', 'status' => 'In Use', 'power' => '50 kW', 'type' => 'CHAdeMO'],
                                    ['id' => 3, 'location' => 'Bangalore B1', 'status' => 'Out of Service', 'power' => '22 kW', 'type' => 'Type 2'],
                                    ['id' => 4, 'location' => 'Chennai B2', 'status' => 'Available', 'power' => '50 kW', 'type' => 'CCS2']
                                ];
                                foreach ($chargers as $charger) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($charger['id']) . "</td>";
                                    echo "<td>" . htmlspecialchars($charger['location']) . "</td>";
                                    echo "<td>" . htmlspecialchars($charger['status']) . "</td>";
                                    echo "<td>" . htmlspecialchars($charger['power']) . "</td>";
                                    echo "<td>" . htmlspecialchars($charger['type']) . "</td>";
                                    echo "<td>";
                                    if ($charger['status'] === 'Available') {
                                        echo "<button class='action-btn start-btn' onclick='startCharging(" . $charger['id'] . ")'>Start Charging</button>";
                                    } else {
                                        echo "<button class='action-btn view-btn' onclick='viewDetails(" . $charger['id'] . ")'>View Details</button>";
                                    }
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

    <!-- Start Charging Modal -->
    <div id="chargingModal" class="charger-modal">
        <div class="modal-content">
            <div class="modal-header" id="chargingModalTitle">Start Charging Session</div>
            <form id="chargingForm">
                <input type="hidden" id="chargerId" value="">
                <div class="form-group">
                    <label for="userName">Full Name</label>
                    <input type="text" id="userName" name="userName" required minlength="2" maxlength="50" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your full name">
                    <div class="error-message" id="userNameError">Name must be 2-50 characters.</div>
                </div>
                <div class="form-group">
                    <label for="vehicleModel">Vehicle Model</label>
                    <input type="text" id="vehicleModel" name="vehicleModel" required minlength="2" maxlength="30" pattern="[A-Za-z0-9\s]+" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Tesla Model 3">
                    <div class="error-message" id="vehicleModelError">Model must be alphanumeric, 2-30 characters.</div>
                </div>
                <div class="form-group">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" id="cardNumber" name="cardNumber" required pattern="\d{16}" maxlength="16" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="1234 5678 9012 3456">
                    <div class="error-message" id="cardNumberError">Card number must be 16 digits.</div>
                </div>
                <div class="form-group">
                    <label for="expiryDate">Expiry Date (MM/YY)</label>
                    <input type="text" id="expiryDate" name="expiryDate" required pattern="(0[1-9]|1[0-2])/[0-9]{2}" maxlength="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="MM/YY">
                    <div class="error-message" id="expiryDateError">Expiry must be MM/YY format.</div>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" id="cvv" name="cvv" required pattern="\d{3,4}" maxlength="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="123">
                    <div class="error-message" id="cvvError">CVV must be 3-4 digits.</div>
                </div>
                <div class="form-group">
                    <label for="amount">Amount ($)</label>
                    <input type="number" id="amount" name="amount" required min="0.01" step="0.01" value="10.00" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100">
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn">Initiate Charging</button>
                    <button type="button" class="cancel-btn" onclick="closeModal('chargingModal')">Close</button>
                </div>
            </form>
            <div id="progressSection" style="display: none;" class="mt-4">
                <h4 class="text-lg font-semibold mb-2">Charging in Progress...</h4>
                <div class="progress-bar">
                    <div id="progressFill" class="progress-fill"></div>
                </div>
                <p id="progressText" class="text-sm text-gray-600 mt-2">0% - Initializing...</p>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div id="detailsModal" class="charger-modal">
        <div class="modal-content">
            <div class="modal-header" id="detailsModalTitle">Charger Details</div>
            <form id="detailsForm">
                <input type="hidden" id="detailsChargerId" value="">
                <div class="form-group">
                    <label for="detailsId">Charger ID</label>
                    <input type="number" id="detailsId" name="detailsId" required readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100">
                    <div class="error-message" id="detailsIdError">Charger ID must be a positive number.</div>
                </div>
                <div class="form-group">
                    <label for="detailsLocation">Location</label>
                    <input type="text" id="detailsLocation" name="detailsLocation" required minlength="2" maxlength="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="error-message" id="detailsLocationError">Location must be 2-100 characters.</div>
                </div>
                <div class="form-group">
                    <label for="detailsStatus">Status</label>
                    <select id="detailsStatus" name="detailsStatus" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Status</option>
                        <option value="Available">Available</option>
                        <option value="In Use">In Use</option>
                        <option value="Out of Service">Out of Service</option>
                    </select>
                    <div class="error-message" id="detailsStatusError">Please select a status.</div>
                </div>
                <div class="form-group">
                    <label for="detailsPower">Power (kW)</label>
                    <input type="text" id="detailsPower" name="detailsPower" required pattern="\d+\s*kW" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., 50 kW">
                    <div class="error-message" id="detailsPowerError">Power must be in format like '50 kW'.</div>
                </div>
                <div class="form-group">
                    <label for="detailsType">Type</label>
                    <select id="detailsType" name="detailsType" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Type</option>
                        <option value="CCS2">CCS2</option>
                        <option value="CHAdeMO">CHAdeMO</option>
                        <option value="Type 2">Type 2</option>
                    </select>
                    <div class="error-message" id="detailsTypeError">Please select a type.</div>
                </div>
                <div class="form-group">
                    <label for="detailsNotes">Notes/Issues</label>
                    <textarea id="detailsNotes" name="detailsNotes" rows="3" maxlength="500" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Any additional notes or reported issues..."></textarea>
                    <div class="error-message" id="detailsNotesError">Notes must not exceed 500 characters.</div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="submit-btn">Update Details</button>
                    <button type="button" class="cancel-btn" onclick="closeModal('detailsModal')">Close</button>
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

        // Charger data
        let chargers = <?php echo json_encode($chargers); ?>;
        let currentEditId = null;

        // Render table
        function renderTable() {
            const tbody = document.getElementById('chargersTbody');
            tbody.innerHTML = '';
            chargers.forEach(charger => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${charger.id}</td>
                    <td>${charger.location}</td>
                    <td>${charger.status}</td>
                    <td>${charger.power}</td>
                    <td>${charger.type}</td>
                    <td>
                        ${charger.status === 'Available' ?
                            `<button class="action-btn start-btn" onclick="startCharging(${charger.id})">Start Charging</button>` :
                            `<button class="action-btn view-btn" onclick="viewDetails(${charger.id})">View Details</button>`}
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Open Charging Modal
        function startCharging(chargerId) {
            const charger = chargers.find(c => c.id == chargerId);
            if (charger && charger.status === 'Available') {
                document.getElementById('chargerId').value = chargerId;
                document.getElementById('chargingModal').classList.add('active');
                document.getElementById('progressSection').style.display = 'none';
                document.getElementById('chargingForm').classList.remove('hidden');
                clearErrors('chargingForm');
            }
        }

        // Open Details Modal
        function viewDetails(chargerId) {
            const charger = chargers.find(c => c.id == chargerId);
            if (charger) {
                document.getElementById('detailsChargerId').value = chargerId;
                document.getElementById('detailsId').value = charger.id;
                document.getElementById('detailsLocation').value = charger.location;
                document.getElementById('detailsStatus').value = charger.status;
                document.getElementById('detailsPower').value = charger.power;
                document.getElementById('detailsType').value = charger.type;
                document.getElementById('detailsNotes').value = '';
                document.getElementById('detailsModal').classList.add('active');
                clearErrors('detailsForm');
                currentEditId = chargerId;
            }
        }

        // Close Modal
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('active');
            if (modalId === 'chargingModal') {
                document.getElementById('chargingForm').reset();
                document.getElementById('progressSection').style.display = 'none';
                document.getElementById('chargingForm').classList.remove('hidden');
                clearErrors('chargingForm');
            } else if (modalId === 'detailsModal') {
                document.getElementById('detailsForm').reset();
                clearErrors('detailsForm');
            }
        }

        // Close modals on outside click
        window.onclick = function(event) {
            const chargingModal = document.getElementById('chargingModal');
            const detailsModal = document.getElementById('detailsModal');
            if (event.target === chargingModal) {
                closeModal('chargingModal');
            } else if (event.target === detailsModal) {
                closeModal('detailsModal');
            }
        }

        // Handle Charging Form Submit
        function handleChargingSubmit(e) {
            e.preventDefault();
            if (validateForm('chargingForm')) {
                document.getElementById('chargingForm').classList.add('hidden');
                document.getElementById('progressSection').style.display = 'block';
                simulateCharging();
            }
        }

        // Simulate Charging Process
        function simulateCharging() {
            let progress = 0;
            const progressFill = document.getElementById('progressFill');
            const progressText = document.getElementById('progressText');
            const stages = [
                { percent: 25, text: '25% - Connecting to vehicle...' },
                { percent: 50, text: '50% - Starting charge...' },
                { percent: 75, text: '75% - Charging in progress...' },
                { percent: 100, text: '100% - Session completed! You can now unplug.' }
            ];

            const interval = setInterval(() => {
                progress += 10;
                progressFill.style.width = progress + '%';
                progressText.textContent = Math.min(progress, 100) + '% - Charging...';

                const currentStage = stages.find(stage => progress <= stage.percent);
                if (currentStage) {
                    progressText.textContent = currentStage.text;
                }

                if (progress >= 100) {
                    clearInterval(interval);
                    Swal.fire({
                        icon: 'success',
                        title: 'Charging Complete',
                        text: 'Charging session completed successfully!',
                        confirmButtonColor: '#22c55e',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        closeModal('chargingModal');
                    });
                }
            }, 500);
        }

        // Handle Details Form Submit
        function handleDetailsSubmit(e) {
            e.preventDefault();
            if (validateForm('detailsForm')) {
                const chargerId = parseInt(document.getElementById('detailsId').value);
                const location = document.getElementById('detailsLocation').value.trim();
                const status = document.getElementById('detailsStatus').value;
                const power = document.getElementById('detailsPower').value;
                const type = document.getElementById('detailsType').value;
                const notes = document.getElementById('detailsNotes').value;

                if (chargerId !== parseInt(currentEditId) && chargers.some(c => parseInt(c.id) === chargerId)) {
                    showError(document.getElementById('detailsId'), 'Charger ID already exists.');
                    return;
                }

                const idx = chargers.findIndex(c => parseInt(c.id) === parseInt(currentEditId));
                if (idx !== -1) {
                    chargers[idx].id = chargerId;
                    chargers[idx].location = location;
                    chargers[idx].status = status;
                    chargers[idx].power = power;
                    chargers[idx].type = type;
                    renderTable();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Charger details updated successfully!',
                        confirmButtonColor: '#1a73e8'
                    });
                    closeModal('detailsModal');
                }
            }
        }

        // Form Validation
        function validateForm(formId) {
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('input, select, textarea');
            let isValid = true;
            clearErrors(formId);

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    showError(input);
                    isValid = false;
                }
            });

            if (formId === 'detailsForm') {
                const notes = document.getElementById('detailsNotes');
                if (notes.value.length > 500) {
                    showError(notes, 'Notes must not exceed 500 characters.');
                    isValid = false;
                }
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

        function clearErrors(formId) {
            const errors = document.querySelectorAll(`#${formId} .error-message`);
            errors.forEach(error => error.style.display = 'none');
            const inputs = document.querySelectorAll(`#${formId} input, #${formId} select, #${formId} textarea`);
            inputs.forEach(input => input.classList.remove('error'));
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            renderTable();
            document.getElementById("addChargerBtn").addEventListener("click", function (e) {
                e.preventDefault();
                openModal('add');
            });

            document.getElementById("chargingForm").addEventListener("submit", handleChargingSubmit);
            document.getElementById("detailsForm").addEventListener("submit", handleDetailsSubmit);

            const forms = ['chargingForm', 'detailsForm'];
            forms.forEach(formId => {
                const form = document.getElementById(formId);
                if (form) {
                    form.addEventListener('input', function(e) {
                        if (!e.target.checkValidity()) {
                            showError(e.target);
                        } else {
                            hideError(e.target);
                        }
                    });
                }
            });
        });

        // Open Modal for Adding Charger
        function openModal(mode, id = null) {
            const modal = document.getElementById('detailsModal');
            const form = document.getElementById('detailsForm');
            const title = document.getElementById('detailsModalTitle');
            form.reset();
            clearErrors('detailsForm');
            modal.dataset.mode = mode;
            if (mode === 'add') {
                title.textContent = 'Add New Charger';
                document.getElementById('detailsId').readOnly = false;
                document.getElementById('detailsChargerId').value = '';
                currentEditId = null;
            } else {
                title.textContent = 'Charger Details';
                document.getElementById('detailsId').readOnly = true;
            }
            modal.classList.add('active');
        }

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