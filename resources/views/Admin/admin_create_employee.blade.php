<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Employee - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        
        :root {
            --white: #fff;
            --black: #2c2c2c;
            --light-color: #666;
            --main-color: #d3ad7f;
            --admin-color: #d3ad7f;
            --bg: #c9b382;
            --sidebar-bg: #2c2c2c;
            --box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
            --btn-color: #6366f1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: var(--bg);
            color: var(--black);
            min-height: 100vh;
            display: flex;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 180px;
            background: var(--black);
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            padding: 0;
            z-index: 1000;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar .logo {
            padding: 1rem 1rem;
            font-size: 1.4rem;
            color: var(--white);
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .logo i {
            color: var(--main-color);
            margin-left: 0.3rem;
            font-size: 1.2rem;
        }

        .sidebar .nav-menu {
            padding: 1rem 0;
        }

        .sidebar .nav-item {
            display: flex;
            align-items: center;
            padding: 0.8rem 1.2rem;
            color: var(--white);
            font-size: 1.1rem;
            transition: all 0.3s;
            cursor: pointer;
        }

        .sidebar .nav-item:hover,
        .sidebar .nav-item.active {
            background: var(--main-color);
            color: var(--black);
            border-left: 3px solid #8b6f47;
        }

        .sidebar .nav-item i {
            margin-right: 0.6rem;
            font-size: 1.2rem;
            width: 18px;
        }

        .sidebar .logout-item {
            position: absolute;
            bottom: 1rem;
            width: 100%;
        }

        /* Main Content Styles */
        .main-wrapper {
            margin-left: 180px;
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .top-header {
            background: var(--white);
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--box-shadow);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .top-header h2 {
            font-size: 1.6rem;
            color: var(--black);
        }

        .top-header h2 .admin-text {
            color: var(--admin-color);
        }

        .top-header .user-info {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .top-header .user-icon {
            font-size: 2rem;
            color: var(--admin-color);
        }

        .main-content {
            flex: 1;
            padding: 1.5rem;
            background: var(--bg);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Registration Form */
        .registration-container {
            background: var(--white);
            border-radius: 0.8rem;
            box-shadow: var(--box-shadow);
            padding: 3rem;
            width: 100%;
            max-width: 500px;
        }

        .form-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--black);
            margin-bottom: 2rem;
            text-align: center;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 0.5rem;
            font-size: 1rem;
            color: var(--black);
            background: #f5f5f5;
            transition: all 0.3s;
        }

        .form-input:focus {
            border-color: var(--main-color);
            background: var(--white);
        }

        .form-input::placeholder {
            color: var(--light-color);
        }

        .form-input select,
        .form-input option {
            color: var(--black);
        }

        textarea.form-input {
            resize: vertical;
            min-height: 80px;
            font-family: 'Poppins', sans-serif;
        }

        select.form-input {
            cursor: pointer;
        }

        .submit-btn {
            width: 100%;
            padding: 1rem;
            background: var(--btn-color);
            color: var(--white);
            border-radius: 0.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 1rem;
        }

        .submit-btn:hover {
            background: #4f46e5;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        /* Success and Error Messages */
        .success-message {
            background: #d4edda;
            color: #155724;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #28a745;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            border-left: 4px solid #dc3545;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .registration-container {
                padding: 2rem;
                margin: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            Cafe Shop <i class="fas fa-coffee"></i>
        </div>
        
        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <i class="fas fa-home"></i> home
            </a>
            <a href="{{ route('admin.products') }}" class="nav-item">
                <i class="fas fa-coffee"></i> products
            </a>
            <a href="{{ route('admin.orders') }}" class="nav-item">
                <i class="fas fa-receipt"></i> orders
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-user-shield"></i> admins
            </a>
            <a href="{{ route('admin.users') }}" class="nav-item">
                <i class="fas fa-users"></i> users
            </a>
            <a href="{{ route('admin.employees') }}" class="nav-item active">
                <i class="fas fa-user-tie"></i> employees
            </a>
            <a href="{{ route('admin.message') }}" class="nav-item">
                <i class="fas fa-envelope"></i> messages
            </a>
        </nav>

        <form action="{{ route('admin.logout') }}" method="POST" class="logout-item">
            @csrf
            <button type="submit" class="nav-item" style="width: 100%; background: none; cursor: pointer; color: var(--white);">
                <i class="fas fa-sign-out-alt"></i> Sign Out
            </button>
        </form>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Top Header -->
        <header class="top-header">
            <h2>Admin<span class="admin-text">Panel</span></h2>
            <div class="user-info">
                <i class="fas fa-user-circle user-icon"></i>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <div class="registration-container">
                <h2 class="form-title">Employee Management</h2>

                @if (session('success'))
                    <div class="success-message">
                        <i class="fas fa-check-circle"></i> {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="error-message">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.employees.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <input 
                            type="text" 
                            name="name" 
                            class="form-input" 
                            placeholder="enter your username"
                            value="{{ old('name') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <input 
                            type="number" 
                            name="age" 
                            class="form-input" 
                            placeholder="enter your age"
                            value="{{ old('age') }}"
                            required
                            min="18"
                            max="100"
                        >
                    </div>

                    <div class="form-group">
                        <select 
                            name="sex" 
                            class="form-input" 
                            required
                        >
                            <option value="">select your gender</option>
                            <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('sex') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <input 
                            type="email" 
                            name="email" 
                            class="form-input" 
                            placeholder="enter your email"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <input 
                            type="tel" 
                            name="phone" 
                            class="form-input" 
                            placeholder="enter your phone number"
                            value="{{ old('phone') }}"
                            required
                            pattern="[0-9]{10,15}"
                        >
                    </div>

                    <div class="form-group">
                        <textarea 
                            name="address" 
                            class="form-input" 
                            placeholder="enter your address"
                            required
                            rows="3"
                        >{{ old('address') }}</textarea>
                    </div>

                    <div class="form-group">
                        <input 
                            type="password" 
                            name="password" 
                            class="form-input" 
                            placeholder="enter your password"
                            required
                            minlength="6"
                        >
                    </div>

                    <div class="form-group">
                        <input 
                            type="password" 
                            name="password_confirmation" 
                            class="form-input" 
                            placeholder="confirm your password"
                            required
                            minlength="6"
                        >
                    </div>

                    <button type="submit" class="submit-btn">Register Now</button>
                </form>
            </div>
        </main>
    </div>

    <script>
        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.querySelector('input[name="password"]').value;
            const confirmPassword = document.querySelector('input[name="password_confirmation"]').value;

            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Passwords do not match!');
                return false;
            }

            const age = document.querySelector('input[name="age"]').value;
            if (age < 18 || age > 100) {
                e.preventDefault();
                alert('Please enter a valid age between 18 and 100');
                return false;
            }
        });
    </script>
</body>
</html>

