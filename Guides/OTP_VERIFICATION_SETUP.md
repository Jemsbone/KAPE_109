# OTP Email Verification Setup Guide for Kape Na! ☕

## Overview
This guide explains the OTP (One-Time Password) email verification system implemented for user registration in the Kape Na! application. Users receive a 6-digit code via email instead of clicking verification links.

## What Was Implemented

### 1. **Database Structure**
- Added `otp_code` column (6-digit string) to users table
- Added `otp_expires_at` column (timestamp) to users table
- OTP codes expire after 10 minutes

### 2. **User Model Features**
- `generateOtpCode()` - Generates random 6-digit OTP and stores it
- `verifyOtpCode($code)` - Validates OTP code and verifies email
- `clearOtpCode()` - Clears OTP after successful verification
- Custom email verification notification with OTP code

### 3. **Authentication Controller**
- **Registration**: Sends OTP email after registration
- **Login**: Checks if email is verified before allowing access
- **Verification Page**: Shows OTP input form
- **OTP Verification**: Validates and verifies OTP code
- **Resend OTP**: Generates and sends new OTP code

### 4. **Email Verification Routes**
```php
// Verification page with OTP input form
GET /email/verify

// Verify OTP code (submit form)
POST /email/verify-otp

// Resend new OTP code
POST /email/verification-notification
```

### 5. **Protected Routes**
All customer-facing routes require both authentication AND email verification:
- `/customer/home` - Customer homepage
- `/menu` - Menu page
- `/cart` - Shopping cart
- `/checkout/process` - Checkout processing
- `/orders` - Orders page
- All cart operations (add, remove, update)

### 6. **OTP Email Notification**
- Located at: `app/Notifications/OtpVerificationNotification.php`
- Branded with Kape Na! styling and coffee emojis ☕
- 10-minute expiration for OTP codes
- Clear display of 6-digit code in email

### 7. **Verification Page Features**
- Beautiful UI matching the registration page design
- Large OTP input field with numeric keyboard on mobile
- Auto-focus on OTP input
- Auto-submit when 6 digits are entered
- Paste support for OTP codes
- Only accepts numeric input
- Shows expiration time (10 minutes)
- Resend OTP button
- Error messages for invalid/expired codes

## User Flow

### Registration Flow
1. User fills out registration form
2. User submits the form
3. System creates the user account
4. System generates 6-digit OTP code
5. System sends email with OTP code
6. User is logged in and redirected to verification page
7. User enters OTP code from email
8. System validates OTP code
9. If valid, email is marked as verified
10. User is redirected to customer home page

### Login Flow (Unverified Email)
1. User attempts to login
2. Credentials are validated
3. System checks email verification status
4. If not verified, user is redirected to verification page
5. User can request new OTP code
6. User enters OTP code to verify
7. After verification, user can access all features

### OTP Verification
1. User receives email with 6-digit code
2. User opens verification page
3. User enters the 6-digit code
4. Code is automatically submitted when 6 digits are entered
5. System validates code (checks expiration and correctness)
6. If valid, email is verified and user redirected to home
7. If invalid/expired, error message is shown
8. User can request new code if needed

## Email Configuration

### Quick Setup

#### Option A: Use Mailtrap (Best for Testing)
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@kapena.com
MAIL_FROM_NAME="Kape Na!"
```

#### Option B: Use Gmail (For Real Emails)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-char-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Kape Na!"
```

**Important for Gmail**: 
1. Enable 2-Factor Authentication
2. Create App Password: https://myaccount.google.com/apppasswords
3. Use the 16-character app password (not your regular password)

#### Option C: Log Emails (Quick Testing)
```env
MAIL_MAILER=log
```
Emails will be saved to `storage/logs/laravel.log`

### Apply Configuration
```bash
php artisan config:clear
php artisan cache:clear
```

## Testing the System

### Test Registration
1. Go to `/register`
2. Fill in registration details
3. Submit the form
4. Check your email for OTP code
5. Enter the 6-digit code on verification page
6. Should redirect to customer home

### Test Resend OTP
1. On verification page, click "Resend Code"
2. Check email for new OTP code
3. Old code should be replaced

### Test Expired OTP
1. Wait 10+ minutes after receiving OTP
2. Try to enter the code
3. Should show "expired" error message
4. Request new code to continue

### Test Invalid OTP
1. Enter incorrect 6-digit code
2. Should show "invalid" error message
3. Can try again with correct code

## Security Features

### Throttling
- OTP verification: Limited to 5 attempts per minute
- Resend OTP: Limited to 3 requests per minute
- Prevents brute force attacks

### Expiration
- OTP codes expire after 10 minutes
- Old codes are cleared after verification
- Cannot reuse old codes

### Validation
- Only 6-digit numeric codes accepted
- Codes are hashed in database
- Input sanitization on frontend and backend

## Benefits of OTP System

### User Experience
✅ No need to check email and click links
✅ Faster verification process
✅ Easy to copy-paste codes
✅ Works well on mobile devices
✅ Auto-submit for convenience

### Security
✅ Time-limited codes
✅ One-time use only
✅ Throttling prevents abuse
✅ Can't be reused after verification

### Development
✅ Easier to test (no clicking email links)
✅ Simpler implementation
✅ Better for mobile apps
✅ Copy OTP directly from email/log

## Troubleshooting

### OTP Email Not Received
1. Check spam/junk folder
2. Verify email configuration in `.env`
3. Check `storage/logs/laravel.log` if using log mailer
4. Use "Resend Code" button

### Invalid OTP Error
1. Check if code has expired (10 minutes)
2. Ensure you copied all 6 digits
3. Request new code if needed
4. Check for typos

### Email Already Verified
1. If you see this message, verification is complete
2. Try logging in again
3. Should redirect to customer home

### Cannot Resend Code
1. Wait 1 minute (throttling limit)
2. Check email - previous code may still be valid
3. Clear browser cache if needed

## Code Examples

### Generate OTP
```php
$user = User::find(1);
$otpCode = $user->generateOtpCode();
// Returns: "123456" (6-digit string)
```

### Verify OTP
```php
$user = User::find(1);
if ($user->verifyOtpCode('123456')) {
    // Email verified successfully!
} else {
    // Invalid or expired code
}
```

### Send OTP Email
```php
$user = User::find(1);
$user->sendEmailVerificationNotification();
// Generates OTP and sends email
```

## Files Modified/Created

### New Files
- `database/migrations/2025_11_03_045219_add_otp_fields_to_users_table.php`
- `app/Notifications/OtpVerificationNotification.php`
- `Guides/OTP_VERIFICATION_SETUP.md`

### Modified Files
- `app/Models/User.php` - Added OTP methods
- `app/Http/Controllers/AuthController.php` - Added OTP verification
- `routes/web.php` - Updated verification routes
- `resources/views/auth/verify-email.blade.php` - Added OTP input form

## Next Steps

1. ✅ Configure email in `.env` file
2. ✅ Clear configuration cache
3. ✅ Test registration with real email
4. ✅ Test OTP verification
5. ✅ Test resend functionality

## Support

If you need help:
- Check this guide thoroughly
- Review error messages carefully
- Check Laravel logs: `storage/logs/laravel.log`
- Verify email configuration
- Test with Mailtrap first before using real email

---

**Created**: November 3, 2025  
**Version**: 1.0  
**System**: OTP Email Verification  
**Expiration**: 10 minutes

