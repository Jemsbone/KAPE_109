<?php

/**
 * Send Test Email to Verify Configuration
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "\n";
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║              SENDING TEST EMAIL TO YOUR INBOX ☕               ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n";
echo "\n";

$testEmail = 'magbanuajembo17@gmail.com';

echo "📧 Sending test email to: {$testEmail}\n";
echo "   From: berderajembo99@gmail.com\n";
echo "   Via: Gmail SMTP\n\n";

try {
    Illuminate\Support\Facades\Mail::raw(
        "Hello from Kape Na! ☕\n\n" .
        "This is a test email to verify your email configuration is working.\n\n" .
        "If you're reading this, it means:\n" .
        "✅ Your Gmail SMTP configuration is correct\n" .
        "✅ Emails can be sent from berderajembo99@gmail.com\n" .
        "✅ Your email verification system is ready to use!\n\n" .
        "What to do next:\n" .
        "1. Go back to your verification page\n" .
        "2. Click the 'Resend Verification Email' button\n" .
        "3. You'll receive the actual verification email\n" .
        "4. Click the verification link to verify your account\n\n" .
        "Warm regards,\n" .
        "The Kape Na! Team ☕",
        function($message) use ($testEmail) {
            $message->to($testEmail)
                    ->subject('✅ Kape Na! Email Test - Configuration Working!');
        }
    );
    
    echo "✅ SUCCESS! Test email sent!\n\n";
    echo "📬 Check your inbox at: {$testEmail}\n";
    echo "   • Check main inbox\n";
    echo "   • Check spam/junk folder (Gmail might filter it)\n";
    echo "   • It may take 1-2 minutes to arrive\n\n";
    
    echo "═══════════════════════════════════════════════════════════════\n";
    echo "🎉 YOUR EMAIL SYSTEM IS WORKING!\n";
    echo "═══════════════════════════════════════════════════════════════\n\n";
    
    echo "Next steps:\n";
    echo "  1. Check your email inbox\n";
    echo "  2. Go to your verification page\n";
    echo "  3. Click 'Resend Verification Email'\n";
    echo "  4. Get your verification email\n";
    echo "  5. Click the verification link\n";
    echo "  6. Done! ✅\n\n";
    
} catch (Exception $e) {
    echo "❌ ERROR: Failed to send email\n\n";
    echo "Error message:\n";
    echo "  {$e->getMessage()}\n\n";
    
    echo "Troubleshooting:\n";
    echo "  1. Check your internet connection\n";
    echo "  2. Verify Gmail App Password is correct\n";
    echo "  3. Check storage/logs/laravel.log for details\n";
    echo "  4. Make sure 2FA is enabled on berderajembo99@gmail.com\n\n";
}

