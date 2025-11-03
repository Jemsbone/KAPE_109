<?php

/**
 * Email Configuration Test Script
 * Run this to test your email setup
 * 
 * Usage: php test-email.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "========================================\n";
echo "   KAPE NA! EMAIL TEST\n";
echo "========================================\n\n";

// Check environment
echo "📧 Mail Configuration:\n";
echo "   MAIL_MAILER: " . env('MAIL_MAILER', 'NOT SET') . "\n";
echo "   MAIL_HOST: " . env('MAIL_HOST', 'NOT SET') . "\n";
echo "   MAIL_PORT: " . env('MAIL_PORT', 'NOT SET') . "\n";
echo "   MAIL_USERNAME: " . (env('MAIL_USERNAME') ? '***SET***' : 'NOT SET') . "\n";
echo "   MAIL_PASSWORD: " . (env('MAIL_PASSWORD') ? '***SET***' : 'NOT SET') . "\n";
echo "   MAIL_FROM_ADDRESS: " . env('MAIL_FROM_ADDRESS', 'NOT SET') . "\n";
echo "   MAIL_FROM_NAME: " . env('MAIL_FROM_NAME', 'NOT SET') . "\n\n";

// Ask for test email
echo "Enter your email address to send a test: ";
$handle = fopen("php://stdin", "r");
$testEmail = trim(fgets($handle));
fclose($handle);

if (!filter_var($testEmail, FILTER_VALIDATE_EMAIL)) {
    echo "\n❌ Invalid email address!\n";
    exit(1);
}

echo "\n🚀 Sending test email to: $testEmail\n\n";

try {
    Illuminate\Support\Facades\Mail::raw('This is a test email from Kape Na! If you receive this, your email configuration is working! ☕', function($message) use ($testEmail) {
        $message->to($testEmail)
                ->subject('Kape Na! Test Email ☕');
    });
    
    echo "✅ Email sent successfully!\n";
    echo "   Check your inbox (and spam folder) for the test email.\n\n";
    
    if (env('MAIL_MAILER') === 'log') {
        echo "⚠️  NOTE: You're using the 'log' mail driver.\n";
        echo "   Check storage/logs/laravel.log for the email.\n\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error sending email:\n";
    echo "   " . $e->getMessage() . "\n\n";
    echo "💡 Troubleshooting tips:\n";
    echo "   1. Check your .env file has correct mail settings\n";
    echo "   2. Run: php artisan config:clear\n";
    echo "   3. For Gmail: Use App Password (not regular password)\n";
    echo "   4. Check storage/logs/laravel.log for detailed errors\n\n";
}

echo "========================================\n";
echo "For setup help, see: QUICK_EMAIL_VERIFICATION.md\n";
echo "========================================\n";
