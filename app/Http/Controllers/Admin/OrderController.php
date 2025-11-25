<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

/**
 * Order Controller
 * 
 * Manages order operations for admin panel including:
 * - Viewing all orders
 * - Updating order status
 * - Deleting orders
 */
class OrderController extends Controller
{
    /**
     * Display a listing of all orders
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            // Fetch all orders with related user information
            $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
            
            return view('Admin.admin_orders', compact('orders'));
        } catch (\Exception $e) {
            Log::error('Error fetching orders: ' . $e->getMessage());
            
            return view('Admin.admin_orders', [
                'orders' => [],
                'error' => 'Unable to fetch orders. Please try again later.'
            ]);
        }
    }

    /**
     * Update the specified order status
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            // Validate the request
            $validated = $request->validate([
                'status' => 'required|in:pending,paid,completed'
            ]);

            // Find the order
            $order = Order::findOrFail($id);
            
            // Update the status
            $order->status = $validated['status'];
            $order->save();

            return redirect()->route('admin.orders')
                ->with('success', 'Order status updated successfully!');
                
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.orders')
                ->with('error', 'Order not found.');
                
        } catch (\Exception $e) {
            Log::error('Error updating order: ' . $e->getMessage());
            
            return redirect()->route('admin.orders')
                ->with('error', 'Failed to update order. Please try again.');
        }
    }

    /**
     * Remove the specified order from storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            // Find and delete the order
            $order = Order::findOrFail($id);
            $order->delete();

            return redirect()->route('admin.orders')
                ->with('success', 'Order deleted successfully!');
                
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.orders')
                ->with('error', 'Order not found.');
                
        } catch (\Exception $e) {
            Log::error('Error deleting order: ' . $e->getMessage());
            
            return redirect()->route('admin.orders')
                ->with('error', 'Failed to delete order. Please try again.');
        }
    }
}

