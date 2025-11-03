<?php
/**
 * Quick Email Configuration Checker
 */

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Config;

echo "\n";
echo "Current Email Configuration:\n";
echo "============================\n";
echo "Mail Driver: " . Config::get('mail.default') . "\n";
echo "Mail Host: " . Config::get('mail.mailers.smtp.host') . "\n";
echo "Mail Port: " . Config::get('mail.mailers.smtp.port') . "\n";
echo "Mail Username: " . Config::get('mail.mailers.smtp.username') . "\n";
echo "Mail Password: " . (Config::get('mail.mailers.smtp.password') ? '***SET***' : 'NOT SET') . "\n";
echo "Mail Encryption: " . Config::get('mail.mailers.smtp.encryption') . "\n";
echo "Mail From Address: " . Config::get('mail.from.address') . "\n";
echo "Mail From Name: " . Config::get('mail.from.name') . "\n";
echo "\n";

// Check if all required settings are present
$allSet = true;
$issues = [];

if (!Config::get('mail.default')) {
    $issues[] = "❌ MAIL_MAILER not set";
    $allSet = false;
}

if (!Config::get('mail.mailers.smtp.host')) {
    $issues[] = "❌ MAIL_HOST not set";
    $allSet = false;
}

if (!Config::get('mail.mailers.smtp.username')) {
    $issues[] = "❌ MAIL_USERNAME not set";
    $allSet = false;
}

if (!Config::get('mail.mailers.smtp.password')) {
    $issues[] = "❌ MAIL_PASSWORD not set (need Gmail App Password)";
    $allSet = false;
}

if (!Config::get('mail.mailers.smtp.encryption')) {
    $issues[] = "⚠️  MAIL_ENCRYPTION not set (should be 'tls')";
}

if ($allSet && empty($issues)) {
    echo "✅ All email settings are configured!\n";
    echo "\nYou can now:\n";
    echo "1. Try a checkout on your website\n";
    echo "2. Check berderajembo99@gmail.com for the email\n";
    echo "3. Check spam folder if not in inbox\n";
} else {
    echo "Issues found:\n";
    foreach ($issues as $issue) {
        echo "$issue\n";
    }
    echo "\nPlease fix these issues in your .env file\n";
}

echo "\n";

