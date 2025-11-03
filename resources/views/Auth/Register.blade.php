<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Kape Na!</title>
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
            max-width: 50rem;
            padding: 4rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.3);
        }

        .register-container h2 {
            text-align: center;
            color: var(--white);
            font-size: 3.5rem;
            margin-bottom: 3rem;
        }

        .input-box {
            position: relative;
            margin-bottom: 2rem;
        }

        .input-box input {
            width: 100%;
            padding: 1.5rem 1rem;
            font-size: 1.8rem;
            color: var(--white);
            background: transparent;
            border-bottom: 2px solid var(--main-color);
            transition: border-color 0.3s;
        }

        .input-box label {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            font-size: 1.8rem;
            color: var(--light-color);
            pointer-events: none;
            transition: all 0.3s;
        }

        .input-box input:focus ~ label,
        .input-box input:valid ~ label {
            top: -5px;
            left: 0;
            font-size: 1.5rem;
            color: var(--main-color);
        }

        .btn {
            width: 100%;
            padding: 1.5rem;
            background-color: var(--main-color);
            color: var(--black);
            font-size: 2rem;
            font-weight: bold;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        .btn:hover {
            background-color: var(--white);
            letter-spacing: .2rem;
        }

        .login-link {
            text-align: center;
            margin-top: 3rem;
            font-size: 1.6rem;
            color: var(--light-color);
        }

        .login-link a {
            color: var(--main-color);
            text-decoration: none;
            font-weight: bold;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

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

        .success-message {
            color: #2ecc71;
            font-size: 1.6rem;
            text-align: center;
            padding: 1rem;
            background: rgba(46, 204, 113, 0.1);
            border-radius: 0.5rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
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
            <h2>REGISTER</h2>

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error-message">{{ $error }}</div>
                @endforeach
            @endif

            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            <div style="background: rgba(211, 173, 127, 0.1); border-left: 4px solid var(--main-color); padding: 1.5rem; margin-bottom: 2rem; border-radius: 0.5rem;">
                <p style="margin: 0; font-size: 1.5rem; color: var(--light-color);">
                    <i class="fas fa-info-circle" style="color: var(--main-color);"></i>
                    After registration, you'll receive a verification email. Please check your inbox to verify your account.
                </p>
            </div>

            <!-- ✅ Your Corrected Registration Form -->
            <form id="registerForm" action="{{ route('register') }}" method="post">
                @csrf
                <div class="input-box">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                    <label for="name">Full Name</label>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-box">
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required>
                    <label for="phone">Phone Number</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>
                <div class="input-box">
                    <input type="password" name="password_confirmation" id="password_confirmation" required>
                    <label for="password_confirmation">Confirm Password</label>
                </div>
                <div class="input-box">
                    <input type="text" name="address" id="address" value="{{ old('address') }}" required>
                    <label for="address">Full Address</label>
                </div>
                <button type="submit" class="btn">Register</button>
                <div class="login-link">
                    <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
                </div>
            </form>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('input');
            
            inputs.forEach(input => {
                if (input.value) {
                    input.parentElement.classList.add('focused');
                }
                input.addEventListener('focus', () => input.parentElement.classList.add('focused'));
                input.addEventListener('blur', () => {
                    if (!input.value) input.parentElement.classList.remove('focused');
                });
            });

            const registerForm = document.getElementById('registerForm');
            registerForm.addEventListener('submit', function(e) {
                const password = document.getElementById('password').value;
                const confirmPassword = document.getElementById('password_confirmation').value;
                const phone = document.getElementById('phone').value;

                if (password !== confirmPassword) {
                    e.preventDefault();
                    alert('Passwords do not match');
                }

                if (!/^\d{10,15}$/.test(phone)) {
                    e.preventDefault();
                    alert('Please enter a valid phone number (10–15 digits)');
                }
            });
        });
    </script>
</body>
</html>