<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration - Kape Na!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
        
        :root {
            --yellow: black;
            --red: #e74c3c;
            --white: #fff;
            --black: #222;
            --light-color: #777;
            --border: .2rem solid var(--black);
            --main-color: #d3ad7f;
            --admin-color: #3498db;
            --bg: #856731bd;
            --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            font-family: 'Anton', sans-serif;
        }

        body {
            background: var(--bg);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header styles */
        .header {
            position: sticky;
            top: 0;
            left: 0;
            right: 0;
            background-color: var(--black);
            z-index: 1000;
            padding: 1.5rem 2rem;
            box-shadow: var(--box-shadow);
        }

        .header .flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header .logo {
            font-size: 2.5rem;
            color: var(--white);
            display: flex;
            align-items: center;
        }

        .header .logo i {
            color: var(--main-color);
            margin-right: .5rem;
        }

        .header .navbar {
            display: flex;
        }

        .header .navbar a {
            margin: 0 1rem;
            font-size: 2rem;
            color: var(--white);
        }

        .header .navbar a:hover {
            color: var(--main-color);
        }

        .register-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .register-container {
            background-color: var(--black);
            width: 100%;
            max-width: 60rem;
            padding: 4rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.3);
            position: relative;
            border-top: 4px solid var(--admin-color);
        }

        .admin-badge {
            position: absolute;
            top: -15px;
            right: 20px;
            background-color: var(--admin-color);
            color: var(--white);
            padding: 0.5rem 1.5rem;
            border-radius: 2rem;
            font-size: 1.4rem;
            font-weight: bold;
            letter-spacing: 0.1rem;
        }

        .register-container h2 {
            text-align: center;
            color: var(--white);
            font-size: 3.5rem;
            margin-bottom: 3rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .register-container h2 i {
            color: var(--admin-color);
            margin-right: 1rem;
        }

        .register-container form {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
        }

        .register-container form .input-box {
            position: relative;
        }

        .register-container form .input-box input {
            width: 100%;
            padding: 1.5rem 1rem;
            font-size: 1.8rem;
            color: var(--white);
            background: transparent;
            border-bottom: 2px solid var(--admin-color);
            transition: border-color 0.3s;
        }

        .register-container form .input-box input:focus {
            border-color: var(--white);
        }

        .register-container form .input-box label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            font-size: 1.8rem;
            color: var(--light-color);
            pointer-events: none;
            transition: all 0.3s;
        }

        .register-container form .input-box input:focus ~ label,
        .register-container form .input-box input:valid ~ label {
            top: -5px;
            left: 0;
            font-size: 1.5rem;
            color: var(--admin-color);
        }

        .password-requirements {
            background: rgba(52, 152, 219, 0.1);
            border-left: 4px solid var(--admin-color);
            padding: 1rem 1.5rem;
            margin: 1rem 0;
            border-radius: 0.5rem;
            font-size: 1.4rem;
            color: var(--light-color);
        }

        .password-requirements ul {
            margin-left: 2rem;
            margin-top: 0.5rem;
        }

        .password-requirements li {
            margin: 0.3rem 0;
        }

        .register-container form .btn {
            width: 100%;
            padding: 1.5rem;
            background-color: var(--admin-color);
            color: var(--white);
            font-size: 2rem;
            font-weight: bold;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .register-container form .btn:hover {
            background-color: #2980b9;
            letter-spacing: .2rem;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
        }

        .register-container .login-link {
            text-align: center;
            margin-top: 3rem;
            font-size: 1.6rem;
            color: var(--light-color);
        }

        .register-container .login-link a {
            color: var(--admin-color);
            text-decoration: none;
            font-weight: bold;
        }

        .register-container .login-link a:hover {
            text-decoration: underline;
        }

        .register-container .back-home {
            text-align: center;
            margin-top: 2rem;
        }

        .register-container .back-home a {
            color: var(--white);
            font-size: 1.6rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: color 0.3s;
        }

        .register-container .back-home a:hover {
            color: var(--main-color);
        }

        .register-container .back-home a i {
            margin-right: 0.5rem;
        }

        /* Error message styling */
        .error-message {
            color: var(--red);
            font-size: 1.4rem;
            margin-top: 0.5rem;
            text-align: left;
        }

        .error-list {
            color: var(--red);
            font-size: 1.6rem;
            text-align: center;
            padding: 1rem;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid var(--red);
        }

        .error-list ul {
            list-style: none;
            margin-top: 0.5rem;
        }

        /* Success message styling */
        .success-message {
            color: #2ecc71;
            font-size: 1.6rem;
            margin-top: 0.5rem;
            text-align: center;
            padding: 1rem;
            background: rgba(46, 204, 113, 0.1);
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border: 1px solid #2ecc71;
        }

        .info-box {
            background: rgba(52, 152, 219, 0.1);
            border-left: 4px solid var(--admin-color);
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-radius: 0.5rem;
            font-size: 1.4rem;
            color: var(--light-color);
            line-height: 1.6;
        }

        .info-box i {
            color: var(--admin-color);
            margin-right: 0.5rem;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .register-container {
                padding: 3rem;
            }
            
            .register-container h2 {
                font-size: 3rem;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .header .navbar {
                display: none;
            }
        }

        @media (max-width: 450px) {
            .register-container {
                padding: 2rem;
            }
            
            .register-container h2 {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header section -->
    <header class="header">
        <div class="flex">
            <a href="/" class="logo">Kape Na! <i class="fas fa-coffee"></i></a>
            <nav class="navbar">
                <a href="/">Home</a>
            </nav>
        </div>
    </header>

    <main class="register-main">
        <div class="register-container">
            <span class="admin-badge"><i class="fas fa-shield-alt"></i> ADMIN</span>
            
            <h2><i class="fas fa-user-plus"></i> ADMIN REGISTRATION</h2>
            
            <div class="info-box">
                <i class="fas fa-info-circle"></i>
                Create an admin account for the Kape Na! system. After registration, you will receive a verification code via email to verify your account.
            </div>
            
            <!-- Display Error Messages -->
            @if ($errors->any())
                <div class="error-list">
                    <i class="fas fa-exclamation-circle"></i> <strong>Please fix the following errors:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="success-message"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif
            
            <!-- Admin Registration Form -->
            <form id="registerForm" action="{{ route('admin.register') }}" method="post">
                @csrf
                
                <div class="input-box">
                    <input type="text" name="admin_name" id="admin_name" value="{{ old('admin_name') }}" required>
                    <label for="admin_name">Admin Name</label>
                </div>

                <div class="input-box">
                    <input type="email" name="admin_email" id="admin_email" value="{{ old('admin_email') }}" required>
                    <label for="admin_email">Admin Email</label>
                </div>

                <div class="form-row">
                    <div class="input-box">
                        <input type="password" name="password" id="password" required>
                        <label for="password">Password</label>
                    </div>
                    
                    <div class="input-box">
                        <input type="password" name="password_confirmation" id="password_confirmation" required>
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                </div>

                <div class="password-requirements">
                    <i class="fas fa-lock"></i> <strong>Password Requirements:</strong>
                    <ul>
                        <li>At least 8 characters long</li>
                        <li>Must match confirmation password</li>
                        <li>Use a strong, unique password</li>
                    </ul>
                </div>

                <button type="submit" class="btn">
                    <i class="fas fa-user-shield"></i> Register Admin Account
                </button>

                <div class="login-link">
                    <p>Already have an admin account? <a href="{{ route('admin.login') }}">Login here</a></p>
                </div>
            </form>
            
            <div class="back-home">
                <a href="/"><i class="fas fa-arrow-left"></i> Back to Home</a>
            </div>
        </div>
    </main>

    <script>
        // Add functionality to form inputs
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            
            inputs.forEach(input => {
                // Check if input has value on page load (for old form data)
                if (input.value) {
                    input.parentElement.classList.add('focused');
                }
                
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if(!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });

            // Form validation
            const registerForm = document.getElementById('registerForm');
            
            registerForm.addEventListener('submit', function(e) {
                const adminName = document.getElementById('admin_name').value;
                const adminEmail = document.getElementById('admin_email').value;
                const password = document.getElementById('password').value;
                const passwordConfirmation = document.getElementById('password_confirmation').value;
                
                // Simple validation
                if (!adminName || !adminEmail || !password || !passwordConfirmation) {
                    e.preventDefault();
                    alert('Please fill in all fields');
                    return;
                }

                // Password length check
                if (password.length < 8) {
                    e.preventDefault();
                    alert('Password must be at least 8 characters long');
                    return;
                }

                // Password match check
                if (password !== passwordConfirmation) {
                    e.preventDefault();
                    alert('Passwords do not match');
                    return;
                }

                // Email validation
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(adminEmail)) {
                    e.preventDefault();
                    alert('Please enter a valid email address');
                    return;
                }
            });

            // Real-time password match validation
            const password = document.getElementById('password');
            const passwordConfirmation = document.getElementById('password_confirmation');

            passwordConfirmation.addEventListener('input', function() {
                if (password.value && this.value) {
                    if (password.value === this.value) {
                        this.style.borderColor = '#2ecc71';
                    } else {
                        this.style.borderColor = '#e74c3c';
                    }
                }
            });
        });
    </script>
</body>
</html>

