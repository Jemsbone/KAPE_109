<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Messages - Admin Panel</title>
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
            --delete-btn: #e74c3c;
            --mark-read-btn: #27ae60;
            --unread-bg: #fff3cd;
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

        /* Main Content */
        .main-content {
            margin-left: 180px;
            flex: 1;
            padding: 2rem;
        }

        .header {
            background: var(--white);
            padding: 1.5rem 2rem;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            font-size: 2rem;
            color: var(--black);
        }

        .admin-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .admin-info i {
            font-size: 2.5rem;
            color: var(--main-color);
        }

        .admin-info span {
            font-size: 1.1rem;
            color: var(--light-color);
        }

        /* Stats Cards */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .stat-card i {
            font-size: 3rem;
            color: var(--main-color);
        }

        .stat-info h3 {
            font-size: 2rem;
            color: var(--black);
            margin-bottom: 0.3rem;
        }

        .stat-info p {
            color: var(--light-color);
            font-size: 1rem;
        }

        /* Messages Container */
        .messages-container {
            background: var(--white);
            padding: 2rem;
            border-radius: 8px;
            box-shadow: var(--box-shadow);
        }

        .messages-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--bg);
        }

        .messages-header h2 {
            font-size: 1.8rem;
            color: var(--black);
        }

        .filter-tabs {
            display: flex;
            gap: 1rem;
        }

        .filter-btn {
            padding: 0.5rem 1.5rem;
            background: var(--bg);
            color: var(--black);
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.95rem;
            transition: all 0.3s;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--main-color);
            color: var(--white);
        }

        /* Message Item */
        .message-item {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .message-item:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .message-item.unread {
            background: var(--unread-bg);
            border-left: 4px solid var(--main-color);
        }

        .message-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .message-user-info {
            flex: 1;
        }

        .message-user-info h3 {
            font-size: 1.3rem;
            color: var(--black);
            margin-bottom: 0.3rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .unread-badge {
            background: var(--delete-btn);
            color: var(--white);
            padding: 0.2rem 0.6rem;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .message-user-info p {
            color: var(--light-color);
            font-size: 0.95rem;
        }

        .message-date {
            color: var(--light-color);
            font-size: 0.9rem;
            text-align: right;
        }

        .message-content {
            background: #f9f9f9;
            padding: 1rem;
            border-radius: 6px;
            margin: 1rem 0;
            line-height: 1.6;
            color: var(--black);
            font-size: 1rem;
        }

        .message-actions {
            display: flex;
            gap: 0.8rem;
            justify-content: flex-end;
        }

        .action-btn {
            padding: 0.6rem 1.2rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .mark-read-btn {
            background: var(--mark-read-btn);
            color: var(--white);
        }

        .mark-read-btn:hover {
            background: #229954;
            transform: translateY(-2px);
        }

        .delete-btn {
            background: var(--delete-btn);
            color: var(--white);
        }

        .delete-btn:hover {
            background: #c0392b;
            transform: translateY(-2px);
        }

        .no-messages {
            text-align: center;
            padding: 3rem;
            color: var(--light-color);
        }

        .no-messages i {
            font-size: 4rem;
            color: var(--light-color);
            margin-bottom: 1rem;
        }

        .no-messages p {
            font-size: 1.2rem;
        }

        /* Success/Error Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-size: 1rem;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 60px;
            }

            .sidebar .logo span,
            .sidebar .nav-item span {
                display: none;
            }

            .main-content {
                margin-left: 60px;
            }

            .header {
                flex-direction: column;
                gap: 1rem;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .message-header {
                flex-direction: column;
                gap: 0.5rem;
            }

            .message-date {
                text-align: left;
            }

            .filter-tabs {
                flex-wrap: wrap;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <span>Kape Na!</span>
            <i class="fas fa-coffee"></i>
        </div>
        <nav class="nav-menu">
            <a href="{{ route('admin.dashboard') }}" class="nav-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.product') }}" class="nav-item">
                <i class="fas fa-box"></i>
                <span>Products</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="nav-item">
                <i class="fas fa-shopping-cart"></i>
                <span>Orders</span>
            </a>
            <a href="{{ route('admin.user') }}" class="nav-item">
                <i class="fas fa-users"></i>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.employee') }}" class="nav-item">
                <i class="fas fa-user-tie"></i>
                <span>Employees</span>
            </a>
            <a href="{{ route('admin.message') }}" class="nav-item active">
                <i class="fas fa-envelope"></i>
                <span>Messages</span>
            </a>
        </nav>
        <div class="logout-item">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-item" style="width: 100%; background: none; border: none; cursor: pointer;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Header -->
        <div class="header">
            <h1>Customer Messages & Feedback</h1>
            <div class="admin-info">
                <i class="fas fa-user-shield"></i>
                <span>{{ Auth::guard('admin')->user()->admin_name ?? 'Admin' }}</span>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="stats-container">
            <div class="stat-card">
                <i class="fas fa-envelope"></i>
                <div class="stat-info">
                    <h3>{{ $messages->count() }}</h3>
                    <p>Total Messages</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-envelope-open"></i>
                <div class="stat-info">
                    <h3>{{ $messages->where('is_read', false)->count() }}</h3>
                    <p>Unread Messages</p>
                </div>
            </div>
            <div class="stat-card">
                <i class="fas fa-check-circle"></i>
                <div class="stat-info">
                    <h3>{{ $messages->where('is_read', true)->count() }}</h3>
                    <p>Read Messages</p>
                </div>
            </div>
        </div>

        <!-- Messages Container -->
        <div class="messages-container">
            <div class="messages-header">
                <h2>All Messages</h2>
            </div>

            @if($messages->count() > 0)
                @foreach($messages as $message)
                    <div class="message-item {{ $message->is_read ? '' : 'unread' }}">
                        <div class="message-header">
                            <div class="message-user-info">
                                <h3>
                                    <i class="fas fa-user-circle"></i>
                                    {{ $message->name }}
                                    @if(!$message->is_read)
                                        <span class="unread-badge">NEW</span>
                                    @endif
                                </h3>
                                <p>
                                    <i class="fas fa-envelope"></i> {{ $message->email }}
                                    @if($message->user)
                                        <span style="margin-left: 1rem;">
                                            <i class="fas fa-user"></i> User ID: {{ $message->user_id }}
                                        </span>
                                    @endif
                                </p>
                            </div>
                            <div class="message-date">
                                <i class="far fa-clock"></i>
                                {{ $message->created_at->format('M d, Y') }}<br>
                                {{ $message->created_at->format('h:i A') }}
                            </div>
                        </div>

                        <div class="message-content">
                            {{ $message->message }}
                        </div>

                        <div class="message-actions">
                            @if(!$message->is_read)
                                <form action="{{ route('admin.message.read', $message->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="action-btn mark-read-btn">
                                        <i class="fas fa-check"></i> Mark as Read
                                    </button>
                                </form>
                            @endif
                            
                            <form action="{{ route('admin.message.delete', $message->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="no-messages">
                    <i class="fas fa-inbox"></i>
                    <p>No messages yet. Customer messages will appear here.</p>
                </div>
            @endif
        </div>
    </main>

    <script>
        // Auto-hide alert messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }, 5000);
            });
        });
    </script>
</body>
</html>

