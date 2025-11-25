<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management - Admin Panel</title>
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
            --add-btn: #00bcd4;
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
            display: flex;
            flex-direction: column;
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
            flex: 1;
            overflow-y: auto;
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
            padding: 1rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
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
        }

        .page-title {
            font-size: 2rem;
            font-weight: 600;
            color: var(--black);
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 2px;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--black);
            margin-bottom: 1rem;
        }

        /* Search Bar */
        .search-container {
            display: flex;
            justify-content: flex-end;
            gap: 0.8rem;
            margin-bottom: 1.5rem;
        }

        .search-input {
            padding: 0.6rem 1rem;
            border: 2px solid var(--main-color);
            border-radius: 0.5rem;
            font-size: 1rem;
            width: 250px;
        }

        .search-btn {
            padding: 0.6rem 1.5rem;
            background: var(--main-color);
            color: var(--white);
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .search-btn:hover {
            background: #b8956a;
        }

        .add-btn {
            padding: 0.6rem 1.5rem;
            background: var(--add-btn);
            color: var(--white);
            border-radius: 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .add-btn:hover {
            background: #0097a7;
        }

        /* Table Styles */
        .table-container {
            background: var(--white);
            border-radius: 0.5rem;
            overflow-x: auto;
            box-shadow: var(--box-shadow);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: var(--add-btn);
            color: var(--white);
        }

        thead th {
            padding: 1rem;
            text-align: center;
            font-weight: 600;
            font-size: 0.95rem;
        }

        tbody tr {
            border-bottom: 1px solid #e0e0e0;
        }

        tbody tr:hover {
            background: #f5f5f5;
        }

        tbody td {
            padding: 1rem;
            font-size: 0.9rem;
            color: var(--black);
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }

        tbody td:nth-child(7) {
            max-width: 200px;
            white-space: normal;
        }

        /* Delete Icon */
        .delete-icon {
            color: var(--black);
            font-size: 1.2rem;
            cursor: pointer;
            transition: color 0.3s;
        }

        .delete-icon:hover {
            color: var(--delete-btn);
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

            .search-container {
                flex-direction: column;
            }

            .search-input {
                width: 100%;
            }

            table {
                font-size: 0.8rem;
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
            @if (session('success'))
                <div class="success-message">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                </div>
            @endif

            <h1 class="page-title">Employee Management</h1>

            <!-- Search and Add Bar -->
            <div class="search-container">
                <input type="text" class="search-input" id="searchInput" placeholder="employee name">
                <button class="search-btn" onclick="searchEmployees()">search</button>
                <a href="{{ route('admin.employees.create') }}" class="add-btn">Add Employee</a>
            </div>

            <!-- Employee Details Section -->
            <h2 class="section-title">Employee Details</h2>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Sex</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="employeesTableBody">
                        @forelse($employees ?? [] as $employee)
                        <tr>
                            <td>{{ $employee->employee_id }}</td>
                            <td>{{ $employee->employee_name }}</td>
                            <td>{{ $employee->employee_age }}</td>
                            <td>{{ $employee->employee_sex ?? 'N/A' }}</td>
                            <td>{{ $employee->employee_email ?? 'N/A' }}</td>
                            <td>{{ $employee->employee_phone ?? 'N/A' }}</td>
                            <td>{{ $employee->employee_address ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('admin.employees.delete', $employee->employee_id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this employee?')" style="background: none; border: none; cursor: pointer;">
                                        <i class="fas fa-trash delete-icon"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 2rem; color: var(--light-color);">
                                No employees found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <script>
        // Search functionality
        function searchEmployees() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const tbody = document.getElementById('employeesTableBody');
            const rows = tbody.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const nameCell = rows[i].getElementsByTagName('td')[1];
                if (nameCell) {
                    const name = nameCell.textContent || nameCell.innerText;
                    if (name.toLowerCase().indexOf(input) > -1) {
                        rows[i].style.display = '';
                    } else {
                        rows[i].style.display = 'none';
                    }
                }
            }
        }

        // Real-time search
        document.getElementById('searchInput').addEventListener('keyup', searchEmployees);
    </script>
</body>
</html>
