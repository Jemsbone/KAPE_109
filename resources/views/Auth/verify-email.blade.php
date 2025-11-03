<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Kape Na!</title>
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
            text-align: center;
        }

        .verify-icon {
            font-size: 6rem;
            color: var(--main-color);
            margin-bottom: 2rem;
        }

        .verify-container h2 {
            color: var(--white);
            font-size: 3rem;
            margin-bottom: 2rem;
        }

        .verify-container p {
            color: var(--light-color);
            font-size: 1.8rem;
            line-height: 1.8;
            margin-bottom: 2rem;
            font-weight: 300;
            letter-spacing: 0.05rem;
        }

        .user-email {
            color: var(--main-color);
            font-weight: bold;
            word-break: break-all;
        }

        .btn {
            display: inline-block;
            padding: 1.5rem 3rem;
            background-color: var(--main-color);
            color: var(--black);
            font-size: 1.8rem;
            font-weight: bold;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            margin: 1rem 0.5rem;
            border: none;
        }

        .btn:hover {
            background-color: var(--white);
            letter-spacing: .2rem;
        }

        .btn-secondary {
            background-color: transparent;
            border: 2px solid var(--main-color);
            color: var(--main-color);
        }

        .btn-secondary:hover {
            background-color: var(--main-color);
            color: var(--black);
        }

        .success-message {
            color: #2ecc71;
            font-size: 1.6rem;
            text-align: center;
            padding: 1rem;
            background: rgba(46, 204, 113, 0.1);
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            border: 1px solid #2ecc71;
        }

        .warning-message {
            color: #f39c12;
            font-size: 1.6rem;
            text-align: center;
            padding: 1rem;
            background: rgba(243, 156, 18, 0.1);
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            border: 1px solid #f39c12;
        }

        .info-box {
            background: rgba(211, 173, 127, 0.1);
            border-left: 4px solid var(--main-color);
            padding: 1.5rem;
            margin: 2rem 0;
            border-radius: 0.5rem;
        }

        .info-box p {
            margin: 0;
            font-size: 1.6rem;
        }

        .divider {
            height: 1px;
            background: var(--light-color);
            margin: 2rem 0;
            opacity: 0.3;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="flex">
            <a href="/" class="logo">Kape Na! <i class="fas fa-coffee"></i></a>
            <nav class="navbar">
                <a href="/">Home</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; color: var(--white); font-size: 2rem; cursor: pointer; margin: 0 1rem; font-family: 'Anton', sans-serif;">
                        Logout
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <main class="verify-main">
        <div class="verify-container">
            <div class="verify-icon">
                <i class="fas fa-envelope-circle-check"></i>
            </div>

            <h2>VERIFY YOUR EMAIL</h2>

            @if (session('success'))
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('warning'))
                <div class="warning-message">
                    <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
                </div>
            @endif

            @if (session('info'))
                <div class="success-message">
                    <i class="fas fa-info-circle"></i> {{ session('info') }}
                </div>
            @endif

            <p>
                Thanks for signing up! We've sent a 6-digit verification code to your email address.
            </p>

            <div class="info-box">
                <p>
                    <i class="fas fa-envelope" style="color: var(--main-color);"></i>
                    Verification code sent to: <span class="user-email">{{ Auth::user()->email }}</span>
                </p>
            </div>

            <!-- OTP Input Form -->
            <form method="POST" action="{{ route('verification.verify') }}" id="otpForm">
                @csrf
                <div style="margin: 2rem 0;">
                    <label for="otp" style="color: var(--main-color); font-size: 1.8rem; margin-bottom: 1rem; display: block;">
                        Enter Verification Code
                    </label>
                    <input 
                        type="text" 
                        name="otp" 
                        id="otp" 
                        maxlength="6"
                        placeholder="000000"
                        style="width: 100%; max-width: 30rem; padding: 1.5rem; font-size: 2.5rem; text-align: center; letter-spacing: 1rem; border: 2px solid var(--main-color); border-radius: 0.5rem; background: var(--black); color: var(--white); margin: 0 auto; display: block;"
                        required
                        autocomplete="off"
                        inputmode="numeric"
                        pattern="[0-9]{6}"
                    >
                    @error('otp')
                        <p style="color: #e74c3c; font-size: 1.4rem; margin-top: 1rem;">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn">
                    <i class="fas fa-check-circle"></i> Verify Email
                </button>
            </form>

            <div class="divider"></div>

            <p>
                Didn't receive the code?
            </p>

            <form method="POST" action="{{ route('verification.send') }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-secondary">
                    <i class="fas fa-paper-plane"></i> Resend Code
                </button>
            </form>

            <p style="font-size: 1.4rem; margin-top: 2rem; color: var(--light-color);">
                <i class="fas fa-clock"></i> Code expires in 10 minutes
            </p>

            <p style="font-size: 1.6rem; margin-top: 2rem;">
                Need help? Check your spam folder or contact our support team.
            </p>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide success messages after 5 seconds
            const successMessage = document.querySelector('.success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transition = 'opacity 0.5s';
                    successMessage.style.opacity = '0';
                    setTimeout(() => successMessage.remove(), 500);
                }, 5000);
            }

            // Auto-focus on OTP input
            const otpInput = document.getElementById('otp');
            if (otpInput) {
                otpInput.focus();
                
                // Only allow numbers
                otpInput.addEventListener('input', function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    
                    // Auto-submit when 6 digits are entered
                    if (this.value.length === 6) {
                        // Add slight delay for better UX
                        setTimeout(() => {
                            document.getElementById('otpForm').submit();
                        }, 300);
                    }
                });

                // Paste support
                otpInput.addEventListener('paste', function(e) {
                    e.preventDefault();
                    const pasteData = e.clipboardData.getData('text').replace(/[^0-9]/g, '').substring(0, 6);
                    this.value = pasteData;
                    
                    if (pasteData.length === 6) {
                        setTimeout(() => {
                            document.getElementById('otpForm').submit();
                        }, 300);
                    }
                });
            }
        });
    </script>
</body>
</html>

