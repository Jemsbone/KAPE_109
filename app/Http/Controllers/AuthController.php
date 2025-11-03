<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|max:15',
            'password' => 'required|min:8|confirmed',
            'address' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => bcrypt($validated['password']),
            'address' => $validated['address'],
        ]);

        // Fire the Registered event to send verification email
        event(new Registered($user));

        // Log the user in but redirect to verification notice
        Auth::login($user);

        return redirect()->route('verification.notice')
            ->with('success', 'Registration successful! Please check your email to verify your account.');
    }

    /**
     * Show login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Check if email is verified
            if (!Auth::user()->hasVerifiedEmail()) {
                return redirect()->route('verification.notice')
                    ->with('warning', 'Please verify your email address before accessing the site.');
            }
            
            return redirect()->route('customer.home')->with('success', 'Login successful! Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Show email verification notice
     */
    public function verificationNotice()
    {
        // If already verified, redirect to home
        if (Auth::user() && Auth::user()->hasVerifiedEmail()) {
            return redirect()->route('customer.home');
        }

        return view('auth.verify-email');
    }

    /**
     * Resend verification email
     */
    public function resendVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->route('customer.home');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'A new verification link has been sent to your email address!');
    }

    /**
     * Handle email verification from link
     */
    public function verifyEmail(Request $request, $id, $hash)
    {
        // Find the user by ID
        $user = User::findOrFail($id);

        // Verify the hash matches
        if (!hash_equals($hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link.');
        }

        // Check if link has expired (60 minutes)
        if ($request->hasValidSignature() === false) {
            return redirect()->route('verification.notice')
                ->with('error', 'This verification link has expired. Please request a new one.');
        }

        // Mark email as verified if not already
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        // Log the user in automatically
        Auth::login($user);
        $request->session()->regenerate();

        // Redirect to customer home with success message
        return redirect()->route('customer.home')
            ->with('success', 'Your email has been verified successfully! Welcome to Kape Na!');
    }
}