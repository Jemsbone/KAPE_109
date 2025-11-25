<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\coffee_shop_admin;
use App\Models\Employee;
use App\Models\Message;
use Illuminate\Support\Facades\DB;

/**
 * Dashboard Controller
 * 
 * Handles the admin dashboard and provides real-time statistics
 * from the database.
 */
class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with accurate statistics
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Calculate pending orders statistics
        $pendingOrders = Order::where('payment_status', 'pending')->get();
        $totalPending = $pendingOrders->count();
        $totalPendingAmount = $pendingOrders->sum('order_total_price');

        // Calculate completed orders statistics (paid)
        $completedOrders = Order::where('payment_status', 'paid')->get();
        $totalCompleted = $completedOrders->count();
        $totalCompletedAmount = $completedOrders->sum('order_total_price');

        // Calculate total orders statistics
        $allOrders = Order::all();
        $totalOrders = $allOrders->count();
        $totalOrdersAmount = $allOrders->sum('order_total_price');

        // Count products
        $totalProducts = Product::count();

        // Count users (customers)
        $totalUsers = User::count();

        // Count admins
        $totalAdmins = coffee_shop_admin::count();

        // Count employees
        $totalEmployees = Employee::count();

        // Count unread messages
        $newMessages = Message::where('is_read', false)->count();

        // Pass all statistics to the view
        return view('Admin.admin_dashboard', compact(
            'totalPending',
            'totalPendingAmount',
            'totalCompleted',
            'totalCompletedAmount',
            'totalOrders',
            'totalOrdersAmount',
            'totalProducts',
            'totalUsers',
            'totalAdmins',
            'totalEmployees',
            'newMessages'
        ));
    }
}

