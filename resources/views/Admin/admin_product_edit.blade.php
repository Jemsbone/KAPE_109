<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Kape Na!</title>
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

        html {
            font-size: 62.5%;
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
            gap: 0.5rem;
        }

        .top-header .user-icon {
            font-size: 1.4rem;
            color: var(--light-color);
        }

        .main-content {
            flex: 1;
            padding: 1.5rem;
            background: var(--bg);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Edit Product Section */
        .edit-product-section {
            background: var(--white);
            padding: 2.5rem;
            border-radius: 0.8rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
        }

        .edit-product-section h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: var(--black);
            text-align: center;
        }

        .product-form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            font-size: 1.1rem;
            color: var(--black);
            font-weight: 500;
        }

        .product-form input,
        .product-form select {
            padding: 0.8rem;
            font-size: 1.1rem;
            border: 1px solid #ddd;
            border-radius: 0.5rem;
            background: #f9f9f9;
        }

        .product-form input:focus,
        .product-form select:focus {
            border-color: var(--admin-color);
            background: var(--white);
        }

        .current-image {
            margin-top: 0.5rem;
        }

        .current-image img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 0.5rem;
            border: 2px solid var(--admin-color);
        }

        .file-input {
            padding: 0.5rem;
            cursor: pointer;
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .submit-btn, .cancel-btn {
            flex: 1;
            padding: 0.8rem 2rem;
            font-size: 1.2rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: all 0.3s;
            border: none;
            text-align: center;
        }

        .submit-btn {
            background: #5856d6;
            color: var(--white);
        }

        .submit-btn:hover {
            background: #4745b8;
        }

        .cancel-btn {
            background: #e74c3c;
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cancel-btn:hover {
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

            .main-content {
                padding: 1rem;
            }

            .edit-product-section {
                padding: 1.5rem;
            }

            .button-group {
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
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.products') }}" class="nav-item active">
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
            <div class="user-info">
                <i class="fas fa-user-circle user-icon"></i>
                <span style="font-size: 1.1rem; color: var(--light-color);">Welcome! admin</span>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Edit Product Section -->
            <div class="edit-product-section">
                <h2>Edit Product</h2>
                <form action="{{ route('admin.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data" class="product-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->product_name) }}" required>
                        @error('name')
                            <span style="color: #e74c3c; font-size: 1rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="price">Product Price ($)</label>
                        <input type="number" name="price" id="price" value="{{ old('price', $product->product_price) }}" step="0.01" required>
                        @error('price')
                            <span style="color: #e74c3c; font-size: 1rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stock">Product Stock</label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->product_stock) }}" min="0" required>
                        @error('stock')
                            <span style="color: #e74c3c; font-size: 1rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category" id="category" required>
                            <option value="">select category --</option>
                            <option value="coffee" {{ old('category', $product->product_category) == 'coffee' ? 'selected' : '' }}>Coffee</option>
                            <option value="main-dish" {{ old('category', $product->product_category) == 'main-dish' ? 'selected' : '' }}>Main Dish</option>
                            <option value="drinks" {{ old('category', $product->product_category) == 'drinks' ? 'selected' : '' }}>Drinks</option>
                            <option value="desserts" {{ old('category', $product->product_category) == 'desserts' ? 'selected' : '' }}>Desserts</option>
                        </select>
                        @error('category')
                            <span style="color: #e74c3c; font-size: 1rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Product Image (leave empty to keep current)</label>
                        <div class="current-image">
                            <p style="font-size: 1rem; color: var(--light-color); margin-bottom: 0.5rem;">Current Image:</p>
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                        </div>
                        <input type="file" name="image" id="image" accept="image/*" class="file-input">
                        @error('image')
                            <span style="color: #e74c3c; font-size: 1rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="button-group">
                        <button type="submit" class="submit-btn">Update Product</button>
                        <a href="{{ route('admin.products') }}" class="cancel-btn">Cancel</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>

