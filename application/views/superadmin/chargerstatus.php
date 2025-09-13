<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV Charging Station - Charger Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding-top: 0;
            overflow-x: hidden;
        }

        .wrapper {
            display: flex;
            width: 100%;
            transition: all 0.3s ease;
        }

        .content {
            flex: 1;
            margin-left: 280px;
            width: calc(100% - 280px);
            transition: margin-left 0.3s ease, width 0.3s ease;
            padding: 0;
        }

        #sidebar.active ~ .content {
            margin-left: 0;
            width: 100%;
        }

        .charger-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95), rgba(255, 255, 255, 0.8));
            backdrop-filter: blur(10px);
        }

        .charger-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
        }

        .status-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .status-available { background-color: #22c55e; }
        .status-inuse { background-color: #f59e0b; }
        .status-outofservice { background-color: #ef4444; }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 0;
            border: none;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            max-height: 80vh;
            overflow-y: auto;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }

        .modal-content::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            padding: 10px;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
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

        /* Form Validation Styles */
        input:invalid {
            border-color: #ef4444;
        }

        input:valid {
            border-color: #22c55e;
        }

        .error-message {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: none;
        }

        /* Ensure form fields fit within modal */
        .modal-content form {
            padding: 1.5rem;
        }

        .modal-content input,
        .modal-content select,
        .modal-content textarea {
            width: 100%;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }

            #sidebar.active ~ .content {
                margin-left: 0;
                width: 100%;
            }

            .modal-content {
                width: 95%;
                margin: 10% auto;
            }
        }

        @media (max-width: 480px) {
            .content {
                margin-left: 0;
                width: 100%;
            }

            .charger-card {
                padding: 1rem;
            }

            .modal-content {
                width: 98%;
                margin: 5% auto;
                max-height: 85vh;
            }
        }
    </style>
</head>
<body class="bg-gray-100 font-sans">
    <?php $this->load->view('base/base') ?>

    <div class="wrapper">
        <div class="content">
            <main class="container mx-auto px-4 py-2">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Charger Status</h2>
                <div class="grid gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                    <?php
                    // Sample charger data (in a real application, this would come from a database)
                    $chargers = [
                        ["id" => 1, "location" => "Station A1", "status" => "Available", "power" => "50 kW", "type" => "CCS2"],
                        ["id" => 2, "location" => "Station A2", "status" => "In Use", "power" => "50 kW", "type" => "CHAdeMO"],
                        ["id" => 3, "location" => "Station B1", "status" => "Out of Service", "power" => "22 kW", "type" => "Type 2"],
                        ["id" => 4, "location" => "Station B2", "status" => "Available", "power" => "50 kW", "type" => "CCS2"]
                    ];

                    // Loop through chargers and display their status
                    foreach ($chargers as $charger) {
                        $statusClass = '';
                        $buttonText = ($charger['status'] == 'Available') ? "Start Charging" : "View Details";
                        $buttonAction = ($charger['status'] == 'Available') ? "startCharging" : "viewDetails";
                        if ($charger['status'] == 'Available') {
                            $statusClass = 'status-available';
                        } elseif ($charger['status'] == 'In Use') {
                            $statusClass = 'status-inuse';
                        } elseif ($charger['status'] == 'Out of Service') {
                            $statusClass = 'status-outofservice';
                        }

                        echo "<div class='charger-card bg-white p-6 rounded-lg shadow-md'>";
                        echo "<div class='flex justify-between items-center mb-4'>";
                        echo "<h3 class='text-xl font-semibold text-gray-800'>Charger ID: " . htmlspecialchars($charger['id']) . "</h3>";
                        echo "<span class='flex items-center text-sm font-medium text-gray-600'>";
                        echo "<span class='status-dot $statusClass'></span>" . htmlspecialchars($charger['status']);
                        echo "</span>";
                        echo "</div>";
                        echo "<p class='text-gray-600 mb-2'><strong>Location:</strong> " . htmlspecialchars($charger['location']) . "</p>";
                        echo "<p class='text-gray-600 mb-2'><strong>Power:</strong> " . htmlspecialchars($charger['power']) . "</p>";
                        echo "<p class='text-gray-600 mb-4'><strong>Type:</strong> " . htmlspecialchars($charger['type']) . "</p>";
                        echo "<button onclick='$buttonAction(" . $charger['id'] . ")' class='w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200 font-medium'>";
                        echo $buttonText;
                        echo "</button>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <!-- Start Charging Modal -->
    <div id="chargingModal" class="modal">
        <div class="modal-content">
            <div class="p-6">
                <span class="close" onclick="closeModal('chargingModal')">&times;</span>
                <h3 class="text-xl font-bold mb-4 text-gray-800">Start Charging Session</h3>
                <form id="chargingForm" onsubmit="handleChargingSubmit(event)">
                    <input type="hidden" id="chargerId" value="">
                    <div class="mb-4">
                        <label for="userName" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                        <input type="text" id="userName" name="userName" required minlength="2" maxlength="50" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your full name">
                        <div class="error-message" id="userNameError">Name must be 2-50 characters.</div>
                    </div>
                    <div class="mb-4">
                        <label for="vehicleModel" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Model</label>
                        <input type="text" id="vehicleModel" name="vehicleModel" required minlength="2" maxlength="30" pattern="[A-Za-z0-9\s]+" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., Tesla Model 3">
                        <div class="error-message" id="vehicleModelError">Model must be alphanumeric, 2-30 characters.</div>
                    </div>
                    <div class="mb-4">
                        <label for="cardNumber" class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                        <input type="text" id="cardNumber" name="cardNumber" required pattern="\d{16}" maxlength="16" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="1234 5678 9012 3456">
                        <div class="error-message" id="cardNumberError">Card number must be 16 digits.</div>
                    </div>
                    <div class="mb-4">
                        <label for="expiryDate" class="block text-sm font-medium text-gray-700 mb-2">Expiry Date (MM/YY)</label>
                        <input type="text" id="expiryDate" name="expiryDate" required pattern="(0[1-9]|1[0-2])/[0-9]{2}" maxlength="5" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="MM/YY">
                        <div class="error-message" id="expiryDateError">Expiry must be MM/YY format.</div>
                    </div>
                    <div class="mb-4">
                        <label for="cvv" class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                        <input type="text" id="cvv" name="cvv" required pattern="\d{3,4}" maxlength="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="123">
                        <div class="error-message" id="cvvError">CVV must be 3-4 digits.</div>
                    </div>
                    <div class="mb-4">
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount ($)</label>
                        <input type="number" id="amount" name="amount" required min="0.01" step="0.01" value="10.00" readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100">
                    </div>
                    <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition duration-200 font-medium">Initiate Charging</button>
                </form>
                <!-- Progress Section (Hidden Initially) -->
                <div id="progressSection" class="hidden mt-4">
                    <h4 class="text-lg font-semibold mb-2">Charging in Progress...</h4>
                    <div class="progress-bar">
                        <div id="progressFill" class="progress-fill"></div>
                    </div>
                    <p id="progressText" class="text-sm text-gray-600 mt-2">0% - Initializing...</p>
                </div>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div id="detailsModal" class="modal">
        <div class="modal-content">
            <div class="p-6">
                <span class="close" onclick="closeModal('detailsModal')">&times;</span>
                <h3 class="text-xl font-bold mb-4 text-gray-800">Charger Details</h3>
                <form id="detailsForm" onsubmit="handleDetailsSubmit(event)">
                    <input type="hidden" id="detailsChargerId" value="">
                    <div class="mb-4">
                        <label for="detailsId" class="block text-sm font-medium text-gray-700 mb-2">Charger ID</label>
                        <input type="text" id="detailsId" name="detailsId" required readonly class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100">
                    </div>
                    <div class="mb-4">
                        <label for="detailsLocation" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" id="detailsLocation" name="detailsLocation" required minlength="2" maxlength="100" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <div class="error-message" id="detailsLocationError">Location must be 2-100 characters.</div>
                    </div>
                    <div class="mb-4">
                        <label for="detailsStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="detailsStatus" name="detailsStatus" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Status</option>
                            <option value="Available">Available</option>
                            <option value="In Use">In Use</option>
                            <option value="Out of Service">Out of Service</option>
                        </select>
                        <div class="error-message" id="detailsStatusError">Please select a status.</div>
                    </div>
                    <div class="mb-4">
                        <label for="detailsPower" class="block text-sm font-medium text-gray-700 mb-2">Power (kW)</label>
                        <input type="text" id="detailsPower" name="detailsPower" required pattern="\d+\s*kW" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="e.g., 50 kW">
                        <div class="error-message" id="detailsPowerError">Power must be in format like '50 kW'.</div>
                    </div>
                    <div class="mb-4">
                        <label for="detailsType" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                        <select id="detailsType" name="detailsType" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Type</option>
                            <option value="CCS2">CCS2</option>
                            <option value="CHAdeMO">CHAdeMO</option>
                            <option value="Type 2">Type 2</option>
                        </select>
                        <div class="error-message" id="detailsTypeError">Please select a type.</div>
                    </div>
                    <div class="mb-4">
                        <label for="detailsNotes" class="block text-sm font-medium text-gray-700 mb-2">Notes/Issues</label>
                        <textarea id="detailsNotes" name="detailsNotes" rows="3" maxlength="500" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Any additional notes or reported issues..."></textarea>
                        <div class="error-message" id="detailsNotesError">Notes must not exceed 500 characters.</div>
                    </div>
                    <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-200 font-medium">Update Details</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Charger data for modals
        const chargers = <?php echo json_encode($chargers); ?>;

        // Open Charging Modal
        function startCharging(chargerId) {
            const charger = chargers.find(c => c.id == chargerId);
            if (charger && charger.status === 'Available') {
                document.getElementById('chargerId').value = chargerId;
                document.getElementById('chargingModal').style.display = 'block';
                document.getElementById('progressSection').classList.add('hidden');
                document.getElementById('chargingForm').classList.remove('hidden');
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
                document.getElementById('detailsModal').style.display = 'block';
            }
        }

        // Close Modal
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
            if (modalId === 'chargingModal') {
                document.getElementById('chargingForm').reset();
                document.getElementById('progressSection').classList.add('hidden');
                document.getElementById('chargingForm').classList.remove('hidden');
                hideAllErrors('chargingForm');
            } else if (modalId === 'detailsModal') {
                document.getElementById('detailsForm').reset();
                hideAllErrors('detailsForm');
            }
        }

        // Close modals on outside click
        window.onclick = function(event) {
            const chargingModal = document.getElementById('chargingModal');
            const detailsModal = document.getElementById('detailsModal');
            if (event.target == chargingModal) {
                closeModal('chargingModal');
            } else if (event.target == detailsModal) {
                closeModal('detailsModal');
            }
        }

        // Handle Charging Form Submit
        function handleChargingSubmit(event) {
            event.preventDefault();
            if (validateForm('chargingForm')) {
                document.getElementById('chargingForm').classList.add('hidden');
                document.getElementById('progressSection').classList.remove('hidden');
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
        function handleDetailsSubmit(event) {
            event.preventDefault();
            if (validateForm('detailsForm')) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Details updated successfully!',
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    closeModal('detailsModal');
                });
            }
        }

        // Form Validation
        function validateForm(formId) {
            const form = document.getElementById(formId);
            const inputs = form.querySelectorAll('input, select, textarea');
            let isValid = true;
            hideAllErrors(formId);

            inputs.forEach(input => {
                if (!input.checkValidity()) {
                    isValid = false;
                    showError(input);
                }
            });

            if (formId === 'detailsForm') {
                const notes = document.getElementById('detailsNotes');
                if (notes.value.length > 500) {
                    showError(notes, 'detailsNotesError');
                    isValid = false;
                }
            }

            return isValid;
        }

        function showError(input, errorId = input.id + 'Error') {
            const errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.style.display = 'block';
                input.classList.add('border-red-500');
            }
        }

        function hideAllErrors(formId) {
            const errors = document.querySelectorAll(`#${formId} .error-message`);
            errors.forEach(error => error.style.display = 'none');
            const inputs = document.querySelectorAll(`#${formId} input, #${formId} select, #${formId} textarea`);
            inputs.forEach(input => input.classList.remove('border-red-500'));
        }

        // Real-time validation on input
        document.addEventListener('DOMContentLoaded', function() {
            const forms = ['chargingForm', 'detailsForm'];
            forms.forEach(formId => {
                const form = document.getElementById(formId);
                if (form) {
                    form.addEventListener('input', function(e) {
                        if (!e.target.checkValidity()) {
                            showError(e.target);
                        } else {
                            const errorId = e.target.id + 'Error';
                            const errorElement = document.getElementById(errorId);
                            if (errorElement) errorElement.style.display = 'none';
                            e.target.classList.remove('border-red-500');
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>