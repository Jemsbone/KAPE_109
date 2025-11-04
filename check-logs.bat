@echo off
echo ========================================
echo   ADMIN OTP LOGS VIEWER
echo ========================================
echo.
echo This will show you:
echo - OTP codes generated
echo - Email sending status
echo - Any errors that occurred
echo.
echo Press Ctrl+C to stop watching logs
echo ========================================
echo.

cd storage\logs
if exist laravel.log (
    echo Latest logs:
    echo.
    powershell -Command "Get-Content laravel.log -Tail 50 | Select-String -Pattern 'admin|OTP|otp' -Context 2,2"
    echo.
    echo.
    echo Watching for new logs... (Press Ctrl+C to stop)
    powershell -Command "Get-Content laravel.log -Wait -Tail 10"
) else (
    echo No log file found yet. Try registering first!
)

pause

