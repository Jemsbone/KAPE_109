<?php
/**
 * Detailed Email Test with Error Reporting
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;

echo "\n";
echo "╔════════════════════════════════════════════════╗\n";
echo "║     DETAILED EMAIL CONFIGURATION TEST          ║\n";
echo "╚════════════════════════════════════════════════╝\n";
echo "\n";

// Show current configuration
echo "Current Configuration:\n";
echo "─────────────────────────────────────────────────\n";
echo "MAIL_MAILER:       " . Config::get('mail.default') . "\n";
echo "MAIL_HOST:         " . Config::get('mail.mailers.smtp.host') . "\n";
echo "MAIL_PORT:         " . Config::get('mail.mailers.smtp.port') . "\n";
echo "MAIL_USERNAME:     " . Config::get('mail.mailers.smtp.username') . "\n";
echo "MAIL_PASSWORD:     " . (Config::get('mail.mailers.smtp.password') ? 
    substr(Config::get('mail.mailers.smtp.password'), 0, 4) . '************' : 
    'NOT SET') . "\n";
echo "MAIL_ENCRYPTION:   " . (Config::get('mail.mailers.smtp.encryption') ?: 'NOT SET') . "\n";
echo "MAIL_FROM_ADDRESS: " . Config::get('mail.from.address') . "\n";
echo "MAIL_FROM_NAME:    " . Config::get('mail.from.name') . "\n";
echo "\n";

// Check for issues
$issues = [];

if (Config::get('mail.mailers.smtp.username') !== 'berderajembo99@gmail.com') {
    $issues[] = "❌ MAIL_USERNAME should be: berderajembo99@gmail.com";
    $issues[] = "   Current: " . Config::get('mail.mailers.smtp.username');
}

if (!Config::get('mail.mailers.smtp.encryption')) {
    $issues[] = "❌ MAIL_ENCRYPTION is missing (should be: tls)";
}

if (!Config::get('mail.mailers.smtp.password')) {
    $issues[] = "❌ MAIL_PASSWORD is not set";
}

if (Config::get('mail.from.address') !== 'berderajembo99@gmail.com') {
    $issues[] = "❌ MAIL_FROM_ADDRESS should be: berderajembo99@gmail.com";
    $issues[] = "   Current: " . Config::get('mail.from.address');
}

if (!empty($issues)) {
    echo "Issues Found:\n";
    echo "─────────────────────────────────────────────────\n";
    foreach ($issues as $issue) {
        echo $issue . "\n";
    }
    echo "\n";
    echo "Please fix your .env file with these settings:\n";
    echo "─────────────────────────────────────────────────\n";
    echo "MAIL_MAILER=smtp\n";
    echo "MAIL_HOST=smtp.gmail.com\n";
    echo "MAIL_PORT=587\n";
    echo "MAIL_USERNAME=berderajembo99@gmail.com\n";
    echo "MAIL_PASSWORD=your-16-character-app-password\n";
    echo "MAIL_ENCRYPTION=tls\n";
    echo "MAIL_FROM_ADDRESS=berderajembo99@gmail.com\n";
    echo "MAIL_FROM_NAME=\"Kape Na!\"\n";
    echo "\n";
    echo "After fixing, run: php artisan config:clear\n";
    echo "\n";
    exit(1);
}

// If no issues, try to send test email
echo "✅ Configuration looks good! Testing email send...\n";
echo "\n";
echo "Sending test email to berderajembo99@gmail.com...\n";

try {
    Mail::raw(
        "🎉 Success! Your email configuration is working!\n\n" .
        "This test email confirms that:\n" .
        "✅ SMTP connection is working\n" .
        "✅ Authentication is successful\n" .
        "✅ Emails can be sent from your application\n\n" .
        "Your Kape Na! order confirmation emails will now work!\n\n" .
        "Sent at: " . now()->format('Y-m-d H:i:s'),
        function ($message) {
            $message->to('berderajembo99@gmail.com')
                    ->subject('✅ Kape Na! - Email Test Successful!');
        }
    );
    
    echo "\n";
    echo "╔════════════════════════════════════════════════╗\n";
    echo "║              ✅ SUCCESS!                       ║\n";
    echo "╚════════════════════════════════════════════════╝\n";
    echo "\n";
    echo "Test email sent successfully!\n";
    echo "Check berderajembo99@gmail.com inbox (or spam folder)\n";
    echo "\n";
    echo "Your email system is now working! 🎉\n";
    echo "Order confirmation emails will be sent automatically.\n";
    echo "\n";

} catch (Exception $e) {
    echo "\n";
    echo "╔════════════════════════════════════════════════╗\n";
    echo "║              ❌ ERROR                          ║\n";
    echo "╚════════════════════════════════════════════════╝\n";
    echo "\n";
    echo "Failed to send email!\n";
    echo "\n";
    echo "Error Details:\n";
    echo "─────────────────────────────────────────────────\n";
    echo $e->getMessage() . "\n";
    echo "\n";
    
    // Common error solutions
    if (strpos($e->getMessage(), 'Authentication') !== false || 
        strpos($e->getMessage(), '535') !== false) {
        echo "⚠️  Authentication Error Solutions:\n";
        echo "─────────────────────────────────────────────────\n";
        echo "1. Make sure you're using an App Password (NOT your Gmail password)\n";
        echo "2. Generate a new App Password:\n";
        echo "   - Log in to berderajembo99@gmail.com\n";
        echo "   - Go to: https://myaccount.google.com/apppasswords\n";
        echo "   - Create a new password for 'Mail' app\n";
        echo "   - Copy the 16-character password (no spaces)\n";
        echo "   - Update MAIL_PASSWORD in .env file\n";
        echo "3. Make sure 2-Factor Authentication is enabled\n";
        echo "4. Run: php artisan config:clear\n";
        echo "\n";
    } elseif (strpos($e->getMessage(), 'Connection') !== false) {
        echo "⚠️  Connection Error Solutions:\n";
        echo "─────────────────────────────────────────────────\n";
        echo "1. Check your internet connection\n";
        echo "2. Verify MAIL_HOST=smtp.gmail.com\n";
        echo "3. Verify MAIL_PORT=587\n";
        echo "4. Verify MAIL_ENCRYPTION=tls\n";
        echo "5. Check if firewall is blocking port 587\n";
        echo "\n";
    } else {
        echo "⚠️  Try These Solutions:\n";
        echo "─────────────────────────────────────────────────\n";
        echo "1. Double-check all settings in .env file\n";
        echo "2. Make sure you saved the .env file\n";
        echo "3. Run: php artisan config:clear\n";
        echo "4. Generate a fresh App Password\n";
        echo "5. Check Laravel logs: storage/logs/laravel.log\n";
        echo "\n";
    }
    
    exit(1);
}

