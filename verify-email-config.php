<?php

/**
 * Email Configuration Verification Script for Kape Na!
 * This checks if your .env email configuration is correct
 * 
 * Usage: php verify-email-config.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "\n";
echo "╔════════════════════════════════════════════════════════════════╗\n";
echo "║         KAPE NA! EMAIL CONFIGURATION CHECKER ☕                ║\n";
echo "╚════════════════════════════════════════════════════════════════╝\n";
echo "\n";

// Expected configuration
$expected = [
    'MAIL_MAILER' => 'smtp',
    'MAIL_HOST' => 'smtp.gmail.com',
    'MAIL_PORT' => '587',
    'MAIL_USERNAME' => 'berderajembo99@gmail.com',
    'MAIL_PASSWORD' => 'pxowhbnjaurxruwd',
    'MAIL_ENCRYPTION' => 'tls',
    'MAIL_FROM_ADDRESS' => 'berderajembo99@gmail.com',
    'MAIL_FROM_NAME' => 'Kape Na!',
];

echo "📋 Checking your email configuration...\n\n";

$allCorrect = true;
$issues = [];

// Check each setting
foreach ($expected as $key => $expectedValue) {
    $actualValue = env($key);
    
    if ($key === 'MAIL_PASSWORD') {
        // Don't show password in plain text
        $display = $actualValue ? '***' . substr($actualValue, -4) : 'NOT SET';
        $expectedDisplay = '***' . substr($expectedValue, -4);
        
        if ($actualValue === $expectedValue) {
            echo "✅ {$key}: {$display}\n";
        } else {
            echo "❌ {$key}: {$display} (Expected: {$expectedDisplay})\n";
            $allCorrect = false;
            $issues[] = "{$key} is incorrect or not set";
        }
    } else {
        if ($actualValue == $expectedValue) {
            echo "✅ {$key}: {$actualValue}\n";
        } else {
            echo "❌ {$key}: " . ($actualValue ?: 'NOT SET') . " (Expected: {$expectedValue})\n";
            $allCorrect = false;
            $issues[] = "{$key} is incorrect or not set";
        }
    }
}

echo "\n";
echo "═══════════════════════════════════════════════════════════════\n";

if ($allCorrect) {
    echo "✅ ALL SETTINGS CORRECT!\n\n";
    echo "Your email configuration is properly set up.\n";
    echo "You can now:\n";
    echo "  1. Go to your verification page\n";
    echo "  2. Click 'Resend Verification Email'\n";
    echo "  3. Check magbanuajembo17@gmail.com inbox\n";
    echo "  4. Check spam folder if not in inbox\n\n";
    
    // Offer to send test email
    echo "Would you like to send a test email now? (yes/no): ";
    $handle = fopen("php://stdin", "r");
    $answer = strtolower(trim(fgets($handle)));
    fclose($handle);
    
    if ($answer === 'yes' || $answer === 'y') {
        echo "\n🚀 Sending test email to magbanuajembo17@gmail.com...\n";
        
        try {
            Illuminate\Support\Facades\Mail::raw(
                "This is a test email from Kape Na! ☕\n\n" .
                "If you received this email, your email configuration is working perfectly!\n\n" .
                "You can now receive verification emails.\n\n" .
                "Warm regards,\n" .
                "The Kape Na! Team",
                function($message) {
                    $message->to('magbanuajembo17@gmail.com')
                            ->subject('Kape Na! Email Test - Configuration Successful ☕');
                }
            );
            
            echo "✅ Test email sent successfully!\n";
            echo "   Check magbanuajembo17@gmail.com (and spam folder)\n\n";
            
        } catch (Exception $e) {
            echo "❌ Error sending test email:\n";
            echo "   " . $e->getMessage() . "\n\n";
        }
    }
    
} else {
    echo "⚠️  CONFIGURATION ISSUES FOUND\n\n";
    echo "Issues detected:\n";
    foreach ($issues as $issue) {
        echo "  • {$issue}\n";
    }
    
    echo "\n📝 TO FIX:\n\n";
    echo "1. Open your .env file (in the project root)\n\n";
    echo "2. Add or update these lines:\n\n";
    echo "   MAIL_MAILER=smtp\n";
    echo "   MAIL_HOST=smtp.gmail.com\n";
    echo "   MAIL_PORT=587\n";
    echo "   MAIL_USERNAME=berderajembo99@gmail.com\n";
    echo "   MAIL_PASSWORD=pxowhbnjaurxruwd\n";
    echo "   MAIL_ENCRYPTION=tls\n";
    echo "   MAIL_FROM_ADDRESS=berderajembo99@gmail.com\n";
    echo "   MAIL_FROM_NAME=\"Kape Na!\"\n\n";
    echo "3. Save the .env file\n\n";
    echo "4. Run: php artisan config:clear\n\n";
    echo "5. Run this script again: php verify-email-config.php\n\n";
}

echo "═══════════════════════════════════════════════════════════════\n";
echo "\n📚 For more help, see: GMAIL_CONFIG_INSTRUCTIONS.md\n\n";

