<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\orders;

class CustomerController extends Controller
{
    /**
     * Display the customer profile with personal information and order history.
     *
     * @return \Illuminate\View\View
     */
    public function showProfile()
    {
        $user = Auth::user();
        
        // Get all orders for the current user, ordered by most recent first
        $orders = orders::where('user_id', $user->user_id)
                       ->orderBy('order_date', 'desc')
                       ->get();
        
        return view('Customer.CProfile', compact('user', 'orders'));
    }

    /**
     * Display the customer settings page.
     *
     * @return \Illuminate\View\View
     */
    public function showSettings()
    {
        $user = Auth::user();
        return view('Customer.CSetting', compact('user'));
    }

    /**
     * Delete the customer account.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        
        // Validate password confirmation
        $request->validate([
            'password' => 'required|string',
        ]);
        
        // Check if the password matches
        if (!password_verify($request->password, $user->password)) {
            return back()->with('error', 'Incorrect password. Please try again.');
        }
        
        // Log the user out
        Auth::logout();
        
        // Delete the user account (this will also set user_id to null in orders due to foreign key constraint)
        $user->delete();
        
        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('home')->with('success', 'Your account has been deleted successfully.');
    }
}
