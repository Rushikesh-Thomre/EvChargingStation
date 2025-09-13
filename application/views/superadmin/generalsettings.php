<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>General Settings</title>
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

        /* Settings Dashboard Styles */
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
            flex-wrap: wrap;
            gap: 15px;
        }

        .dashboard-title {
            font-size: 24px;
            font-weight: 800;
            color: #1a73e8;
        }

        .settings-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .form-group {
            min-width: 200px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input.error, .form-group select.error {
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
            justify-content: flex-end;
            grid-column: 1 / -1;
        }

        .save-btn, .reset-btn {
            min-width: 140px;
            font-size: 16px;
            padding: 12px 25px;
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

        .save-btn {
            background: #1a73e8;
            color: #ffffff;
        }

        .save-btn:hover {
            background: #1557b0;
        }

        .reset-btn {
            background: #6c757d;
            color: #ffffff;
        }

        .reset-btn:hover {
            background: #5a6268;
        }

        /* Modal Styles */
        .settings-modal {
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

        .settings-modal.active {
            display: flex;
        }

        .modal-content {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
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
            font-size: 18px;
            font-weight: 700;
            color: #1a73e8;
            margin-bottom: 20px;
        }

        .modal-body {
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .confirm-btn, .cancel-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .confirm-btn {
            background: #1a73e8;
            color: #fff;
        }

        .confirm-btn:hover {
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
                align-items: flex-start;
            }

            .modal-content {
                max-width: 90%;
            }

            .settings-form {
                grid-template-columns: 1fr;
            }

            .form-group {
                min-width: 100%;
            }
        }

        @media (max-width: 768px) {
            .dashboard-container {
                padding: 15px;
            }

            .dashboard-title {
                font-size: 20px;
            }

            .save-btn, .reset-btn {
                min-width: 140px;
                font-size: 14px;
                padding: 10px 20px;
            }

            .modal-body {
                font-size: 13px;
            }

            .confirm-btn, .cancel-btn {
                padding: 8px 15px;
                font-size: 13px;
            }
        }

        @media (max-width: 480px) {
            .dashboard-container {
                padding: 10px;
            }

            .dashboard-header {
                gap: 10px;
            }

            .dashboard-title {
                font-size: 18px;
            }

            .save-btn, .reset-btn {
                min-width: 120px;
                font-size: 12px;
                padding: 8px 15px;
            }

            .form-actions {
                flex-direction: column;
                gap: 8px;
            }

            .modal-content {
                max-width: 95%;
                padding: 15px;
            }

            .confirm-btn, .cancel-btn {
                width: 100%;
                padding: 8px;
            }
        }

        /* Blur Sidebar and Content when Modal is Active */
        .settings-modal.active ~ .wrapper #sidebar,
        .settings-modal.active ~ .wrapper .content {
            filter: blur(5px);
            transition: filter 0.3s ease;
        }

        #sidebar,
        .content {
            filter: none;
            transition: filter 0.3s ease;
        }
    </style>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php $this->load->view('base/base') ?>

    <div class="wrapper">
        <div class="content" id="abc">
            <div class="container-fluid">
                <div id="datetime"></div>
                <div class="dashboard-container">
                    <div class="dashboard-header">
                        <h2 class="dashboard-title">General Settings</h2>
                    </div>
                    <div class="settings-form" id="settingsForm">
                        <div class="form-group">
                            <label for="systemName">System Name</label>
                            <input type="text" id="systemName" name="systemName" maxlength="50" value="ChargePoint System" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="systemNameError">System name must be 2-50 characters (letters, spaces, dots, hyphens).</div>
                        </div>
                        <div class="form-group">
                            <label for="emailNotifications">Email Notifications</label>
                            <input type="email" id="emailNotifications" name="emailNotifications" value="admin@chargepoint.com" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="emailNotificationsError">Please enter a valid email address.</div>
                        </div>
                        <div class="form-group">
                            <label for="currency">Currency</label>
                            <select id="currency" name="currency" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="USD" selected>USD</option>
                                <option value="EUR">EUR</option>
                                <option value="INR">INR</option>
                            </select>
                            <div class="error-message" id="currencyError">Please select a currency.</div>
                        </div>
                        <div class="form-group">
                            <label for="maxDuration">Max Charging Duration (minutes)</label>
                            <input type="number" id="maxDuration" name="maxDuration" min="1" max="480" value="120" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="maxDurationError">Duration must be between 1 and 480 minutes.</div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="save-btn" onclick="saveSettings()"><i class="fas fa-save me-2"></i>Save</button>
                            <button type="button" class="reset-btn" onclick="resetSettings()"><i class="fas fa-undo me-2"></i>Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="settingsModal" class="settings-modal">
        <div class="modal-content">
            <div class="modal-header" id="settingsModalTitle">Confirm Settings Update</div>
            <div class="modal-body">
                Are you sure you want to save these settings? This will update the system configuration.
            </div>
            <div class="modal-actions">
                <button type="button" class="confirm-btn" onclick="confirmSave()">Confirm</button>
                <button type="button" class="cancel-btn" onclick="closeSettingsModal()">Cancel</button>
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
        // Default settings
        const defaultSettings = {
            systemName: 'ChargePoint System',
            emailNotifications: 'admin@chargepoint.com',
            currency: 'USD',
            maxDuration: '120'
        };

        // Validate Settings Form
        function validateSettingsForm() {
            const systemNameInput = document.getElementById('systemName');
            const emailInput = document.getElementById('emailNotifications');
            const currencyInput = document.getElementById('currency');
            const maxDurationInput = document.getElementById('maxDuration');
            let isValid = true;

            clearErrors();

            // Validate at least one field is filled
            if (!systemNameInput.value && !emailInput.value && !currencyInput.value && !maxDurationInput.value) {
                showError(systemNameInput, 'At least one field must be filled.');
                isValid = false;
            }

            // Validate system name
            if (systemNameInput.value) {
                const nameRegex = /^[a-zA-Z\s.-]{2,50}$/;
                if (!nameRegex.test(systemNameInput.value)) {
                    showError(systemNameInput, 'System name must be 2-50 characters (letters, spaces, dots, hyphens).');
                    isValid = false;
                }
            }

            // Validate email
            if (emailInput.value) {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(emailInput.value)) {
                    showError(emailInput, 'Please enter a valid email address.');
                    isValid = false;
                }
            }

            // Validate currency
            if (!currencyInput.value) {
                showError(currencyInput, 'Please select a currency.');
                isValid = false;
            }

            // Validate max duration
            if (maxDurationInput.value) {
                const duration = Number(maxDurationInput.value);
                if (isNaN(duration) || duration < 1 || duration > 480) {
                    showError(maxDurationInput, 'Duration must be between 1 and 480 minutes.');
                    isValid = false;
                }
            }

            return isValid;
        }

        // Show Error
        function showError(input, message) {
            const errorId = input.id + 'Error';
            const errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';
                input.classList.add('error');
            }
        }

        // Clear Errors
        function clearErrors() {
            const errors = document.querySelectorAll('#settingsForm .error-message');
            errors.forEach(error => error.style.display = 'none');
            const inputs = document.querySelectorAll('#settingsForm input, #settingsForm select');
            inputs.forEach(input => input.classList.remove('error'));
        }

        // Save Settings
        function saveSettings() {
            if (validateSettingsForm()) {
                document.getElementById('settingsModal').classList.add('active');
            }
        }

        // Confirm Save
        function confirmSave() {
            const systemName = document.getElementById('systemName').value || defaultSettings.systemName;
            const emailNotifications = document.getElementById('emailNotifications').value || defaultSettings.emailNotifications;
            const currency = document.getElementById('currency').value || defaultSettings.currency;
            const maxDuration = document.getElementById('maxDuration').value || defaultSettings.maxDuration;

            // In production, save settings to database or server here
            console.log('Settings saved:', { systemName, emailNotifications, currency, maxDuration });

            closeSettingsModal();
            Swal.fire({
                icon: 'success',
                title: 'Settings Saved',
                text: 'Your settings have been updated successfully.',
                timer: 1500,
                showConfirmButton: false
            });
        }

        // Reset Settings
        function resetSettings() {
            const form = document.getElementById('settingsForm');
            form.reset();
            document.getElementById('systemName').value = defaultSettings.systemName;
            document.getElementById('emailNotifications').value = defaultSettings.emailNotifications;
            document.getElementById('currency').value = defaultSettings.currency;
            document.getElementById('maxDuration').value = defaultSettings.maxDuration;
            clearErrors();
            Swal.fire({
                icon: 'success',
                title: 'Settings Reset',
                text: 'Settings have been reset to default values.',
                timer: 1500,
                showConfirmButton: false
            });
        }

        // Close Settings Modal
        function closeSettingsModal() {
            document.getElementById('settingsModal').classList.remove('active');
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('settingsModal');
            if (event.target === modal) {
                closeSettingsModal();
            }
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            // Real-time validation for settings form
            const inputs = document.querySelectorAll('#settingsForm input, #settingsForm select');
            inputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    if (e.target.id === 'systemName') {
                        const nameRegex = /^[a-zA-Z\s.-]{2,50}$/;
                        if (e.target.value && !nameRegex.test(e.target.value)) {
                            showError(e.target, 'System name must be 2-50 characters (letters, spaces, dots, hyphens).');
                        } else {
                            hideError(e.target);
                        }
                    } else if (e.target.id === 'emailNotifications') {
                        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (e.target.value && !emailRegex.test(e.target.value)) {
                            showError(e.target, 'Please enter a valid email address.');
                        } else {
                            hideError(e.target);
                        }
                    } else if (e.target.id === 'maxDuration') {
                        const duration = Number(e.target.value);
                        if (e.target.value && (isNaN(duration) || duration < 1 || duration > 480)) {
                            showError(e.target, 'Duration must be between 1 and 480 minutes.');
                        } else {
                            hideError(e.target);
                        }
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

        // Helper function to hide error
        function hideError(input) {
            const errorId = input.id + 'Error';
            const errorElement = document.getElementById(errorId);
            if (errorElement) {
                errorElement.style.display = 'none';
                input.classList.remove('error');
            }
        }
    </script>
</body>
</html>