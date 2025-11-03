<?php
/**
 * Email Configuration Test Script
 * 
 * This script tests your email configuration to ensure emails can be sent successfully.
 * 
 * Usage:
 * 1. Make sure your .env file is configured with email settings
 * 2. Run: php test-email.php
 * 3. Check the email inbox for berderajembo99@gmail.com
 */

// Bootstrap Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

echo "\n";
echo "═══════════════════════════════════════════════════\n";
echo "   📧 KAPE NA! EMAIL CONFIGURATION TEST\n";
echo "═══════════════════════════════════════════════════\n";
echo "\n";

// Display current email configuration
echo "Current Email Configuration:\n";
echo "-----------------------------\n";
echo "Mail Driver: " . Config::get('mail.default') . "\n";
echo "Mail Host: " . Config::get('mail.mailers.smtp.host') . "\n";
echo "Mail Port: " . Config::get('mail.mailers.smtp.port') . "\n";
echo "Mail Username: " . Config::get('mail.mailers.smtp.username') . "\n";
echo "Mail Encryption: " . Config::get('mail.mailers.smtp.encryption') . "\n";
echo "Mail From Address: " . Config::get('mail.from.address') . "\n";
echo "Mail From Name: " . Config::get('mail.from.name') . "\n";
echo "\n";

// Check if email is configured
if (empty(Config::get('mail.mailers.smtp.username'))) {
    echo "❌ ERROR: Email not configured!\n";
    echo "Please configure your email settings in .env file.\n";
    echo "See EMAIL_ENV_CONFIG.txt for instructions.\n";
    exit(1);
}

// Prompt for confirmation
echo "This will send a test email to: berderajembo99@gmail.com\n";
echo "Do you want to continue? (yes/no): ";
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
fclose($handle);

if (trim(strtolower($line)) !== 'yes') {
    echo "Test cancelled.\n";
    exit(0);
}

echo "\n";
echo "Sending test email...\n";
echo "\n";

try {
    // Send test email
    Mail::raw(
        "🎉 Congratulations!\n\n" .
        "Your email configuration is working correctly.\n\n" .
        "This test email was sent from your Kape Na! application.\n\n" .
        "Email Details:\n" .
        "- Sent from: " . Config::get('mail.from.address') . "\n" .
        "- Mail Driver: " . Config::get('mail.default') . "\n" .
        "- Timestamp: " . now()->format('Y-m-d H:i:s') . "\n\n" .
        "You can now receive order confirmation emails when customers complete checkout.\n\n" .
        "---\n" .
        "Kape Na! - Your Premium Coffee Experience",
        function ($message) {
            $message->to('berderajembo99@gmail.com')
                    ->subject('✅ Kape Na! - Email Test Successful');
        }
    );

    echo "✅ SUCCESS!\n";
    echo "\n";
    echo "Test email sent successfully!\n";
    echo "Check your inbox at: berderajembo99@gmail.com\n";
    echo "\n";
    echo "If you don't see it:\n";
    echo "1. Check your spam/junk folder\n";
    echo "2. Wait a few minutes for delivery\n";
    echo "3. Check storage/logs/laravel.log for errors\n";
    echo "\n";
    echo "Next steps:\n";
    echo "- Test the checkout process on your website\n";
    echo "- Verify order confirmation emails are received\n";
    echo "- Review EMAIL_SETUP_GUIDE.md for more information\n";
    echo "\n";

} catch (Exception $e) {
    echo "❌ ERROR: Failed to send test email!\n";
    echo "\n";
    echo "Error message: " . $e->getMessage() . "\n";
    echo "\n";
    echo "Troubleshooting steps:\n";
    echo "1. Check your .env file configuration\n";
    echo "2. Verify your Gmail app password is correct\n";
    echo "3. Ensure 2FA is enabled on your Google account\n";
    echo "4. Run: php artisan config:clear && php artisan cache:clear\n";
    echo "5. Check storage/logs/laravel.log for detailed errors\n";
    echo "6. See EMAIL_SETUP_GUIDE.md for detailed instructions\n";
    echo "\n";
    
    exit(1);
}

echo "═══════════════════════════════════════════════════\n";
echo "\n";

