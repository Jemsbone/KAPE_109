<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use App\Mail\OrderSummary;
use Illuminate\Support\Facades\Auth;
use App\Models\orders;

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
                'order_summary' => 'required|array'
            ]);

            // ✅ Get validated cart data and order summary
            $cartData = $request->input('cart_data');
            $orderSummary = $request->input('order_summary');
            
            // ✅ Get the authenticated user
            $user = Auth::user();

            if (!$user) {
                throw new \Exception('User not authenticated');
            }

            // ✅ Create order record in the database
            $order = $this->createOrder($cartData, $orderSummary, $user);
            
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
    private function createOrder($cartData, $orderSummary, $user)
    {
        // Generate order name from cart items
        $orderName = $this->generateOrderName($cartData);
        
        // Generate unique order number
        $orderNumber = $this->generateOrderNumber();

        // Create the order using your existing orders model
        $order = orders::create([
            'employee_id' => null, // Set to null or assign based on your logic
            'order_name' => $orderName,
            'order_number' => $orderNumber,
            'order_payment_method' => 'cash', // Default payment method
            'order_total_price' => $orderSummary['total'],
            'payment_status' => 'paid', // Mark as paid since it's an online order
            'order_date' => now(),
        ]);

        return $order;
    }

    private function generateOrderName($cartData)
    {
        $itemNames = array_map(function($item) {
            return $item['name'];
        }, $cartData);

        $baseName = implode(', ', array_slice($itemNames, 0, 2));
        
        if (count($itemNames) > 2) {
            $baseName .= ' and ' . (count($itemNames) - 2) . ' more';
        }

        return 'Order: ' . $baseName;
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
}