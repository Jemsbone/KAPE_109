<?php
/**
 * Checkout Debugging Script
 * 
 * This script helps debug checkout issues by checking all prerequisites.
 * 
 * Usage: php debug-checkout.php
 */

// Bootstrap Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\orders;
use App\Models\User;

echo "\n";
echo "═══════════════════════════════════════════════════\n";
echo "   🔍 KAPE NA! CHECKOUT DEBUGGING TOOL\n";
echo "═══════════════════════════════════════════════════\n";
echo "\n";

$allGood = true;

// 1. Check Database Connection
echo "1. Checking Database Connection...\n";
try {
    DB::connection()->getPdo();
    echo "   ✅ Database connected successfully\n";
    echo "   Database: " . DB::connection()->getDatabaseName() . "\n";
} catch (\Exception $e) {
    echo "   ❌ Database connection failed: " . $e->getMessage() . "\n";
    $allGood = false;
}
echo "\n";

// 2. Check Orders Table
echo "2. Checking Orders Table...\n";
try {
    if (Schema::hasTable('orders')) {
        echo "   ✅ Orders table exists\n";
        
        $columns = Schema::getColumnListing('orders');
        echo "   Columns: " . implode(', ', $columns) . "\n";
        
        $requiredColumns = ['order_id', 'order_name', 'order_number', 'order_payment_method', 'order_total_price', 'payment_status', 'order_date'];
        $missingColumns = array_diff($requiredColumns, $columns);
        
        if (empty($missingColumns)) {
            echo "   ✅ All required columns present\n";
        } else {
            echo "   ❌ Missing columns: " . implode(', ', $missingColumns) . "\n";
            $allGood = false;
        }
    } else {
        echo "   ❌ Orders table does not exist!\n";
        echo "   Run: php artisan migrate\n";
        $allGood = false;
    }
} catch (\Exception $e) {
    echo "   ❌ Error checking orders table: " . $e->getMessage() . "\n";
    $allGood = false;
}
echo "\n";

// 3. Check Users Table
echo "3. Checking Users/Authentication...\n";
try {
    if (Schema::hasTable('users')) {
        echo "   ✅ Users table exists\n";
        $userCount = User::count();
        echo "   User count: " . $userCount . "\n";
        
        if ($userCount > 0) {
            echo "   ✅ Users exist in database\n";
        } else {
            echo "   ⚠️  No users found - create a user first\n";
        }
    } else {
        echo "   ❌ Users table does not exist!\n";
        $allGood = false;
    }
} catch (\Exception $e) {
    echo "   ❌ Error checking users: " . $e->getMessage() . "\n";
    $allGood = false;
}
echo "\n";

// 4. Check Email Configuration
echo "4. Checking Email Configuration...\n";
$mailDriver = Config::get('mail.default');
$mailHost = Config::get('mail.mailers.smtp.host');
$mailUsername = Config::get('mail.mailers.smtp.username');
$mailFromAddress = Config::get('mail.from.address');
$mailFromName = Config::get('mail.from.name');

echo "   Mail Driver: " . ($mailDriver ?: 'Not set') . "\n";
echo "   Mail Host: " . ($mailHost ?: 'Not set') . "\n";
echo "   Mail Username: " . ($mailUsername ?: 'Not set') . "\n";
echo "   Mail From Address: " . ($mailFromAddress ?: 'Not set') . "\n";
echo "   Mail From Name: " . ($mailFromName ?: 'Not set') . "\n";

if ($mailDriver && $mailHost && $mailUsername) {
    echo "   ✅ Email is configured\n";
} else {
    echo "   ⚠️  Email not fully configured (orders will still work)\n";
    echo "   See EMAIL_ENV_CONFIG.txt to configure email\n";
}
echo "\n";

// 5. Test Order Creation
echo "5. Testing Order Creation...\n";
try {
    // Try to create a test order
    $testOrder = [
        'employee_id' => null,
        'order_name' => 'Test Order',
        'order_number' => time(),
        'order_payment_method' => 'cash',
        'order_total_price' => 10.50,
        'payment_status' => 'paid',
        'order_date' => now(),
    ];
    
    // Attempt to create (but we'll rollback)
    DB::beginTransaction();
    $order = orders::create($testOrder);
    echo "   ✅ Test order created successfully (ID: " . $order->order_id . ")\n";
    DB::rollBack(); // Rollback the test order
    echo "   ✅ Test order rolled back (not saved)\n";
} catch (\Exception $e) {
    DB::rollBack();
    echo "   ❌ Failed to create test order: " . $e->getMessage() . "\n";
    $allGood = false;
}
echo "\n";

// 6. Check Laravel Logs
echo "6. Checking Laravel Logs...\n";
$logFile = storage_path('logs/laravel.log');
if (file_exists($logFile)) {
    echo "   ✅ Log file exists: " . $logFile . "\n";
    $logSize = filesize($logFile);
    echo "   Log size: " . number_format($logSize / 1024, 2) . " KB\n";
    
    // Get last 10 lines of log
    $logLines = file($logFile);
    $lastLines = array_slice($logLines, -5);
    
    if (!empty($lastLines)) {
        echo "   \n   Last few log entries:\n";
        echo "   " . str_repeat('-', 50) . "\n";
        foreach ($lastLines as $line) {
            echo "   " . trim($line) . "\n";
        }
        echo "   " . str_repeat('-', 50) . "\n";
    }
} else {
    echo "   ⚠️  Log file not found (this is okay if no errors yet)\n";
}
echo "\n";

// 7. Check Routes
echo "7. Checking Checkout Route...\n";
try {
    $routes = app('router')->getRoutes();
    $checkoutRoute = null;
    
    foreach ($routes as $route) {
        if ($route->getName() === 'checkout.process') {
            $checkoutRoute = $route;
            break;
        }
    }
    
    if ($checkoutRoute) {
        echo "   ✅ Checkout route exists: POST /checkout/process\n";
        echo "   Controller: " . $checkoutRoute->getActionName() . "\n";
        
        // Check if middleware includes 'auth'
        $middleware = $checkoutRoute->middleware();
        if (in_array('auth', $middleware) || in_array('web', $middleware)) {
            echo "   ✅ Auth middleware is applied\n";
        } else {
            echo "   ⚠️  Auth middleware might not be applied\n";
        }
    } else {
        echo "   ❌ Checkout route not found!\n";
        echo "   Check routes/web.php\n";
        $allGood = false;
    }
} catch (\Exception $e) {
    echo "   ❌ Error checking routes: " . $e->getMessage() . "\n";
}
echo "\n";

// 8. Check File Permissions
echo "8. Checking File Permissions...\n";
$storageDir = storage_path();
$logsDir = storage_path('logs');

if (is_writable($storageDir)) {
    echo "   ✅ Storage directory is writable\n";
} else {
    echo "   ❌ Storage directory is not writable: " . $storageDir . "\n";
    $allGood = false;
}

if (is_writable($logsDir)) {
    echo "   ✅ Logs directory is writable\n";
} else {
    echo "   ⚠️  Logs directory is not writable: " . $logsDir . "\n";
}
echo "\n";

// Summary
echo "═══════════════════════════════════════════════════\n";
echo "   DIAGNOSTIC SUMMARY\n";
echo "═══════════════════════════════════════════════════\n";

if ($allGood) {
    echo "\n";
    echo "✅ All checks passed! Your checkout should work.\n";
    echo "\n";
    echo "Next steps:\n";
    echo "1. Make sure you're logged in on the website\n";
    echo "2. Add items to your cart\n";
    echo "3. Click 'Proceed to Checkout'\n";
    echo "4. If email is configured, check your inbox\n";
    echo "\n";
    echo "If checkout still fails, check:\n";
    echo "- Browser console for JavaScript errors\n";
    echo "- storage/logs/laravel.log for detailed errors\n";
    echo "- Network tab to see the exact error response\n";
} else {
    echo "\n";
    echo "❌ Some issues were found. Please fix them:\n";
    echo "\n";
    echo "Common fixes:\n";
    echo "- Run: php artisan migrate (if tables are missing)\n";
    echo "- Configure email in .env (see EMAIL_ENV_CONFIG.txt)\n";
    echo "- Check database connection in .env\n";
    echo "- Run: php artisan config:clear && php artisan cache:clear\n";
}

echo "\n";
echo "═══════════════════════════════════════════════════\n";
echo "\n";

