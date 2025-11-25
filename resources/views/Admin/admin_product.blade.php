<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Products - Kape Na!</title>
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
            --update-btn: #6366f1;
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

        /* Add Product Section */
        .add-product-section {
            background: var(--white);
            padding: 2rem;
            border-radius: 0.8rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .add-product-section h2 {
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            color: var(--black);
            text-align: center;
        }

        .product-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .product-form input,
        .product-form select {
            padding: 0.8rem;
            font-size: 1rem;
            border: 2px solid var(--main-color);
            border-radius: 0.5rem;
            background: var(--white);
        }

        .product-form input:focus,
        .product-form select:focus {
            border-color: var(--main-color);
            background: var(--white);
        }

        .file-input {
            padding: 0.5rem;
            cursor: pointer;
        }

        .submit-btn {
            background: var(--main-color);
            color: var(--white);
            padding: 0.8rem 2rem;
            font-size: 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
        }

        .submit-btn:hover {
            background: #b8956a;
        }

        /* Product Details Section */
        .product-details-section {
            background: var(--white);
            padding: 2rem;
            border-radius: 0.8rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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
            background: var(--main-color);
            color: var(--white);
        }

        thead th {
            padding: 1rem;
            text-align: left;
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
        }

        /* Out of Stock Styling */
        tbody tr.critical-stock {
            background: #ffebee;
        }

        tbody tr.low-stock {
            background: #fff3e0;
        }

        .stock-status {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            border-radius: 0.3rem;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .stock-status.critical {
            background: var(--delete-btn);
            color: var(--white);
        }

        .stock-status.low {
            background: #ff9800;
            color: var(--white);
        }

        .stock-status.in {
            background: #4caf50;
            color: var(--white);
        }

        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 0.5rem;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-update {
            padding: 0.6rem 1.2rem;
            background: var(--update-btn);
            color: var(--white);
            border-radius: 0.3rem;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-update:hover {
            background: #4f46e5;
        }

        .btn-delete {
            padding: 0.6rem 1.2rem;
            background: var(--delete-btn);
            color: var(--white);
            border-radius: 0.3rem;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-delete:hover {
            background: #c0392b;
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

            .action-buttons {
                flex-direction: column;
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
            <a href="{{ route('admin.products') }}" class="nav-item active">
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
            <a href="{{ route('admin.employees') }}" class="nav-item">
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

            <h1 class="page-title">Products</h1>

            <!-- Add Product Section -->
            <div class="add-product-section">
                <h2>Add Product</h2>
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
                    @csrf
                    <input type="text" name="name" placeholder="enter product name" required>
                    <input type="number" name="price" placeholder="enter product price" step="0.01" required>
                    <input type="number" name="stock" placeholder="enter product stock" min="0" required>
                    <select name="category" required>
                        <option value="">select category --</option>
                        <option value="coffee">Coffee</option>
                        <option value="main-dish">Main Dish</option>
                        <option value="drinks">Drinks</option>
                        <option value="desserts">Desserts</option>
                    </select>
                    <input type="file" name="image" accept="image/*" class="file-input" required>
                    <button type="submit" class="submit-btn">Add Product</button>
                </form>
            </div>

            <!-- Product Details Section -->
            <h2 class="section-title">Product Details</h2>

            <!-- Search Bar -->
            <div class="search-container">
                <form action="{{ route('admin.products') }}" method="GET" style="display: flex; gap: 0.8rem;">
                    <input type="text" name="search" class="search-input" placeholder="product name" value="{{ request('search') }}">
                    <button type="submit" class="search-btn">search</button>
                </form>
            </div>

            <div class="table-container">
                <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Photo</th>
                                <th>name</th>
                                <th>price</th>
                                <th>stock</th>
                                <th>category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr class="{{ $product->product_stock <= 10 ? 'critical-stock' : ($product->product_stock <= 20 ? 'low-stock' : '') }}">
                                <td>{{ $product->product_id }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" class="product-image">
                                </td>
                                <td>{{ $product->product_name }}</td>
                                <td>${{ number_format($product->product_price, 2) }}</td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                                        <span>{{ $product->product_stock }}</span>
                                        @if($product->product_stock <= 10)
                                            <span class="stock-status critical">CRITICAL STOCK</span>
                                        @elseif($product->product_stock <= 20)
                                            <span class="stock-status low">LOW STOCK</span>
                                        @else
                                            <span class="stock-status in">IN STOCK</span>
                                        @endif
                                    </div>
                                </td>
                                <td>{{ $product->product_category }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('admin.products.edit', $product->product_id) }}" class="btn-update">
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product->product_id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete" onclick="return confirm('Are you sure you want to delete this product?');">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" style="text-align: center; padding: 2rem; color: var(--light-color);">
                                    No products found. Add your first product above!
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>

            @if($products->hasPages())
            <div style="margin-top: 2rem; display: flex; justify-content: center;">
                {{ $products->links() }}
            </div>
            @endif
        </main>
    </div>
</body>
</html>

