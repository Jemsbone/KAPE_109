<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OItemsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartJoinController;
use App\Http\Controllers\OItemJoinController;

// ✅ Home route - Main homepage (for guests)
Route::get('/', [HomeController::class, 'index'])->name('home');

// ✅ Customer Home (protected route for logged-in users)
Route::get('/customer/home', function () {
    return view('Customer.customerhome');
})->name('customer.home')->middleware('auth');

// ✅ Direct Category Routes
Route::get('/category/coffee', function () {
    return view('Customer.CCoffee');
})->name('category.coffee');

Route::get('/category/main-dish', function () {
    return view('Customer.CMainDish'); // Gawa ka nito kung kailangan
})->name('category.main-dish');

Route::get('/category/drinks', function () {
    return view('Customer.CDrinks'); // Gawa ka nito kung kailangan
})->name('category.drinks');

Route::get('/category/desserts', function () {
    return view('Customer.CDesserts'); // Gawa ka nito kung kailangan
})->name('category.desserts');

// ✅ Authentication Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Protected Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Page routes (only accessible by logged-in users)
    Route::get('/menu', function () {
        return view('menu');
    })->name('menu');

    Route::get('/orders', function () {
        return view('orders');
    })->name('orders');

    Route::get('/about', function () {
        return view('about');
    })->name('about');
});

// ✅ API routes (Backend Data)
Route::get('/users', [UserController::class, 'getAllusers']);
Route::get('/admins', [AdminController::class, 'getAlladmin']);
Route::get('/employees', [EmployeeController::class, 'getAllemployee']);
Route::get('/oitems', [OItemsController::class, 'getAlloitems']);
Route::get('/orders-data', [OrdersController::class, 'getAllorders']); // renamed to avoid conflict with /orders page
Route::get('/products', [ProductsController::class, 'getAllproducts']);
Route::get('/rating', [RatingController::class, 'getAllrating']);
Route::get('/cart', [CartController::class, 'getAllcart']);
Route::get('/cart_joined', [CartJoinController::class, 'index']);
Route::get('/oitem_joined', [OItemJoinController::class, 'index']);