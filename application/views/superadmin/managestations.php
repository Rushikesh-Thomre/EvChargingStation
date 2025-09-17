<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Stations</title>
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
        }
        .dashboard-title {
            font-size: 18px;
            font-weight: 800;
            color: #1a73e8;
        }
        .add-station-btn {
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
        .add-station-btn:hover {
            background: #1557b0;
        }
        .stations-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
        }
        .stations-table th, .stations-table td {
            padding: 15px;
            text-align: left;
            color: #333;
            border-bottom: 1px solid #e0e0e0;
            font-size: 12px;
        }
        .stations-table th {
            background: #f5f7fa;
            color: #333;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .stations-table tr:hover {
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
        .station-modal {
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
        .station-modal.active {
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
        .stations-table-wrapper {
            overflow-x: auto;
        }
        .station-modal.active ~ .wrapper #sidebar,
        .station-modal.active ~ .wrapper .content {
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
            .add-station-btn {
                min-width: 140px;
                font-size: 10px;
                padding: 10px 20px;
            }
            .stations-table th, .stations-table td {
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
            .add-station-btn {
                min-width: 120px;
                font-size: 9px;
                padding: 8px 15px;
            }
            .stations-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            .stations-table th, .stations-table td {
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
                    <div class="dashboard-header">
                        <h2 class="dashboard-title">Manage Charging Stations</h2>
                        <a href="#" class="add-station-btn" id="addStationBtn">Add New Station</a>
                    </div>
                    <div class="stations-table-wrapper">
                        <table class="stations-table">
                            <thead>
                                <tr>
                                    <th>Station ID</th>
                                    <th>Name</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="stationsTbody">
                                <?php
                                $stations = [
                                    ['id' => 1, 'name' => 'Station A', 'location' => 'New Delhi', 'status' => 'Active'],
                                    ['id' => 2, 'name' => 'Station B', 'location' => 'Mumbai', 'status' => 'Offline'],
                                    ['id' => 3, 'name' => 'Station C', 'location' => 'Bangalore', 'status' => 'Active'],
                                    ['id' => 4, 'name' => 'Station D', 'location' => 'Chennai', 'status' => 'Active'],
                                    ['id' => 5, 'name' => 'Station E', 'location' => 'Hyderabad', 'status' => 'Offline']
                                ];
                                foreach ($stations as $station) {
                                    echo "<tr>";
                                    echo "<td>" . $station['id'] . "</td>";
                                    echo "<td>" . $station['name'] . "</td>";
                                    echo "<td>" . $station['location'] . "</td>";
                                    echo "<td>" . $station['status'] . "</td>";
                                    echo "<td>";
                                    echo "<button class='action-btn edit-btn' onclick='editStation(" . $station['id'] . ")'>Edit</button>";
                                    echo "<button class='action-btn delete-btn' onclick='deleteStation(" . $station['id'] . ")'>Delete</button>";
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

    <!-- Station Modal -->
    <div id="stationModal" class="station-modal">
        <div class="modal-content">
            <div class="modal-header" id="modalTitle">Add New Station</div>
            <form id="stationForm">
                <input type="hidden" id="editId" value="">
                <div class="form-group">
                    <label for="stationId">Station ID</label>
                    <input type="number" id="stationId" name="stationId" required min="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="error-message" id="stationIdError">Station ID must be a positive number.</div>
                </div>
                <div class="form-group">
                    <label for="stationName">Station Name</label>
                    <input type="text" id="stationName" name="stationName" required minlength="2" maxlength="50" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="error-message" id="stationNameError">Station Name must be 2-50 characters.</div>
                </div>
                <div class="form-group">
                    <label for="location">Location</label>
                    <input type="text" id="location" name="location" required minlength="2" maxlength="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <div class="error-message" id="locationError">Location must be 2-100 characters.</div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Status</option>
                        <option value="Active">Active</option>
                        <option value="Offline">Offline</option>
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
            // Toggle sidebar
            $('#sidebarToggle').on('click', function (e) {
                e.preventDefault();
                $('#sidebar').toggleClass('active');
                $('#abc').toggleClass('expanded');
                const toggleIcon = $(this).find('i');
                toggleIcon.toggleClass('fa-chevron-left fa-chevron-right'); // Toggle between left and right arrows
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

        // Stations data
        let stations = <?php echo json_encode($stations); ?>;
        let currentEditId = null;

        // Render table
        function renderTable() {
            const tbody = document.getElementById('stationsTbody');
            tbody.innerHTML = '';
            stations.forEach(station => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
                    <td>${station.id}</td>
                    <td>${station.name}</td>
                    <td>${station.location}</td>
                    <td>${station.status}</td>
                    <td>
                        <button class="action-btn edit-btn" onclick="editStation(${station.id})">Edit</button>
                        <button class="action-btn delete-btn" onclick="deleteStation(${station.id})">Delete</button>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        // Open Modal
        function openModal(mode, id = null) {
            const modal = document.getElementById('stationModal');
            const form = document.getElementById('stationForm');
            const title = document.getElementById('modalTitle');
            form.reset();
            clearErrors();
            modal.dataset.mode = mode;
            if (mode === 'add') {
                title.textContent = 'Add New Station';
                document.getElementById('stationId').readOnly = false;
                document.getElementById('editId').value = '';
                currentEditId = null;
            } else {
                title.textContent = 'Edit Station';
                document.getElementById('stationId').readOnly = false;
                const station = stations.find(s => parseInt(s.id) === parseInt(id));
                if (station) {
                    document.getElementById('editId').value = id;
                    document.getElementById('stationId').value = station.id;
                    document.getElementById('stationName').value = station.name;
                    document.getElementById('location').value = station.location;
                    document.getElementById('status').value = station.status;
                    currentEditId = id;
                }
            }
            modal.classList.add('active');
        }

        // Close Modal
        function closeModal() {
            const modal = document.getElementById('stationModal');
            modal.classList.remove('active');
            clearErrors();
        }

        // Close on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('stationModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // Form Submission
        function handleFormSubmit(e) {
            e.preventDefault();
            if (validateForm()) {
                const mode = document.getElementById('stationModal').dataset.mode;
                const stationId = parseInt(document.getElementById('stationId').value);
                const stationName = document.getElementById('stationName').value.trim();
                const location = document.getElementById('location').value.trim();
                const status = document.getElementById('status').value;

                if (mode === 'add') {
                    if (stations.some(s => parseInt(s.id) === stationId)) {
                        showError(document.getElementById('stationId'), 'Station ID already exists.');
                        return;
                    }
                    stations.push({ id: stationId, name: stationName, location, status });
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Station added successfully!',
                        confirmButtonColor: '#1a73e8'
                    });
                } else {
                    if (stationId !== parseInt(currentEditId) && stations.some(s => parseInt(s.id) === stationId)) {
                        showError(document.getElementById('stationId'), 'Station ID already exists.');
                        return;
                    }
                    const idx = stations.findIndex(s => parseInt(s.id) === parseInt(currentEditId));
                    if (idx !== -1) {
                        stations[idx].id = stationId;
                        stations[idx].name = stationName;
                        stations[idx].location = location;
                        stations[idx].status = status;
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Station updated successfully!',
                            confirmButtonColor: '#1a73e8'
                        });
                    }
                }
                renderTable();
                closeModal();
            }
        }

        // Edit Station
        function editStation(id) {
            openModal('edit', id);
        }

        // Delete Station
        function deleteStation(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    stations = stations.filter(s => parseInt(s.id) !== parseInt(id));
                    renderTable();
                    Swal.fire({
                        icon: 'success',
                        title: 'Deleted!',
                        text: 'Station has been deleted.',
                        confirmButtonColor: '#1a73e8'
                    });
                }
            });
        }

        // Form Validation
        function validateForm() {
            const inputs = document.querySelectorAll('#stationForm input, #stationForm select');
            let isValid = true;
            clearErrors();

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    showError(input);
                    isValid = false;
                }
            });

            const stationId = parseInt(document.getElementById('stationId').value);
            if (isNaN(stationId) || stationId < 1) {
                showError(document.getElementById('stationId'), 'Station ID must be a positive number.');
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
            const errors = document.querySelectorAll('#stationForm .error-message');
            errors.forEach(error => error.style.display = 'none');
            const inputs = document.querySelectorAll('#stationForm input, #stationForm select');
            inputs.forEach(input => input.classList.remove('error'));
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            renderTable();
            document.getElementById("addStationBtn").addEventListener("click", function (e) {
                e.preventDefault();
                openModal('add');
            });

            const form = document.getElementById("stationForm");
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