<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kape Na!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        /* Your existing CSS styles remain the same */
        @import url('https://fonts.googleapis.com/css2?family=Anton&display=swap');
        
        :root {
            --yellow: black;
            --red: #e74c3c;
            --white: #fff;
            --black: #222;
            --light-color: #777;
            --border: .2rem solid var(--black);
            --main-color: #d3ad7f;
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

        .login-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .login-container {
            background-color: var(--black);
            width: 100%;
            max-width: 50rem;
            padding: 4rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.3);
            position: relative;
        }

        .login-container h2 {
            text-align: center;
            color: var(--white);
            font-size: 3.5rem;
            margin-bottom: 3rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .login-container form .input-box {
            position: relative;
        }

        .login-container form .input-box input {
            width: 100%;
            padding: 1.5rem 1rem;
            font-size: 1.8rem;
            color: var(--white);
            background: transparent;
            border-bottom: 2px solid var(--main-color);
            transition: border-color 0.3s;
        }

        .login-container form .input-box input:focus {
            border-color: var(--white);
        }

        .login-container form .input-box label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            font-size: 1.8rem;
            color: var(--light-color);
            pointer-events: none;
            transition: all 0.3s;
        }

        .login-container form .input-box input:focus ~ label,
        .login-container form .input-box input:valid ~ label {
            top: -5px;
            left: 0;
            font-size: 1.5rem;
            color: var(--main-color);
        }

        .login-container form .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.6rem;
            margin: 1rem 0;
        }

        .login-container form .remember-forgot label {
            display: flex;
            align-items: center;
            color: var(--light-color);
            cursor: pointer;
        }

        .login-container form .remember-forgot input {
            margin-right: 0.5rem;
            width: 1.6rem;
            height: 1.6rem;
        }

        .login-container form .remember-forgot a {
            color: var(--main-color);
            text-decoration: none;
        }

        .login-container form .remember-forgot a:hover {
            text-decoration: underline;
        }

        .login-container form .btn {
            width: 100%;
            padding: 1.5rem;
            background-color: var(--main-color);
            color: var(--black);
            font-size: 2rem;
            font-weight: bold;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        .login-container form .btn:hover {
            background-color: var(--white);
            letter-spacing: .2rem;
        }

        .login-container .register-link {
            text-align: center;
            margin-top: 3rem;
            font-size: 1.6rem;
            color: var(--light-color);
        }

        .login-container .register-link a {
            color: var(--main-color);
            text-decoration: none;
            font-weight: bold;
        }

        .login-container .register-link a:hover {
            text-decoration: underline;
        }

        .login-container .back-home {
            text-align: center;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .login-container .back-home a {
            color: var(--white);
            font-size: 1.6rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: color 0.3s;
        }

        .login-container .back-home a:hover {
            color: var(--main-color);
        }

        .login-container .back-home a i {
            margin-right: 0.5rem;
        }

        /* Social login divider */
        .social-divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 2rem 0;
            color: var(--light-color);
            font-size: 1.6rem;
        }

        .social-divider::before,
        .social-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--light-color);
        }

        .social-divider span {
            padding: 0 1rem;
        }

        /* Google login button */
        .btn-google {
            width: 100%;
            padding: 1.5rem;
            background-color: #fff;
            color: #444;
            font-size: 1.8rem;
            font-weight: bold;
            border: 2px solid #ddd;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            text-decoration: none;
            margin-top: 1rem;
        }

        .btn-google:hover {
            background-color: #f8f8f8;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        .btn-google i {
            font-size: 2rem;
        }

        /* Modal Overlay */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 9999;
            justify-content: center;
            align-items: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-overlay.active {
            display: flex;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Modal Content */
        .modal-content {
            background-color: var(--black);
            border-radius: 1rem;
            padding: 3rem;
            max-width: 50rem;
            width: 90%;
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.5);
            animation: slideUp 0.3s ease;
            position: relative;
        }

        @keyframes slideUp {
            from {
                transform: translateY(50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 2rem;
        }

        .modal-header h3 {
            color: var(--white);
            font-size: 2.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .modal-header i {
            color: var(--main-color);
            font-size: 3rem;
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--light-color);
            font-size: 3rem;
            cursor: pointer;
            transition: color 0.3s;
            padding: 0;
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-close:hover {
            color: var(--red);
        }

        .modal-body {
            color: var(--light-color);
            font-size: 1.6rem;
            line-height: 1.8;
            margin-bottom: 2rem;
        }

        .modal-body p {
            margin-bottom: 1.5rem;
        }

        .modal-body ul {
            list-style: none;
            padding-left: 2rem;
            margin-bottom: 1.5rem;
        }

        .modal-body ul li {
            margin-bottom: 1rem;
            position: relative;
        }

        .modal-body ul li::before {
            content: '✓';
            color: var(--main-color);
            font-weight: bold;
            position: absolute;
            left: -2rem;
        }

        .modal-body .highlight {
            color: var(--main-color);
            font-weight: bold;
        }

        .modal-footer {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }

        .modal-btn {
            padding: 1.2rem 2.5rem;
            font-size: 1.6rem;
            font-weight: bold;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            font-family: 'Anton', sans-serif;
        }

        .modal-btn-cancel {
            background-color: transparent;
            color: var(--light-color);
            border: 2px solid var(--light-color);
        }

        .modal-btn-cancel:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-color: var(--white);
        }

        .modal-btn-confirm {
            background-color: var(--main-color);
            color: var(--black);
        }

        .modal-btn-confirm:hover {
            background-color: var(--white);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /* Error message styling */
        .error-message {
            color: var(--red);
            font-size: 1.6rem;
            margin-top: 0.5rem;
            text-align: center;
            padding: 1rem;
            background: rgba(231, 76, 60, 0.1);
            border-radius: 0.5rem;
            margin-bottom: 1rem;
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
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .login-container {
                padding: 3rem;
            }
            
            .login-container h2 {
                font-size: 3rem;
            }

            .header .navbar {
                display: none;
            }
        }

        @media (max-width: 450px) {
            .login-container {
                padding: 2rem;
            }
            
            .login-container h2 {
                font-size: 2.5rem;
            }
            
            .login-container form .remember-forgot {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
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

    <main class="login-main">
        <div class="login-container">
            <h2>LOGIN</h2>
            
            <!-- Display Error Messages -->
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error-message">{{ $error }}</div>
                @endforeach
            @endif

            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif
            
            <!-- Updated Login Form with Laravel route and CSRF -->
            <form id="loginForm" action="{{ route('login') }}" method="post">
                @csrf
                <div class="input-box">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="remember-forgot">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                    <a href="#">Forgot Password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>

            <!-- Social Login Divider -->
            <div class="social-divider">
                <span>OR</span>
            </div>

            <!-- Google Login Button -->
            <button type="button" class="btn-google" onclick="showGoogleModal()">
                <i class="fab fa-google"></i>
                <span>Continue with Google</span>
            </button>

            <div class="register-link">
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>

            <div class="back-home">
                <a href="/"><i class="fas fa-arrow-left"></i> Back to Home</a>
            </div>
        </div>
    </main>

    <!-- Google OAuth Confirmation Modal -->
    <div class="modal-overlay" id="googleModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>
                    <i class="fab fa-google"></i>
                    Continue with Google
                </h3>
                <button class="modal-close" onclick="closeGoogleModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>By continuing with Google, you agree to:</p>
                <ul>
                    <li>Create a new account or sign in to your existing account</li>
                    <li>Share your Google profile information (name and email)</li>
                    <li>Allow Kape Na! to access your basic profile</li>
                </ul>
                <p>
                    If you don't have an account with us, <span class="highlight">one will be created automatically</span> 
                    using your Google information.
                </p>
                <p>
                    Your email will be <span class="highlight">automatically verified</span> through Google, 
                    so you won't need to verify it separately.
                </p>
            </div>
            <div class="modal-footer">
                <button class="modal-btn modal-btn-cancel" onclick="closeGoogleModal()">
                    Cancel
                </button>
                <a href="{{ route('google.redirect') }}" class="modal-btn modal-btn-confirm" style="text-decoration: none; display: inline-block;">
                    Continue
                </a>
            </div>
        </div>
    </div>

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
            const loginForm = document.getElementById('loginForm');
            
            loginForm.addEventListener('submit', function(e) {
                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                
                // Simple validation
                if (!email || !password) {
                    e.preventDefault();
                    alert('Please fill in all fields');
                    return;
                }
            });
        });

        // Google OAuth Modal Functions
        function showGoogleModal() {
            const modal = document.getElementById('googleModal');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeGoogleModal() {
            const modal = document.getElementById('googleModal');
            modal.classList.remove('active');
            document.body.style.overflow = 'auto'; // Re-enable scrolling
        }

        // Close modal when clicking outside the modal content
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('googleModal');
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    closeGoogleModal();
                }
            });

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeGoogleModal();
                }
            });
        });
    </script>
</body>
</html>