# Quick Email Verification Guide - Kape Na! ☕

## ✅ What's Been Implemented

Your registration now requires **OTP email verification** before users can access the application!

> **NEW**: We now use OTP (One-Time Password) codes instead of verification links. Users receive a 6-digit code via email that expires in 10 minutes.

## 🚀 Quick Setup (3 Steps)

### Step 1: Configure Email in `.env`

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

#### Option C: Just Log Emails (Quick Testing)
```env
MAIL_MAILER=log
```
Emails will be saved to `storage/logs/laravel.log`

### Step 2: Clear Configuration Cache
```bash
php artisan config:clear
php artisan cache:clear
```

### Step 3: Test It!
1. Go to `/register`
2. Register a new account
3. Check your email (or log file) for 6-digit OTP code
4. Enter the code on the verification page
5. Done! ✅ (Code auto-submits when you enter 6 digits)

## 📧 How It Works

### For New Users:
1. **Register** → User fills registration form
2. **OTP Sent** → 6-digit code sent to email automatically
3. **Verify Page** → User sees OTP input form
4. **Enter Code** → User enters the 6-digit code
5. **Auto-Submit** → Code is submitted automatically
6. **Verified!** → User can now access all features

### For Existing Unverified Users:
- Can't access protected pages
- Redirected to OTP verification page
- Can resend OTP code (new code expires in 10 minutes)
- Must verify to continue

## 🎨 What Changed

### Protected Routes (Now Require Verified Email):
- `/customer/home` - Customer homepage
- `/menu` - Menu browsing
- `/cart` - Shopping cart
- `/checkout/process` - Checkout
- `/orders` - Order history
- All cart operations

### New Routes:
- `/email/verify` - Verification notice page
- `/email/verify/{id}/{hash}` - Verification link handler
- `POST /email/verification-notification` - Resend verification

### New Pages:
- Beautiful verification notice page matching your design
- Info box showing user's email
- Resend button with throttling
- Automatic success message dismissal

## ⚡ Quick Testing Commands

### Test with Log Driver (No Email Service Needed):
```bash
# 1. Set MAIL_MAILER=log in .env
# 2. Clear config
php artisan config:clear
# 3. Register a user
# 4. Check the email in logs:
tail -f storage/logs/laravel.log
```

### Manually Verify a User (For Testing):
```sql
UPDATE users 
SET email_verified_at = NOW() 
WHERE email = 'test@example.com';
```

### Check if Email Was Sent:
```bash
# If using log driver
cat storage/logs/laravel.log | grep "Verify Your Email"
```

## 🔒 Security Features

✅ **Signed URLs** - Links are cryptographically signed  
✅ **Time Expiration** - Links expire after 60 minutes  
✅ **Rate Limiting** - Max 6 resend attempts per minute  
✅ **Middleware Protection** - All routes verified  
✅ **Hash Verification** - Prevents link tampering  

## 🎨 Customization

### Change Expiration Time
Add to `.env`:
```env
# Minutes until verification link expires (default: 60)
AUTH_VERIFICATION_EXPIRE=120
```

### Customize Email Message
Edit: `app/Notifications/VerifyEmailNotification.php`

### Customize Verification Page
Edit: `resources/views/auth/verify-email.blade.php`

## 🐛 Troubleshooting

### Emails Not Sending?
```bash
# 1. Check email config
php artisan config:clear

# 2. Check logs
tail -f storage/logs/laravel.log

# 3. Test email config
php artisan tinker
>>> Mail::raw('Test email', function($message) { 
    $message->to('test@example.com')->subject('Test'); 
});
```

### Can't Access After Verification?
```bash
# Clear all caches
php artisan optimize:clear

# Or individually:
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Verification Link Not Working?
- Check if link expired (60 minutes)
- Ensure full URL is copied (not broken by email client)
- Request new verification email
- Check user is logged in

## 📝 Database Check

```sql
-- Check user verification status
SELECT user_id, name, email, email_verified_at 
FROM users 
WHERE email = 'user@example.com';

-- Manually verify (for testing only)
UPDATE users 
SET email_verified_at = NOW() 
WHERE email = 'user@example.com';

-- Check unverified users
SELECT user_id, name, email, created_at 
FROM users 
WHERE email_verified_at IS NULL;
```

## 📧 Email Preview

Your verification email includes:
- ☕ Kape Na! branding
- Welcome message for new users
- Clear "Verify Email Address" button
- Expiration notice (60 minutes)
- Security disclaimer
- Coffee-themed sign-off

## 🚀 Production Checklist

Before deploying:
- [ ] Configure production email service
- [ ] Test email delivery
- [ ] Set proper `MAIL_FROM_ADDRESS`
- [ ] Set proper `MAIL_FROM_NAME`
- [ ] Consider using queues for better performance
- [ ] Test verification flow end-to-end
- [ ] Check spam folder delivery

## 📚 More Information

For detailed documentation, see: `EMAIL_VERIFICATION_SETUP.md`

---

**Quick Start**: Just set `MAIL_MAILER=log` in `.env`, run `php artisan config:clear`, and test! ✅

