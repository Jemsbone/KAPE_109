<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Exception;

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

        // Create user account
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => bcrypt($validated['password']),
            'address' => $validated['address'],
        ]);

        // Send OTP to user's email
        $user->sendEmailVerificationNotification();

        // Store user ID in session for verification
        session(['verification_user_id' => $user->user_id]);

        return redirect()->route('verification.notice')
            ->with('success', 'Registration successful! Please check your email for the OTP code.');
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
            $user = Auth::user();
            
            // Check if email is verified (skip for Google OAuth users)
            if (!$user->hasVerifiedEmail() && !$user->google_id) {
                Auth::logout();
                
                // Store user ID for verification
                session(['verification_user_id' => $user->user_id]);
                
                // Resend OTP
                $user->sendEmailVerificationNotification();
                
                return redirect()->route('verification.notice')
                    ->with('success', 'Please verify your email first. A new OTP has been sent to your email.');
            }
            
            $request->session()->regenerate();
            
            // Generate Sanctum token for API access
            $token = $user->createToken('login-token')->plainTextToken;
            session(['api_token' => $token]);
            
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
        // Revoke all tokens for this user (if any exist)
        if ($request->user()) {
            $request->user()->tokens()->delete();
        }
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'You have been logged out successfully.');
    }

    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            // Get user information from Google
            $googleUser = Socialite::driver('google')->user();
            
            // Check if user already exists by email or Google ID
            $user = User::where('email', $googleUser->getEmail())
                        ->orWhere('google_id', $googleUser->getId())
                        ->first();
            
            if ($user) {
                // User exists - update their Google ID and avatar if not set
                if (!$user->google_id) {
                    $user->google_id = $googleUser->getId();
                }
                
                // Update avatar from Google
                if ($googleUser->getAvatar()) {
                    $user->avatar = $googleUser->getAvatar();
                }
                
                // Mark email as verified since Google verified it
                if (!$user->email_verified_at) {
                    $user->email_verified_at = now();
                }
                
                $user->save();
                
                // Log the user in
                Auth::login($user);
                
                $message = 'Welcome back! Successfully logged in with Google.';
            } else {
                // Create new user account automatically
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                    'email_verified_at' => now(), // Google emails are already verified
                    'phone' => null,
                    'address' => null,
                    'password' => bcrypt(uniqid()), // Random password (not used for Google login)
                ]);
                
                // Log the new user in
                Auth::login($user);
                
                $message = 'Account created successfully! Welcome to Kape Na!';
            }
            
            // Generate Sanctum token for API access
            $token = $user->createToken('google-oauth-token')->plainTextToken;
            session(['api_token' => $token]);
            
            // Redirect to customer dashboard
            return redirect()->route('customer.home')
                ->with('success', $message);
                
        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            
            return redirect()->route('login')
                ->withErrors(['error' => 'Unable to login with Google. Please try again or contact support.']);
        }
    }

    /**
     * Show OTP verification form
     */
    public function showVerificationForm()
    {
        // Check if there's a user to verify
        if (!session('verification_user_id')) {
            return redirect()->route('login')
                ->withErrors(['error' => 'No pending verification found.']);
        }

        $user = User::find(session('verification_user_id'));
        
        if (!$user) {
            return redirect()->route('login')
                ->withErrors(['error' => 'User not found.']);
        }

        // If already verified, redirect to login
        if ($user->hasVerifiedEmail()) {
            session()->forget('verification_user_id');
            return redirect()->route('login')
                ->with('success', 'Email already verified! Please login.');
        }

        return view('auth.verify-otp', compact('user'));
    }

    /**
     * Verify OTP code
     */
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_code' => 'required|string|size:6',
        ]);

        $user = User::find(session('verification_user_id'));

        if (!$user) {
            return back()->withErrors(['otp_code' => 'User not found.']);
        }

        // Verify the OTP
        if ($user->verifyOtpCode($request->otp_code)) {
            // OTP is valid - log the user in
            Auth::login($user);

            // Generate Sanctum token
            $token = $user->createToken('verification-token')->plainTextToken;
            session(['api_token' => $token]);

            // Clear verification session
            session()->forget('verification_user_id');

            return redirect()->route('customer.home')
                ->with('success', 'Email verified successfully! Welcome to Kape Na!');
        }

        // OTP is invalid or expired
        return back()->withErrors([
            'otp_code' => 'Invalid or expired OTP code. Please try again or request a new code.',
        ]);
    }

    /**
     * Resend OTP code
     */
    public function resendOtp(Request $request)
    {
        $user = User::find(session('verification_user_id'));

        if (!$user) {
            return back()->withErrors(['error' => 'User not found.']);
        }

        // Check if already verified
        if ($user->hasVerifiedEmail()) {
            session()->forget('verification_user_id');
            return redirect()->route('login')
                ->with('success', 'Email already verified! Please login.');
        }

        // Send new OTP
        $user->sendEmailVerificationNotification();

        return back()->with('success', 'A new OTP code has been sent to your email!');
    }
}