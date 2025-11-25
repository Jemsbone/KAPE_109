<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderSummary;
use Illuminate\Support\Facades\Auth;
use App\Models\orders;
use App\Models\order_items;
use App\Models\products;

class CheckoutController extends Controller
{
    public function processCheckout(Request $request)
    {
        try {
            // ✅ Validate the incoming request data
            $request->validate([
                'cart_data' => 'required|array',
                'cart_data.*.id' => 'required',
                'cart_data.*.name' => 'required|string',
                'cart_data.*.price' => 'required|numeric',
                'cart_data.*.quantity' => 'required|integer|min:1',
                'order_summary' => 'required|array',
                'payment_method' => 'required|array',
                'payment_method.method' => 'required|string|in:cash,gcash,bank'
            ]);

            // ✅ Get validated cart data and order summary
            $cartData = $request->input('cart_data');
            $orderSummary = $request->input('order_summary');
            $paymentMethod = $request->input('payment_method');
            
            // ✅ Get the authenticated user
            $user = Auth::user();

            if (!$user) {
                throw new \Exception('User not authenticated');
            }

            // ✅ Validate stock availability before processing order
            $stockValidation = $this->validateStockAvailability($cartData);
            if (!$stockValidation['valid']) {
                return response()->json([
                    'success' => false,
                    'message' => $stockValidation['message'],
                    'out_of_stock_items' => $stockValidation['out_of_stock_items']
                ], 400);
            }

            // ✅ Use database transaction to ensure data integrity
            DB::beginTransaction();

            try {
                // ✅ Create order record in the database
                $order = $this->createOrder($cartData, $orderSummary, $user, $paymentMethod);
                
                // ✅ Create order items and decrease stock
                $this->createOrderItemsAndDecreaseStock($order, $cartData);
                
                DB::commit();
            } catch (\Exception $dbException) {
                DB::rollBack();
                throw $dbException;
            }
            
            // ✅ Try to send the order summary email (optional - won't fail checkout if email fails)
            $emailSent = false;
            $emailError = null;
            
            try {
                // Check if email is configured
                $mailDriver = Config::get('mail.default');
                $mailHost = Config::get('mail.mailers.smtp.host');
                
                if ($mailDriver && $mailDriver !== 'array' && $mailHost) {
                    Mail::to($user->email)->send(new OrderSummary($cartData, $orderSummary, $user, $order));
                    $emailSent = true;
                    Log::info('Order confirmation email sent successfully', [
                        'order_id' => $order->order_id,
                        'user_email' => $user->email
                    ]);
                } else {
                    Log::warning('Email not configured - skipping email send', [
                        'order_id' => $order->order_id
                    ]);
                    $emailError = 'Email not configured';
                }
            } catch (\Exception $emailException) {
                // Log email error but don't fail the checkout
                Log::error('Failed to send order confirmation email', [
                    'error' => $emailException->getMessage(),
                    'order_id' => $order->order_id,
                    'user_email' => $user->email
                ]);
                $emailError = $emailException->getMessage();
            }
            
            $message = 'Order processed successfully!';
            if ($emailSent) {
                $message .= ' Check your email for confirmation.';
            } else {
                $message .= ' (Note: Email notification not sent - please configure email settings)';
            }
            
            return response()->json([
                'success' => true,
                'message' => $message,
                'order_number' => $order->order_number,
                'email_sent' => $emailSent,
                'email_error' => $emailError
            ]);
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Checkout validation error', [
                'errors' => $e->errors()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Invalid order data. Please check your cart.',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Checkout error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to process order: ' . $e->getMessage(),
                'error' => $e->getMessage(),
                'error_type' => get_class($e)
            ], 500);
        }
    }

    // ✅ Create Order using your existing orders model
    private function createOrder($cartData, $orderSummary, $user, $paymentMethod)
    {
        // Generate order name from cart items
        $orderName = $this->generateOrderName($cartData);
        
        // Generate unique order number
        $orderNumber = $this->generateOrderNumber();

        // Extract payment method type
        $paymentMethodType = $paymentMethod['method'];
        
        // Determine payment status based on payment method
        // Cash orders need to be paid on pickup, so they are 'pending'
        // Gcash and Bank Transfer are paid online, so they are 'paid'
        $paymentStatus = ($paymentMethodType === 'cash') ? 'pending' : 'paid';

        // Create the order using your existing orders model
        $order = orders::create([
            'user_id' => $user->user_id, // Link order to the authenticated user
            'employee_id' => null, // Set to null or assign based on your logic
            'order_name' => $orderName,
            'order_number' => $orderNumber,
            'order_payment_method' => $paymentMethodType, // Use actual payment method from request
            'order_total_price' => $orderSummary['total'],
            'payment_status' => $paymentStatus, // Set status based on payment method
            'order_date' => now(),
        ]);

        return $order;
    }

    private function generateOrderName($cartData)
    {
        // Format: ItemName (Qty: X @ ₱Price) -
        $itemNames = array_map(function($item) {
            return $item['name'] . ' (Qty: ' . $item['quantity'] . ' @ ₱' . number_format($item['price'], 0) . ') -';
        }, $cartData);

        // Show all items with quantity clearly labeled
        $baseName = implode(' ', $itemNames);
        
        return rtrim($baseName, ' -'); // Remove trailing dash
    }

    private function generateOrderNumber()
    {
        // Generate a smaller order number that fits in regular integer column
        // Format: YYYYMMDDHHMMSS + 2 random digits
        // Example: 2025110216301599 (16 digits, fits in bigint)
        // But for regular int (max ~2.1 billion), we'll use a different approach
        
        // Use last 6 digits of timestamp + 3 random digits = max 9 digits
        $timestamp = substr(time(), -6); // Last 6 digits of timestamp
        $random = rand(100, 999); // 3 random digits
        
        return (int) ($timestamp . $random); // e.g., 100914953 (9 digits, fits in integer)
    }

    /**
     * Validate that all products in cart have sufficient stock
     */
    private function validateStockAvailability($cartData)
    {
        $outOfStockItems = [];
        
        foreach ($cartData as $item) {
            $product = products::find($item['id']);
            
            if (!$product) {
                $outOfStockItems[] = [
                    'name' => $item['name'],
                    'reason' => 'Product not found'
                ];
                continue;
            }
            
            if ($product->product_stock < $item['quantity']) {
                $outOfStockItems[] = [
                    'name' => $item['name'],
                    'requested' => $item['quantity'],
                    'available' => $product->product_stock
                ];
            }
        }
        
        if (!empty($outOfStockItems)) {
            $message = 'Some items in your cart are out of stock or have insufficient quantity. ';
            $message .= 'Please update your cart and try again.';
            
            return [
                'valid' => false,
                'message' => $message,
                'out_of_stock_items' => $outOfStockItems
            ];
        }
        
        return ['valid' => true];
    }

    /**
     * Create order items and decrease product stock
     */
    private function createOrderItemsAndDecreaseStock($order, $cartData)
    {
        foreach ($cartData as $item) {
            // Create order item record
            order_items::create([
                'order_id' => $order->order_id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price']
            ]);
            
            // Decrease product stock
            $product = products::find($item['id']);
            if ($product) {
                $product->product_stock -= $item['quantity'];
                $product->save();
                
                Log::info('Stock decreased for product', [
                    'product_id' => $product->product_id,
                    'product_name' => $product->product_name,
                    'quantity_ordered' => $item['quantity'],
                    'remaining_stock' => $product->product_stock
                ]);
            }
        }
    }
}