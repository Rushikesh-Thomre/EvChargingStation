<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Monetization Settings</title>
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

        /* Monetization Dashboard Styles */
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

        .monetization-form {
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
        .monetization-modal {
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

        .monetization-modal.active {
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

            .monetization-form {
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
        .monetization-modal.active ~ .wrapper #sidebar,
        .monetization-modal.active ~ .wrapper .content {
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
                        <h2 class="dashboard-title">Monetization Settings</h2>
                    </div>
                    <div class="monetization-form" id="monetizationForm">
                        <div class="form-group">
                            <label for="pricePerKwh">Price per kWh (USD)</label>
                            <input type="number" id="pricePerKwh" name="pricePerKwh" step="0.01" min="0.01" max="10.00" value="0.30" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="pricePerKwhError">Price must be between 0.01 and 10.00 USD.</div>
                        </div>
                        <div class="form-group">
                            <label for="transactionFee">Transaction Fee (%)</label>
                            <input type="number" id="transactionFee" name="transactionFee" step="0.01" min="0" max="10" value="2.00" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="transactionFeeError">Transaction fee must be between 0 and 10%.</div>
                        </div>
                        <div class="form-group">
                            <label for="minimumCharge">Minimum Charge (USD)</label>
                            <input type="number" id="minimumCharge" name="minimumCharge" step="0.01" min="0.00" max="100.00" value="5.00" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <div class="error-message" id="minimumChargeError">Minimum charge must be between 0.00 and 100.00 USD.</div>
                        </div>
                        <div class="form-group">
                            <label for="billingCycle">Billing Cycle</label>
                            <select id="billingCycle" name="billingCycle" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="Daily">Daily</option>
                                <option value="Weekly">Weekly</option>
                                <option value="Monthly" selected>Monthly</option>
                            </select>
                            <div class="error-message" id="billingCycleError">Please select a billing cycle.</div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="save-btn" onclick="saveMonetization()"><i class="fas fa-save me-2"></i>Save</button>
                            <button type="button" class="reset-btn" onclick="resetMonetization()"><i class="fas fa-undo me-2"></i>Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="monetizationModal" class="monetization-modal">
        <div class="modal-content">
            <div class="modal-header" id="monetizationModalTitle">Confirm Monetization Update</div>
            <div class="modal-body">
                Are you sure you want to save these monetization settings? This will update the pricing and billing configuration.
            </div>
            <div class="modal-actions">
                <button type="button" class="confirm-btn" onclick="confirmSave()">Confirm</button>
                <button type="button" class="cancel-btn" onclick="closeMonetizationModal()">Cancel</button>
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
        // Default monetization settings
        const defaultMonetization = {
            pricePerKwh: '0.30',
            transactionFee: '2.00',
            minimumCharge: '5.00',
            billingCycle: 'Monthly'
        };

        // Validate Monetization Form
        function validateMonetizationForm() {
            const pricePerKwhInput = document.getElementById('pricePerKwh');
            const transactionFeeInput = document.getElementById('transactionFee');
            const minimumChargeInput = document.getElementById('minimumCharge');
            const billingCycleInput = document.getElementById('billingCycle');
            let isValid = true;

            clearErrors();

            // Validate at least one field is filled
            if (!pricePerKwhInput.value && !transactionFeeInput.value && !minimumChargeInput.value && !billingCycleInput.value) {
                showError(pricePerKwhInput, 'At least one field must be filled.');
                isValid = false;
            }

            // Validate price per kWh
            if (pricePerKwhInput.value) {
                const price = Number(pricePerKwhInput.value);
                const priceRegex = /^\d+(\.\d{1,2})?$/;
                if (!priceRegex.test(pricePerKwhInput.value) || price < 0.01 || price > 10.00) {
                    showError(pricePerKwhInput, 'Price must be between 0.01 and 10.00 USD.');
                    isValid = false;
                }
            }

            // Validate transaction fee
            if (transactionFeeInput.value) {
                const fee = Number(transactionFeeInput.value);
                const feeRegex = /^\d+(\.\d{1,2})?$/;
                if (!feeRegex.test(transactionFeeInput.value) || fee < 0 || fee > 10) {
                    showError(transactionFeeInput, 'Transaction fee must be between 0 and 10%.');
                    isValid = false;
                }
            }

            // Validate minimum charge
            if (minimumChargeInput.value) {
                const charge = Number(minimumChargeInput.value);
                const chargeRegex = /^\d+(\.\d{1,2})?$/;
                if (!chargeRegex.test(minimumChargeInput.value) || charge < 0 || charge > 100) {
                    showError(minimumChargeInput, 'Minimum charge must be between 0.00 and 100.00 USD.');
                    isValid = false;
                }
            }

            // Validate billing cycle
            if (!billingCycleInput.value) {
                showError(billingCycleInput, 'Please select a billing cycle.');
                isValid = false;
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
            const errors = document.querySelectorAll('#monetizationForm .error-message');
            errors.forEach(error => error.style.display = 'none');
            const inputs = document.querySelectorAll('#monetizationForm input, #monetizationForm select');
            inputs.forEach(input => input.classList.remove('error'));
        }

        // Save Monetization Settings
        function saveMonetization() {
            if (validateMonetizationForm()) {
                document.getElementById('monetizationModal').classList.add('active');
            }
        }

        // Confirm Save
        function confirmSave() {
            const pricePerKwh = document.getElementById('pricePerKwh').value || defaultMonetization.pricePerKwh;
            const transactionFee = document.getElementById('transactionFee').value || defaultMonetization.transactionFee;
            const minimumCharge = document.getElementById('minimumCharge').value || defaultMonetization.minimumCharge;
            const billingCycle = document.getElementById('billingCycle').value || defaultMonetization.billingCycle;

            // In production, save settings to database or server here
            console.log('Monetization settings saved:', { pricePerKwh, transactionFee, minimumCharge, billingCycle });

            closeMonetizationModal();
            Swal.fire({
                icon: 'success',
                title: 'Monetization Settings Saved',
                text: 'Your monetization settings have been updated successfully.',
                timer: 1500,
                showConfirmButton: false
            });
        }

        // Reset Monetization Settings
        function resetMonetization() {
            const form = document.getElementById('monetizationForm');
            form.reset();
            document.getElementById('pricePerKwh').value = defaultMonetization.pricePerKwh;
            document.getElementById('transactionFee').value = defaultMonetization.transactionFee;
            document.getElementById('minimumCharge').value = defaultMonetization.minimumCharge;
            document.getElementById('billingCycle').value = defaultMonetization.billingCycle;
            clearErrors();
            Swal.fire({
                icon: 'success',
                title: 'Monetization Settings Reset',
                text: 'Monetization settings have been reset to default values.',
                timer: 1500,
                showConfirmButton: false
            });
        }

        // Close Monetization Modal
        function closeMonetizationModal() {
            document.getElementById('monetizationModal').classList.remove('active');
        }

        // Close modal on outside click
        window.onclick = function(event) {
            const modal = document.getElementById('monetizationModal');
            if (event.target === modal) {
                closeMonetizationModal();
            }
        }

        // Event Listeners
        document.addEventListener("DOMContentLoaded", function () {
            // Real-time validation for monetization form
            const inputs = document.querySelectorAll('#monetizationForm input, #monetizationForm select');
            inputs.forEach(input => {
                input.addEventListener('input', function(e) {
                    if (e.target.id === 'pricePerKwh') {
                        const price = Number(e.target.value);
                        const priceRegex = /^\d+(\.\d{1,2})?$/;
                        if (e.target.value && (!priceRegex.test(e.target.value) || price < 0.01 || price > 10.00)) {
                            showError(e.target, 'Price must be between 0.01 and 10.00 USD.');
                        } else {
                            hideError(e.target);
                        }
                    } else if (e.target.id === 'transactionFee') {
                        const fee = Number(e.target.value);
                        const feeRegex = /^\d+(\.\d{1,2})?$/;
                        if (e.target.value && (!feeRegex.test(e.target.value) || fee < 0 || fee > 10)) {
                            showError(e.target, 'Transaction fee must be between 0 and 10%.');
                        } else {
                            hideError(e.target);
                        }
                    } else if (e.target.id === 'minimumCharge') {
                        const charge = Number(e.target.value);
                        const chargeRegex = /^\d+(\.\d{1,2})?$/;
                        if (e.target.value && (!chargeRegex.test(e.target.value) || charge < 0 || charge > 100)) {
                            showError(e.target, 'Minimum charge must be between 0.00 and 100.00 USD.');
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