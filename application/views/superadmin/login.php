<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>EV Charging - Login</title>
    <link rel="icon" href="<?php echo base_url('Images/logo.png'); ?>" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #0B2F8B;
            --secondary: #4A90E2;
            --success: #28a745;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --white: #ffffff;
            --shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            --border-radius: 8px;
            --transition: all 0.2s ease;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #e6f0fa 0%, #f5f7fa 100%);
            margin: 0;
            color: var(--dark);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 1rem;
        }
        .auth-container {
            width: 100%;
            max-width: 400px;
            background: var(--white);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 1.5rem;
            transition: var(--transition);
        }
        .auth-title {
            font-size: calc(14px + 0.8vw);
            font-weight: 600;
            color: var(--primary);
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-group {
            margin-bottom: 1rem;
            position: relative;
        }
        .form-label {
            font-size: calc(10px + 0.4vw);
            color: var(--dark);
            font-weight: 500;
        }
        .form-control {
            font-size: calc(10px + 0.4vw);
            padding: 0.8rem;
            border-radius: var(--border-radius);
            border: 1px solid #ced4da;
            transition: var(--transition);
            width: 100%;
        }
        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 5px rgba(11, 47, 139, 0.2);
        }
        .btn-primary {
            background: var(--primary);
            border: none;
            font-size: calc(10px + 0.4vw);
            padding: 0.8rem;
            border-radius: var(--border-radius);
            transition: var(--transition);
            width: 100%;
        }
        .btn-primary:hover {
            background: var(--secondary);
        }
        .switch-link {
            text-align: center;
            margin-top: 1rem;
            font-size: calc(9px + 0.3vw);
        }
        .switch-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        .switch-link a:hover {
            text-decoration: underline;
            color: var(--secondary);
        }
        .error-message {
            color: var(--danger);
            font-size: calc(8px + 0.3vw);
            margin-top: 0.3rem;
            display: none;
        }
        .form-group i {
            position: absolute;
            right: 1rem;
            top: 2.8rem;
            color: var(--secondary);
            cursor: pointer;
        }
        .toggle-password {
            cursor: pointer;
        }
        /* Media Queries for Responsiveness */
        @media (max-width: 576px) {
            .auth-container {
                padding: 1rem;
                max-width: 90%;
            }
            .auth-title {
                font-size: calc(12px + 0.8vw);
            }
            .form-control {
                font-size: calc(9px + 0.4vw);
                padding: 0.6rem;
            }
            .btn-primary {
                font-size: calc(9px + 0.4vw);
                padding: 0.6rem;
            }
            .form-group i {
                top: 2.5rem;
            }
        }
        @media (min-width: 768px) {
            .auth-container {
                padding: 2rem;
                max-width: 450px;
            }
        }
    </style>
</head>
<body>
    <div class="auth-container" id="login-form">
        <h2 class="auth-title">Login to EV Charging</h2>
        <form id="loginForm" action="<?php echo base_url('dashboard'); ?>" method="POST">
            <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
                <i class="fas fa-envelope"></i>
                <div class="error-message" id="emailError">Please enter a valid email address.</div>
            </div>
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required minlength="6" placeholder="Enter your password">
                <i class="fas fa-eye toggle-password" id="toggleLoginPassword"></i>
                <div class="error-message" id="passwordError">Password must be at least 6 characters long.</div>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        <div class="switch-link">
            Don't have an account? <a href="#" onclick="switchForm('signup')">Sign Up</a>
        </div>
    </div>
    <div class="auth-container" id="signup-form" style="display: none;">
        <h2 class="auth-title">Sign Up for EV Charging</h2>
        <form id="signupForm" action="<?php echo base_url('signup'); ?>" method="POST">
            <div class="form-group">
                <label class="form-label" for="name">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your full name">
                <i class="fas fa-user"></i>
                <div class="error-message" id="nameError">Please enter your full name.</div>
            </div>
            <div class="form-group">
                <label class="form-label" for="signupEmail">Email</label>
                <input type="email" class="form-control" id="signupEmail" name="email" required placeholder="Enter your email">
                <i class="fas fa-envelope"></i>
                <div class="error-message" id="signupEmailError">Please enter a valid email address.</div>
            </div>
            <div class="form-group">
                <label class="form-label" for="signupPassword">Password</label>
                <input type="password" class="form-control" id="signupPassword" name="password" required minlength="6" placeholder="Enter your password">
                <i class="fas fa-eye toggle-password" id="toggleSignupPassword"></i>
                <div class="error-message" id="signupPasswordError">Password must be at least 6 characters long.</div>
            </div>
            <div class="form-group">
                <label class="form-label" for="confirmPassword">Confirm Password</label>
                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required minlength="6" placeholder="Confirm your password">
                <i class="fas fa-eye toggle-password" id="toggleConfirmPassword"></i>
                <div class="error-message" id="confirmPasswordError">Passwords do not match.</div>
            </div>
            <button type="submit" class="btn btn-primary">Sign Up</button>
        </form>
        <div class="switch-link">
            Already have an account? <a href="#" onclick="switchForm('login')">Login</a>
        </div>
    </div>
    <script>
        function switchForm(formType) {
            const loginForm = document.getElementById('login-form');
            const signupForm = document.getElementById('signup-form');
            if (formType === 'signup') {
                loginForm.style.display = 'none';
                signupForm.style.display = 'block';
            } else {
                signupForm.style.display = 'none';
                loginForm.style.display = 'block';
            }
        }

        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(toggle => {
            toggle.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });
        });

        // Login Form Validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            let valid = true;
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            emailError.style.display = 'none';
            passwordError.style.display = 'none';
            if (!email.value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/)) {
                emailError.style.display = 'block';
                valid = false;
            }
            if (password.value.length < 6) {
                passwordError.style.display = 'block';
                valid = false;
            }
            if (!valid) {
                e.preventDefault();
            }
        });

        // Signup Form Validation
        document.getElementById('signupForm').addEventListener('submit', function(e) {
            let valid = true;
            const name = document.getElementById('name');
            const signupEmail = document.getElementById('signupEmail');
            const signupPassword = document.getElementById('signupPassword');
            const confirmPassword = document.getElementById('confirmPassword');
            const nameError = document.getElementById('nameError');
            const signupEmailError = document.getElementById('signupEmailError');
            const signupPasswordError = document.getElementById('signupPasswordError');
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            nameError.style.display = 'none';
            signupEmailError.style.display = 'none';
            signupPasswordError.style.display = 'none';
            confirmPasswordError.style.display = 'none';
            if (name.value.trim() === '') {
                nameError.style.display = 'block';
                valid = false;
            }
            if (!signupEmail.value.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/)) {
                signupEmailError.style.display = 'block';
                valid = false;
            }
            if (signupPassword.value.length < 6) {
                signupPasswordError.style.display = 'block';
                valid = false;
            }
            if (signupPassword.value !== confirmPassword.value) {
                confirmPasswordError.style.display = 'block';
                valid = false;
            }
            if (!valid) e.preventDefault();
        });
    </script>
</body>
</html>
