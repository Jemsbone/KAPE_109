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
use App\Http\Controllers\CartJoinController;
use App\Http\Controllers\OItemJoinController;
use App\Http\Controllers\CMenuController;
use App\Http\Controllers\CCartController;
use App\Http\Controllers\CheckoutController; // ✅ Added this line

// ✅ Home route - Main homepage (for guests)
Route::get('/', [HomeController::class, 'index'])->name('home');

// ✅ Customer Home (protected route for logged-in users)
Route::get('/customer/home', function () {
    return view('Customer.customerhome');
})->name('customer.home')->middleware(['auth', 'verified']);

// ✅ Customer Menu Route (Main menu page)
Route::get('/customer/cmenu', [CMenuController::class, 'index'])->name('customer.cmenu');

// ✅ Customer Cart Route
Route::get('/customer/cart', [CCartController::class, 'index'])->name('customer.cart');

// ✅ Direct Category Routes
Route::get('/category/coffee', function () {
    return view('Customer.CCoffee');
})->name('category.coffee');

Route::get('/category/main-dish', function () {
    return view('Customer.CMainDish');
})->name('category.main-dish');

Route::get('/category/drinks', function () {
    return view('Customer.CDrinks');
})->name('category.drinks');

Route::get('/category/desserts', function () {
    return view('Customer.CDesserts');
})->name('category.desserts');

// ✅ Authentication Routes
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Email Verification Routes (OTP-based)
Route::middleware('auth')->group(function () {
    // Verification page (shows OTP input form)
    Route::get('/email/verify', [AuthController::class, 'verificationNotice'])
        ->name('verification.notice');
    
    // Verify OTP code
    Route::post('/email/verify-otp', [AuthController::class, 'verifyOtp'])
        ->middleware('throttle:5,1')
        ->name('verification.verify');
    
    // Resend OTP code
    Route::post('/email/verification-notification', [AuthController::class, 'resendVerification'])
        ->middleware('throttle:3,1')
        ->name('verification.send');
});

// ✅ Protected Routes (require authentication and email verification)
Route::middleware(['auth', 'verified'])->group(function () {
    // ✅ Menu Page
    Route::get('/menu', [CMenuController::class, 'index'])->name('menu');

    // ✅ Cart Page
    Route::get('/cart', [CCartController::class, 'index'])->name('cart');

    // ✅ Checkout Processing (NEW)
    Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    
    // ✅ Orders Page
    Route::get('/orders', function () {
        return view('orders');
    })->name('orders');

    // ✅ About Page
    Route::get('/about', function () {
        return view('about');
    })->name('about');

    // ✅ Cart actions (protected)
    Route::post('/cart/add', [CCartController::class, 'addToCart'])->name('cart.add');
    Route::post('/cart/remove', [CCartController::class, 'removeFromCart'])->name('cart.remove');
    Route::post('/cart/update', [CCartController::class, 'updateCart'])->name('cart.update');
});

// ✅ API routes (Backend Data)
Route::get('/users', [UserController::class, 'getAllusers']);
Route::get('/admins', [AdminController::class, 'getAlladmin']);
Route::get('/employees', [EmployeeController::class, 'getAllemployee']);
Route::get('/oitems', [OItemsController::class, 'getAlloitems']);
Route::get('/orders-data', [OrdersController::class, 'getAllorders']);
Route::get('/products', [ProductsController::class, 'getAllproducts']);
Route::get('/rating', [RatingController::class, 'getAllrating']);
Route::get('/cart_joined', [CartJoinController::class, 'index']);
Route::get('/oitem_joined', [OItemJoinController::class, 'index']);
