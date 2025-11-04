<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\coffee_shop_admin;

echo "\n";
echo "╔═══════════════════════════════════════════════════════════╗\n";
echo "║           ADMIN REGISTRATION STATUS CHECK                 ║\n";
echo "╚═══════════════════════════════════════════════════════════╝\n";
echo "\n";

// Get all admin accounts
$admins = coffee_shop_admin::latest()->get();

if ($admins->isEmpty()) {
    echo "❌ NO ADMIN ACCOUNTS FOUND!\n";
    echo "\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "            YOU NEED TO REGISTER FIRST!\n";
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
    echo "\n";
    echo "Step 1: Make sure Laravel is running:\n";
    echo "        php artisan serve\n";
    echo "\n";
    echo "Step 2: Open your browser and go to:\n";
    echo "        http://localhost:8000/adminregister\n";
    echo "\n";
    echo "Step 3: Fill in the form:\n";
    echo "        - Admin Name: Your Name\n";
    echo "        - Admin Email: your-email@example.com\n";
    echo "        - Password: (min 8 characters)\n";
    echo "        - Confirm Password: (same as password)\n";
    echo "\n";
    echo "Step 4: Click 'Register Admin Account'\n";
    echo "\n";
    echo "Step 5: You'll be redirected to OTP page\n";
    echo "\n";
    echo "Step 6: Run this command to get OTP:\n";
    echo "        php generate-fresh-otp.php\n";
    echo "\n";
    exit(0);
}

echo "📊 FOUND " . $admins->count() . " ADMIN ACCOUNT(S)\n";
echo "\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

foreach ($admins as $index => $admin) {
    echo "\n";
    echo "👤 ADMIN #" . ($index + 1) . "\n";
    echo "-----------------------------------------------------------\n";
    echo "ID: {$admin->admin_id}\n";
    echo "Name: {$admin->admin_name}\n";
    echo "Email: {$admin->admin_email}\n";
    echo "Created: {$admin->created_at}\n";
    echo "\n";
    
    if ($admin->hasVerifiedEmail()) {
        echo "✅ EMAIL VERIFIED: YES\n";
        echo "   Status: Ready to use\n";
        echo "   Access: http://localhost:8000/admin/dashboard\n";
    } else {
        echo "❌ EMAIL VERIFIED: NO\n";
        echo "   Status: Needs verification\n";
        
        if ($admin->otp_code) {
            if ($admin->otp_expires_at && now()->lessThan($admin->otp_expires_at)) {
                echo "\n";
                echo "   🔐 CURRENT OTP CODE:\n";
                echo "   ╔═══════════════╗\n";
                echo "   ║   {$admin->otp_code}      ║\n";
                echo "   ╚═══════════════╝\n";
                echo "\n";
                echo "   ⏰ Expires: {$admin->otp_expires_at}\n";
                echo "   ⏱️  Time left: " . now()->diffForHumans($admin->otp_expires_at, true) . "\n";
                echo "\n";
                echo "   ✅ THIS CODE IS VALID! USE IT NOW!\n";
            } else {
                echo "   ⚠️  OTP EXPIRED\n";
                echo "   Old code: {$admin->otp_code}\n";
                echo "   Expired: {$admin->otp_expires_at}\n";
                echo "\n";
                echo "   🔄 Need to generate new OTP\n";
            }
        } else {
            echo "   ℹ️  No OTP generated yet\n";
        }
    }
    
    echo "-----------------------------------------------------------\n";
}

echo "\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "            WHAT TO DO NEXT:\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "\n";

$unverified = $admins->filter(function($admin) {
    return !$admin->hasVerifiedEmail();
});

if ($unverified->isEmpty()) {
    echo "✅ ALL ADMINS ARE VERIFIED!\n";
    echo "\n";
    echo "You can login at:\n";
    echo "http://localhost:8000/adminlogin\n";
    echo "\n";
} else {
    $admin = $unverified->first();
    
    echo "📋 FOR ADMIN: {$admin->admin_name} ({$admin->admin_email})\n";
    echo "\n";
    
    if (!$admin->otp_code || !$admin->otp_expires_at || now()->greaterThan($admin->otp_expires_at)) {
        echo "Option 1: Generate Fresh OTP\n";
        echo "─────────────────────────────\n";
        echo "Run: php generate-fresh-otp.php\n";
        echo "This will create a new valid OTP code\n";
        echo "\n";
        echo "Option 2: Login Again\n";
        echo "─────────────────────────────\n";
        echo "1. Go to: http://localhost:8000/adminlogin\n";
        echo "2. Login with email and password\n";
        echo "3. New OTP will be generated\n";
        echo "4. Use: php get-admin-otp.php to see it\n";
        echo "\n";
    } else {
        echo "✅ YOU HAVE A VALID OTP!\n";
        echo "\n";
        echo "Step 1: Go to verification page:\n";
        echo "        http://localhost:8000/admin/email/verify\n";
        echo "\n";
        echo "        (If not logged in, login first at:\n";
        echo "         http://localhost:8000/adminlogin)\n";
        echo "\n";
        echo "Step 2: Enter this code: {$admin->otp_code}\n";
        echo "\n";
        echo "Step 3: Click 'Verify Email'\n";
        echo "\n";
        echo "Step 4: Done! Access dashboard\n";
        echo "\n";
    }
}

echo "═══════════════════════════════════════════════════════════\n";
echo "\n";
echo "💡 HELPFUL COMMANDS:\n";
echo "   php generate-fresh-otp.php  - Get new OTP\n";
echo "   php get-admin-otp.php       - Check current OTP\n";
echo "   php check-admin-status.php  - Run this script again\n";
echo "\n";

