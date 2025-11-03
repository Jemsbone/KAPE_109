# Email Verification Setup Guide for Kape Na!

## Overview
This guide explains the email verification system that has been implemented for user registration in the Kape Na! application.

## What Was Implemented

### 1. **User Model Configuration**
- The `User` model implements `MustVerifyEmail` interface
- Custom email verification notification with branded messaging
- Email verification method override for custom notification

### 2. **Authentication Controller Updates**
- **Registration**: Sends verification email instead of auto-login after registration
- **Login**: Checks if email is verified before allowing access
- **Verification Notice**: Shows a page asking users to verify their email
- **Resend Verification**: Allows users to request a new verification email

### 3. **Email Verification Routes**
```php
// Verification notice page (shown to unverified users)
GET /email/verify

// Verification link handler (clicked from email)
GET /email/verify/{id}/{hash}

// Resend verification email
POST /email/verification-notification
```

### 4. **Protected Routes**
All customer-facing routes now require both authentication AND email verification:
- `/customer/home` - Customer homepage
- `/menu` - Menu page
- `/cart` - Shopping cart
- `/checkout/process` - Checkout processing
- `/orders` - Orders page
- All cart operations (add, remove, update)

### 5. **Custom Email Notification**
- Located at: `app/Notifications/VerifyEmailNotification.php`
- Branded with Kape Na! styling and coffee emojis ☕
- 60-minute expiration for verification links
- Queued for better performance

### 6. **Verification Notice Page**
- Beautiful UI matching the registration page design
- Shows user's email address
- Provides "Resend Verification Email" button
- Auto-hides success messages after 5 seconds
- Includes logout option

## User Flow

### Registration Flow
1. User fills out registration form
2. User submits the form
3. System creates the user account
4. **Verification email is sent automatically**
5. User is logged in but redirected to verification notice page
6. User must verify email before accessing protected pages

### Login Flow
1. User enters credentials
2. System checks credentials
3. If valid but email not verified:
   - Redirect to verification notice page
4. If valid and email verified:
   - Allow access to the application

### Email Verification Flow
1. User receives email with verification link
2. User clicks the verification link
3. System verifies the token (valid for 60 minutes)
4. Email is marked as verified
5. User is redirected to customer home with success message

## Configuration

### Email Verification Timeout
You can configure the verification link expiration time in `.env`:

```env
# Email verification link expiration (in minutes, default: 60)
AUTH_VERIFICATION_EXPIRE=60
```

Or edit `config/auth.php`:
```php
'verification' => [
    'expire' => env('AUTH_VERIFICATION_EXPIRE', 60),
],
```

### Email Configuration
Make sure your `.env` file has valid email settings:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Kape Na!"
```

## Testing the System

### 1. Test with Mailtrap (Recommended for Development)
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=noreply@kapena.com
MAIL_FROM_NAME="Kape Na!"
```

### 2. Test with Gmail
1. Enable 2-Factor Authentication on your Google account
2. Generate an App Password: https://myaccount.google.com/apppasswords
3. Use the app password in `.env` (not your regular password)

### 3. Test with Log Driver (Quick Testing)
For quick testing without sending real emails:
```env
MAIL_MAILER=log
```
Check verification emails in `storage/logs/laravel.log`

## Manual Testing Steps

### Test 1: New User Registration
1. Navigate to `/register`
2. Fill out the registration form
3. Submit the form
4. ✅ Should see verification notice page
5. ✅ Should receive verification email
6. ✅ Click the link in email
7. ✅ Should be redirected to customer home
8. ✅ Email should be marked as verified

### Test 2: Unverified User Login
1. Register a new user (don't verify email)
2. Logout
3. Login with the unverified account
4. ✅ Should be redirected to verification notice page
5. ✅ Should not access protected pages

### Test 3: Resend Verification Email
1. Go to verification notice page
2. Click "Resend Verification Email"
3. ✅ Should see success message
4. ✅ Should receive a new verification email

### Test 4: Expired Verification Link
1. Wait 60+ minutes after registration (or modify the expire time for testing)
2. Try to click the verification link
3. ✅ Should show error (link expired)
4. ✅ User can request new verification email

### Test 5: Already Verified User
1. Verify email
2. Try to access `/email/verify` again
3. ✅ Should redirect to customer home

## Troubleshooting

### Emails Not Sending
1. Check `.env` email configuration
2. Verify credentials are correct
3. For Gmail: Use App Password, not regular password
4. Check `storage/logs/laravel.log` for errors
5. Run: `php artisan config:clear`

### Verification Link Not Working
1. Check if link has expired (default: 60 minutes)
2. Ensure the link wasn't broken by email client
3. Request a new verification email
4. Check if user is already verified in database

### Can't Access Protected Routes
1. Ensure you're logged in
2. Verify email is verified (check `email_verified_at` in database)
3. Clear cache: `php artisan cache:clear`
4. Clear config: `php artisan config:clear`

### Database Check
To manually verify a user's email (for testing):
```sql
UPDATE users 
SET email_verified_at = NOW() 
WHERE email = 'user@example.com';
```

## Files Modified/Created

### Modified Files:
1. `app/Http/Controllers/AuthController.php` - Added verification logic
2. `app/Models/User.php` - Custom verification notification
3. `routes/web.php` - Added verification routes and middleware
4. `config/auth.php` - Added verification configuration
5. `resources/views/Auth/Register.blade.php` - Added verification notice

### New Files:
1. `app/Notifications/VerifyEmailNotification.php` - Custom email notification
2. `resources/views/auth/verify-email.blade.php` - Verification notice page
3. `EMAIL_VERIFICATION_SETUP.md` - This documentation

## Queue Configuration (Optional but Recommended)

For better performance, set up queues to send emails asynchronously:

1. Set queue driver in `.env`:
```env
QUEUE_CONNECTION=database
```

2. Run migrations:
```bash
php artisan queue:table
php artisan migrate
```

3. Start queue worker:
```bash
php artisan queue:work
```

## Security Features

1. **Signed URLs**: Verification links are cryptographically signed
2. **Time Expiration**: Links expire after 60 minutes
3. **Rate Limiting**: Resend verification is throttled (6 attempts per minute)
4. **Middleware Protection**: All sensitive routes require verified email
5. **Hash Verification**: Email hash is checked to prevent tampering

## Customization

### Customize Email Content
Edit `app/Notifications/VerifyEmailNotification.php`:
```php
public function toMail(object $notifiable): MailMessage
{
    return (new MailMessage)
        ->subject('Your Custom Subject')
        ->greeting('Your Custom Greeting')
        ->line('Your custom message...')
        // ... more customizations
}
```

### Customize Verification Page
Edit `resources/views/auth/verify-email.blade.php` to match your design.

### Change Expiration Time
Edit `.env`:
```env
AUTH_VERIFICATION_EXPIRE=120  # 2 hours
```

## Support

If you encounter any issues:
1. Check the troubleshooting section above
2. Review the Laravel logs: `storage/logs/laravel.log`
3. Ensure all migrations are run: `php artisan migrate`
4. Clear all caches: `php artisan optimize:clear`

## Next Steps

1. ✅ Test the registration flow
2. ✅ Configure email settings
3. ✅ Test email delivery
4. ✅ Test verification process
5. ✅ Deploy to production

---

**Note**: This system is production-ready and follows Laravel best practices for email verification. Make sure to properly configure your email service before deploying to production.

