<?php

/**
 * Quick Admin OTP Retrieval
 * Get the OTP code directly from database if email isn't working
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\coffee_shop_admin;

echo "\n";
echo "╔════════════════════════════════════════════════════════════╗\n";
echo "║     GET ADMIN OTP CODE (Email Backup Method)              ║\n";
echo "╚════════════════════════════════════════════════════════════╝\n";
echo "\n";

// Get the most recent admin
$admin = coffee_shop_admin::latest()->first();

if (!$admin) {
    echo "❌ No admin accounts found.\n";
    echo "   Please register at: http://localhost:8000/adminregister\n";
    echo "\n";
    exit(1);
}

echo "📋 Admin Account Details:\n";
echo "-----------------------------------------------------------\n";
echo "Name: {$admin->admin_name}\n";
echo "Email: {$admin->admin_email}\n";
echo "Created: {$admin->created_at}\n";
echo "\n";

if ($admin->otp_code && $admin->otp_expires_at && now()->lessThan($admin->otp_expires_at)) {
    echo "🔐 CURRENT OTP CODE:\n";
    echo "-----------------------------------------------------------\n";
    echo "\n";
    echo "   ╔═══════════════╗\n";
    echo "   ║   {$admin->otp_code}      ║\n";
    echo "   ╚═══════════════╝\n";
    echo "\n";
    echo "⏰ Expires at: {$admin->otp_expires_at}\n";
    echo "⏱️  Time remaining: " . now()->diffForHumans($admin->otp_expires_at, true) . "\n";
    echo "\n";
    echo "💡 What to do:\n";
    echo "   1. Copy this code: {$admin->otp_code}\n";
    echo "   2. Go to: http://localhost:8000/admin/email/verify\n";
    echo "   3. Paste the code\n";
    echo "   4. Click 'Verify Email'\n";
    echo "\n";
} elseif ($admin->otp_code && $admin->otp_expires_at) {
    echo "⚠️  OTP CODE EXPIRED\n";
    echo "-----------------------------------------------------------\n";
    echo "Old code: {$admin->otp_code}\n";
    echo "Expired at: {$admin->otp_expires_at}\n";
    echo "\n";
    echo "💡 What to do:\n";
    echo "   1. Go to: http://localhost:8000/admin/email/verify\n";
    echo "   2. Click 'Resend Code' button\n";
    echo "   3. Run this script again to get new code\n";
    echo "   OR\n";
    echo "   Run: php test-admin-email.php\n";
    echo "\n";
} else {
    echo "ℹ️  NO OTP CODE GENERATED YET\n";
    echo "-----------------------------------------------------------\n";
    echo "\n";
    echo "💡 What to do:\n";
    echo "   1. Go to: http://localhost:8000/adminlogin\n";
    echo "   2. Login with your credentials\n";
    echo "   3. OTP will be generated\n";
    echo "   4. Run this script again to see the code\n";
    echo "\n";
}

if ($admin->hasVerifiedEmail()) {
    echo "✅ Email is already verified!\n";
    echo "   You can access: http://localhost:8000/admin/dashboard\n";
    echo "\n";
} else {
    echo "❌ Email not verified yet\n";
    echo "   Email verification required for dashboard access\n";
    echo "\n";
}

echo "═══════════════════════════════════════════════════════════\n";
echo "\n";

