<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\coffee_shop_admin;

class AdminAuthController extends Controller
{
    /**
     * Show admin registration form
     */
    public function showRegistrationForm()
    {
        // Redirect if already logged in as admin
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin_register');
    }

    /**
     * Handle admin registration
     */
    public function register(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:coffee_shop_admin,admin_email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the admin account
        $admin = coffee_shop_admin::create([
            'admin_name' => $request->admin_name,
            'admin_email' => $request->admin_email,
            'admin_password' => Hash::make($request->password),
        ]);

        // Log the admin in
        Auth::guard('admin')->login($admin);
        $request->session()->regenerate();

        // Generate OTP and send email immediately
        try {
            \Log::info('Starting admin registration OTP process', [
                'admin_id' => $admin->admin_id,
                'admin_email' => $admin->admin_email
            ]);
            
            // Generate OTP code first
            $otpCode = $admin->generateOtpCode();
            
            \Log::info('OTP code generated', [
                'admin_id' => $admin->admin_id,
                'otp_code' => $otpCode,
                'expires_at' => $admin->otp_expires_at
            ]);
            
            // Send email immediately using direct notification
            $admin->notify(new \App\Notifications\AdminOtpVerificationNotification($otpCode));
            
            \Log::info('Admin OTP email sent successfully', [
                'admin_id' => $admin->admin_id,
                'admin_email' => $admin->admin_email,
                'otp_code' => $otpCode,
                'message' => 'Email delivered to mail server'
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to send admin OTP email', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'admin_email' => $admin->admin_email,
                'admin_id' => $admin->admin_id
            ]);
            
            // Still redirect but show a warning
            return redirect()->route('admin.verification.notice')
                ->with('warning', 'Registration successful, but there was an issue sending the email. Please contact support if you don\'t receive the code.');
        }

        // Redirect to OTP verification page
        return redirect()->route('admin.verification.notice')
            ->with('success', 'Registration successful! A verification code has been sent to your email address.');
    }

    /**
     * Show admin login form
     */
    public function showLoginForm()
    {
        // Redirect if already logged in as admin
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin_login');
    }

    /**
     * Handle admin login request
     */
    public function login(Request $request)
    {
        // Validate the incoming request
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the admin by email
        $admin = coffee_shop_admin::where('admin_email', $credentials['email'])->first();

        // Check if admin exists and password is correct
        if (!$admin || !Hash::check($credentials['password'], $admin->admin_password)) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }

        // Log the admin in
        Auth::guard('admin')->login($admin, $request->remember);
        $request->session()->regenerate();

        // Generate OTP and send email immediately
        try {
            \Log::info('Starting admin login OTP process', [
                'admin_id' => $admin->admin_id,
                'admin_email' => $admin->admin_email
            ]);
            
            // Generate OTP code first
            $otpCode = $admin->generateOtpCode();
            
            \Log::info('OTP code generated for login', [
                'admin_id' => $admin->admin_id,
                'otp_code' => $otpCode,
                'expires_at' => $admin->otp_expires_at
            ]);
            
            // Send email immediately using direct notification
            $admin->notify(new \App\Notifications\AdminOtpVerificationNotification($otpCode));
            
            \Log::info('Admin login OTP email sent successfully', [
                'admin_id' => $admin->admin_id,
                'admin_email' => $admin->admin_email,
                'otp_code' => $otpCode,
                'message' => 'Email delivered to mail server'
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to send admin login OTP email', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'admin_email' => $admin->admin_email,
                'admin_id' => $admin->admin_id
            ]);
            
            // Still redirect but show a warning
            return redirect()->route('admin.verification.notice')
                ->with('warning', 'Logged in successfully, but there was an issue sending the verification code. Please contact support if you don\'t receive it.');
        }

        // Redirect to OTP verification page
        return redirect()->route('admin.verification.notice')
            ->with('success', 'A verification code has been sent to your email address.');
    }

    /**
     * Show admin OTP verification notice
     */
    public function verificationNotice()
    {
        // Get the authenticated admin
        $admin = Auth::guard('admin')->user();

        // If not authenticated, redirect to login
        if (!$admin) {
            return redirect()->route('admin.login');
        }

        // If already verified, redirect to dashboard
        if ($admin->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.admin_verify_otp');
    }

    /**
     * Handle admin OTP verification
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $admin = Auth::guard('admin')->user();

        // Check if admin is authenticated
        if (!$admin) {
            return redirect()->route('admin.login')
                ->with('error', 'Session expired. Please log in again.');
        }

        // Check if already verified
        if ($admin->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard')
                ->with('info', 'Your email is already verified!');
        }

        // Verify the OTP code
        if ($admin->verifyOtpCode($request->otp)) {
            return redirect()->route('admin.dashboard')
                ->with('success', 'Your email has been verified successfully! Welcome to Kape Na! Admin Dashboard.');
        }

        return back()->withErrors([
            'otp' => 'Invalid or expired verification code. Please try again or request a new code.',
        ]);
    }

    /**
     * Resend OTP verification code
     */
    public function resendVerification(Request $request)
    {
        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->route('admin.login');
        }

        if ($admin->hasVerifiedEmail()) {
            return redirect()->route('admin.dashboard');
        }

        // Generate and resend OTP
        try {
            \Log::info('Resending admin OTP', [
                'admin_id' => $admin->admin_id,
                'admin_email' => $admin->admin_email
            ]);
            
            // Generate OTP code first
            $otpCode = $admin->generateOtpCode();
            
            \Log::info('New OTP code generated for resend', [
                'admin_id' => $admin->admin_id,
                'otp_code' => $otpCode,
                'expires_at' => $admin->otp_expires_at
            ]);
            
            // Send email immediately using direct notification
            $admin->notify(new \App\Notifications\AdminOtpVerificationNotification($otpCode));
            
            \Log::info('Admin OTP resent successfully', [
                'admin_id' => $admin->admin_id,
                'admin_email' => $admin->admin_email,
                'otp_code' => $otpCode,
                'message' => 'Email delivered to mail server'
            ]);
            
            return back()->with('success', 'A new verification code has been sent to your email address!');
        } catch (\Exception $e) {
            \Log::error('Failed to resend admin OTP email', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'admin_email' => $admin->admin_email,
                'admin_id' => $admin->admin_id
            ]);
            
            return back()->with('error', 'Failed to send verification code. Please check the logs or contact support.');
        }
    }

    /**
     * Handle admin logout
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'You have been logged out successfully.');
    }
}
