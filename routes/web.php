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
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\CoffeeController;
use App\Http\Controllers\DessertsController;
use App\Http\Controllers\DrinksController;
use App\Http\Controllers\MainDishController;
use App\Http\Controllers\MessageController;

// ✅ Home route - Main homepage (for guests)
Route::get('/', [HomeController::class, 'index'])->name('home');

// ✅ Customer Home (protected route for logged-in users)
Route::get('/customer/home', function () {
    return view('Customer.customerhome');
})->name('customer.home')->middleware('auth');

// ✅ Customer Menu Route (Main menu page)
Route::get('/customer/cmenu', [CMenuController::class, 'index'])->name('customer.cmenu');

// ✅ Customer Cart Route
Route::get('/customer/cart', [CCartController::class, 'index'])->name('customer.cart');

// ✅ Direct Category Routes (with dynamic products from database)
Route::get('/category/coffee', [CoffeeController::class, 'index'])->name('category.coffee');
Route::get('/category/main-dish', [MainDishController::class, 'index'])->name('category.main-dish');
Route::get('/category/drinks', [DrinksController::class, 'index'])->name('category.drinks');
Route::get('/category/desserts', [DessertsController::class, 'index'])->name('category.desserts');

// ✅ Authentication Routes (User)
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Email Verification Routes (OTP)
Route::get('/verify-email', [AuthController::class, 'showVerificationForm'])->name('verification.notice');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->middleware('throttle:5,1')->name('verification.verify');
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->middleware('throttle:3,1')->name('verification.send');

// ✅ Google OAuth Routes
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/call-back', [AuthController::class, 'handleGoogleCallback'])->name('google.callback');

// ✅ Admin Authentication Routes
Route::get('/adminregister', [AdminAuthController::class, 'showRegistrationForm'])->name('admin.register');
Route::post('/adminregister', [AdminAuthController::class, 'register']);
Route::get('/adminlogin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/adminlogin', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


// ✅ Admin Email Verification Routes (OTP-based)
Route::middleware('auth:admin')->group(function () {
    // Admin verification page (shows OTP input form)
    Route::get('/admin/email/verify', [AdminAuthController::class, 'verificationNotice'])
        ->name('admin.verification.notice');
    
    // Admin verify OTP code
    Route::post('/admin/email/verify-otp', [AdminAuthController::class, 'verifyOtp'])
        ->middleware('throttle:5,1')
        ->name('admin.verification.verify');
    
    // Admin resend OTP code
    Route::post('/admin/email/verification-notification', [AdminAuthController::class, 'resendVerification'])
        ->middleware('throttle:3,1')
        ->name('admin.verification.send');
});

// ✅ Protected Routes (require authentication)
Route::middleware('auth')->group(function () {
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

    // ✅ Customer Profile and Settings
    Route::get('/customer/profile', [CustomerController::class, 'showProfile'])->name('customer.profile');
    Route::get('/customer/settings', [CustomerController::class, 'showSettings'])->name('customer.settings');
    Route::delete('/customer/delete-account', [CustomerController::class, 'deleteAccount'])->name('customer.delete-account');
    
    // ✅ Customer Messages (Feedback)
    Route::post('/message/send', [MessageController::class, 'store'])->name('message.store');
});

// ✅ Admin Dashboard (Protected - requires admin auth and email verification)
Route::middleware(['auth:admin', 'admin.verified'])->group(function () {
    Route::get('/admin/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('admin.dashboard');

    // Admin Product Routes
    Route::get('/admin/products', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.products');
    Route::post('/admin/products', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{id}/edit', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Admin Orders Routes
    Route::get('/admin/orders', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.orders');
    Route::put('/admin/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('/admin/orders/{id}', [\App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.orders.delete');

    // Admin Employees Routes
    Route::get('/admin/employees', [\App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('admin.employees');
    Route::get('/admin/employees/create', [\App\Http\Controllers\Admin\EmployeeController::class, 'create'])->name('admin.employees.create');
    Route::post('/admin/employees', [\App\Http\Controllers\Admin\EmployeeController::class, 'store'])->name('admin.employees.store');
    Route::delete('/admin/employees/{id}', [\App\Http\Controllers\Admin\EmployeeController::class, 'destroy'])->name('admin.employees.delete');

    // Admin Users Routes
    Route::get('/admin/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users');
    Route::delete('/admin/users/{id}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.delete');
    
    // Admin Messages Routes
    Route::get('/admin/messages', [MessageController::class, 'index'])->name('admin.message');
    Route::patch('/admin/messages/{id}/read', [MessageController::class, 'markAsRead'])->name('admin.message.read');
    Route::delete('/admin/messages/{id}', [MessageController::class, 'destroy'])->name('admin.message.delete');
    
    // Shortcut routes for consistency
    Route::get('/admin/product', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product');
    Route::get('/admin/order', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.order');
    Route::get('/admin/user', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user');
    Route::get('/admin/employee', [\App\Http\Controllers\Admin\EmployeeController::class, 'index'])->name('admin.employee');
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
