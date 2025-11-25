<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Email Verification - Kape Na!</title>
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
            --admin-color: #e67e22;
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

        .admin-badge {
            background: var(--admin-color);
            color: var(--white);
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .verify-main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .verify-container {
            background-color: var(--black);
            width: 100%;
            max-width: 50rem;
            padding: 4rem;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.3);
            position: relative;
            border: 2px solid var(--admin-color);
        }

        .admin-indicator {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--admin-color);
            color: var(--white);
            padding: 0.5rem 2rem;
            border-radius: 2rem;
            font-size: 1.4rem;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .verify-container h2 {
            text-align: center;
            color: var(--white);
            font-size: 3rem;
            margin-bottom: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .verify-info {
            text-align: center;
            color: var(--light-color);
            font-size: 1.6rem;
            margin-bottom: 3rem;
            line-height: 1.6;
        }

        .verify-info .email {
            color: var(--admin-color);
            font-weight: bold;
        }

        .verify-container form {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        .verify-container form .input-box {
            position: relative;
        }

        .verify-container form .input-box input {
            width: 100%;
            padding: 1.5rem 1rem;
            font-size: 2.5rem;
            color: var(--white);
            background: transparent;
            border-bottom: 2px solid var(--admin-color);
            transition: border-color 0.3s;
            text-align: center;
            letter-spacing: 1rem;
        }

        .verify-container form .input-box input:focus {
            border-color: var(--white);
        }

        .verify-container form .input-box label {
            display: block;
            text-align: center;
            font-size: 1.6rem;
            color: var(--light-color);
            margin-bottom: 1rem;
        }

        .verify-container form .btn {
            width: 100%;
            padding: 1.5rem;
            background-color: var(--admin-color);
            color: var(--white);
            font-size: 2rem;
            font-weight: bold;
            border: none;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 1rem;
        }

        .verify-container form .btn:hover {
            background-color: #d35400;
            letter-spacing: .2rem;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .resend-section {
            text-align: center;
            margin-top: 2rem;
            font-size: 1.6rem;
            color: var(--light-color);
        }

        .resend-section form {
            display: inline;
        }

        .resend-section button {
            color: var(--admin-color);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1.6rem;
            text-decoration: underline;
            padding: 0;
            font-family: 'Anton', sans-serif;
        }

        .resend-section button:hover {
            color: var(--white);
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

        .email-icon {
            text-align: center;
            margin-bottom: 2rem;
        }

        .email-icon i {
            font-size: 6rem;
            color: var(--admin-color);
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .verify-container {
                padding: 3rem;
            }
            
            .verify-container h2 {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 450px) {
            .verify-container {
                padding: 2rem;
            }
            
            .verify-container h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header section -->
    <header class="header">
        <div class="flex">
            <a href="/" class="logo">Kape Na! <i class="fas fa-coffee"></i></a>
            <div class="admin-badge">
                <i class="fas fa-user-shield"></i>
                ADMIN
            </div>
        </div>
    </header>

    <main class="verify-main">
        <div class="verify-container">
            <div class="admin-indicator">ADMIN VERIFICATION</div>
            
            <div class="email-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            
            <h2>Verify Admin Email</h2>
            
            <div class="verify-info">
                <p>We've sent a 6-digit OTP code to</p>
                <p class="email">{{ Auth::guard('admin')->user()->admin_email }}</p>
                <p>Please enter the code below to verify your admin account.</p>
            </div>
            
            <!-- Display Error Messages -->
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="error-message">{{ $error }}</div>
                @endforeach
            @endif

            @if (session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif
            
            <!-- OTP Verification Form -->
            <form action="{{ route('admin.verification.verify') }}" method="post">
                @csrf
                <div class="input-box">
                    <label for="otp_code">Enter 6-Digit Code</label>
                    <input 
                        type="text" 
                        name="otp_code" 
                        id="otp_code" 
                        maxlength="6" 
                        pattern="[0-9]{6}"
                        placeholder="000000"
                        required
                        autofocus
                    >
                </div>
                <button type="submit" class="btn">Verify Admin Email</button>
            </form>

            <!-- Resend OTP Section -->
            <div class="resend-section">
                <p>Didn't receive the code? 
                    <form action="{{ route('admin.verification.send') }}" method="post" style="display: inline;">
                        @csrf
                        <button type="submit">Resend OTP</button>
                    </form>
                </p>
            </div>
        </div>
    </main>

    <script>
        // Auto-format OTP input (numbers only)
        document.addEventListener('DOMContentLoaded', function() {
            const otpInput = document.getElementById('otp_code');
            
            otpInput.addEventListener('input', function(e) {
                // Remove non-numeric characters
                this.value = this.value.replace(/[^0-9]/g, '');
                
                // Limit to 6 digits
                if (this.value.length > 6) {
                    this.value = this.value.slice(0, 6);
                }
            });

            // Auto-submit when 6 digits are entered (optional)
            otpInput.addEventListener('input', function() {
                if (this.value.length === 6) {
                    // Optional: Auto-submit the form
                    // this.form.submit();
                }
            });
        });
    </script>
</body>
</html>

