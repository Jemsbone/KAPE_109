@echo off
echo ========================================
echo    KAPE NA! EMAIL CONFIGURATION
echo ========================================
echo.
echo Setting up Gmail SMTP configuration...
echo.

REM Clear Laravel config cache
echo [1/3] Clearing configuration cache...
php artisan config:clear
if %errorlevel% neq 0 (
    echo ERROR: Failed to clear config cache
    pause
    exit /b 1
)
echo ✓ Config cache cleared
echo.

REM Clear application cache
echo [2/3] Clearing application cache...
php artisan cache:clear
if %errorlevel% neq 0 (
    echo WARNING: Cache clear failed, continuing...
)
echo ✓ Application cache cleared
echo.

REM Test email configuration
echo [3/3] Testing email configuration...
echo.
php artisan tinker --execute="echo 'Mail Mailer: ' . config('mail.default'); echo PHP_EOL; echo 'Mail From: ' . config('mail.from.address'); echo PHP_EOL; echo 'Mail Host: ' . config('mail.mailers.smtp.host'); echo PHP_EOL;"
echo.

echo ========================================
echo Configuration complete!
echo ========================================
echo.
echo Next steps:
echo 1. Go back to your verification page
echo 2. Click "Resend Verification Email"
echo 3. Check your inbox at: berderajembo99@gmail.com
echo 4. Check spam folder if not in inbox
echo.
echo To test email manually, run:
echo   php test-email.php
echo.
pause

