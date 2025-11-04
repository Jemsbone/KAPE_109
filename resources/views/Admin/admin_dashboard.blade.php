<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kape Na!</title>
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

        .top-header .welcome-text {
            font-size: 1.1rem;
            color: var(--light-color);
        }

        .main-content {
            flex: 1;
            padding: 1.5rem;
            background: var(--bg);
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--black);
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 2px;
        }

        .success-message {
            background: rgba(46, 204, 113, 0.1);
            border: 1px solid #2ecc71;
            color: #2ecc71;
            padding: 0.8rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            font-size: 1rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .stat-card {
            background: var(--white);
            padding: 1.2rem;
            border-radius: 0.6rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-card .stat-info h3 {
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--black);
            margin-bottom: 0.3rem;
        }

        .stat-card .stat-info p {
            font-size: 0.9rem;
            color: var(--light-color);
            font-weight: 400;
        }

        .stat-card .stat-icon {
            font-size: 2.2rem;
            color: var(--light-color);
            opacity: 0.3;
        }

        /* Divider */
        .divider {
            border-top: 2px dashed var(--light-color);
            margin: 1.5rem 0;
            opacity: 0.3;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 160px;
            }

            .main-wrapper {
                margin-left: 160px;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-wrapper {
                margin-left: 0;
            }

            .main-content {
                padding: 1rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .top-header {
                padding: 0.8rem;
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
            <a href="/admin/dashboard" class="nav-item active">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-coffee"></i> Product
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-receipt"></i> orders
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-user-shield"></i> admins
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-users"></i> employees
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-user-circle"></i> users
            </a>
            <a href="#" class="nav-item">
                <i class="fas fa-comments"></i> messages
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
            <p class="welcome-text">Welcome! admin</p>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            @if (session('success'))
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            <h1 class="page-title">DASHBOARD</h1>

            <!-- First Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>$80/-</h3>
                        <p>total pendings</p>
                    </div>
                    <i class="fas fa-wallet stat-icon"></i>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>$0/-</h3>
                        <p>total completes</p>
                    </div>
                    <i class="fas fa-wallet stat-icon"></i>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>$80/-</h3>
                        <p>total orders</p>
                    </div>
                    <i class="fas fa-wallet stat-icon"></i>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>16</h3>
                        <p>products added</p>
                    </div>
                    <i class="fas fa-th-large stat-icon"></i>
                </div>
            </div>

            <!-- Second Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>16</h3>
                        <p>users accounts</p>
                    </div>
                    <i class="fas fa-user-circle stat-icon"></i>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>3</h3>
                        <p>admin accounts</p>
                    </div>
                    <i class="fas fa-user-shield stat-icon"></i>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>3</h3>
                        <p>employees accounts</p>
                    </div>
                    <i class="fas fa-users stat-icon"></i>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>3</h3>
                        <p>new messages</p>
                    </div>
                    <i class="fas fa-comment-dots stat-icon"></i>
                </div>
            </div>

            <!-- Divider -->
            <div class="divider"></div>

            <!-- Bottom Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <h3>1,504</h3>
                        <p>Daily Views</p>
                    </div>
                    <i class="fas fa-eye stat-icon"></i>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>80</h3>
                        <p>Sales</p>
                    </div>
                    <i class="fas fa-shopping-cart stat-icon"></i>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>284</h3>
                        <p>Rating</p>
                    </div>
                    <i class="fas fa-comment-alt stat-icon"></i>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <h3>$7,842</h3>
                        <p>Earning</p>
                    </div>
                    <i class="fas fa-money-bill-wave stat-icon"></i>
                </div>
            </div>
        </main>
    </div>
</body>
</html>

