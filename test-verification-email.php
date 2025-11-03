<?php

/**
 * Test Verification Email Sending
 * This simulates sending a verification email
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "\n";
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║        TESTING VERIFICATION EMAIL - KAPE NA! ☕                ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n";
echo "\n";

use App\Models\User;
use App\Notifications\VerifyEmailNotification;

// Find your user
$user = User::where('email', 'magbanuajembo17@gmail.com')->first();

if (!$user) {
    echo "❌ User not found with email: magbanuajembo17@gmail.com\n";
    echo "\nAvailable users:\n";
    $users = User::select('user_id', 'name', 'email', 'email_verified_at')->get();
    foreach ($users as $u) {
        $verified = $u->email_verified_at ? '✅ Verified' : '❌ Not Verified';
        echo "  • {$u->name} ({$u->email}) - {$verified}\n";
    }
    exit(1);
}

echo "📧 User Information:\n";
echo "   Name: {$user->name}\n";
echo "   Email: {$user->email}\n";
echo "   Verified: " . ($user->email_verified_at ? '✅ Yes' : '❌ No') . "\n";
echo "\n";

if ($user->email_verified_at) {
    echo "⚠️  This user is already verified!\n";
    echo "   Verified at: {$user->email_verified_at}\n\n";
    echo "Would you like to send a verification email anyway? (yes/no): ";
    $handle = fopen("php://stdin", "r");
    $answer = strtolower(trim(fgets($handle)));
    fclose($handle);
    
    if ($answer !== 'yes' && $answer !== 'y') {
        echo "\n❌ Cancelled.\n";
        exit(0);
    }
    echo "\n";
}

echo "🚀 Sending verification email...\n\n";

try {
    // Send the verification notification
    $user->notify(new VerifyEmailNotification());
    
    echo "✅ SUCCESS! Verification email sent!\n\n";
    echo "═══════════════════════════════════════════════════════════════\n";
    echo "📬 CHECK YOUR EMAIL\n";
    echo "═══════════════════════════════════════════════════════════════\n\n";
    echo "Email sent to: magbanuajembo17@gmail.com\n";
    echo "From: berderajembo99@gmail.com\n";
    echo "Subject: Verify Your Email Address - Kape Na!\n\n";
    
    echo "What to do:\n";
    echo "  1. Check your inbox at magbanuajembo17@gmail.com\n";
    echo "  2. Check spam folder if not in inbox\n";
    echo "  3. Look for email with subject: 'Verify Your Email Address - Kape Na!'\n";
    echo "  4. Click the 'Verify Email Address' button\n";
    echo "  5. You'll be redirected to Customer Home\n\n";
    
    echo "⏱️  Verification link expires in: 60 minutes\n\n";
    
} catch (Exception $e) {
    echo "❌ ERROR: Failed to send verification email\n\n";
    echo "Error message:\n";
    echo "  " . $e->getMessage() . "\n\n";
    echo "Stack trace:\n";
    echo "  " . $e->getTraceAsString() . "\n\n";
    
    echo "Troubleshooting:\n";
    echo "  1. Check storage/logs/laravel.log for details\n";
    echo "  2. Verify email configuration in .env\n";
    echo "  3. Run: php artisan config:clear\n";
    echo "  4. Check your internet connection\n\n";
}

