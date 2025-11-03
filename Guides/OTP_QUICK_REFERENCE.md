# OTP Verification - Quick Reference ☕

## 🚀 Quick Start

### 1. Configure Email (Choose One)

**Gmail:**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-16-char-app-password
MAIL_ENCRYPTION=tls
```

**Mailtrap (Testing):**
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
```

**Log (Local Testing):**
```env
MAIL_MAILER=log
```

### 2. Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
```

### 3. Test
1. Register at `/register`
2. Check email for 6-digit code
3. Enter code on verification page
4. Auto-submits when 6 digits entered ✨

## 📋 Key Features

| Feature | Details |
|---------|---------|
| **Code Length** | 6 digits (000000 - 999999) |
| **Expiration** | 10 minutes |
| **Auto-Submit** | Yes, when 6 digits entered |
| **Resend Limit** | 3 per minute |
| **Verify Limit** | 5 per minute |
| **Mobile Friendly** | Numeric keyboard auto-shows |

## 🔧 Common Tasks

### Generate OTP for User
```php
$user->generateOtpCode(); // Returns: "123456"
```

### Verify OTP
```php
if ($user->verifyOtpCode('123456')) {
    // Success!
}
```

### Send OTP Email
```php
$user->sendEmailVerificationNotification();
```

## 📍 Routes

| Route | Method | Purpose |
|-------|--------|---------|
| `/email/verify` | GET | Show OTP input form |
| `/email/verify-otp` | POST | Submit and verify OTP |
| `/email/verification-notification` | POST | Resend new OTP |

## 🐛 Troubleshooting

| Problem | Solution |
|---------|----------|
| No email received | Check spam folder, verify `.env` config |
| Invalid OTP error | Check if expired (10 min), request new code |
| Can't resend | Wait 1 minute (throttle limit) |
| Code not working | Ensure all 6 digits are correct, no spaces |

## 📧 Email Log Location

If using `MAIL_MAILER=log`:
```
storage/logs/laravel.log
```

Search for "Your verification code is" to find the OTP.

## ✅ Testing Checklist

- [ ] Email configuration in `.env` is correct
- [ ] Can register new user
- [ ] Receive OTP email (within 1 minute)
- [ ] Can enter OTP code
- [ ] Auto-submits when 6 digits entered
- [ ] Shows error for wrong code
- [ ] Shows error for expired code (>10 min)
- [ ] Can resend new OTP
- [ ] Can verify email successfully
- [ ] Redirects to customer home after verification
- [ ] Cannot access protected routes without verification

## 📂 Modified Files

### Core Files
- `app/Models/User.php` - OTP methods
- `app/Http/Controllers/AuthController.php` - OTP verification
- `app/Notifications/OtpVerificationNotification.php` - Email notification
- `routes/web.php` - Updated routes
- `resources/views/auth/verify-email.blade.php` - OTP input form

### Database
- `database/migrations/2025_11_03_045219_add_otp_fields_to_users_table.php`

### Documentation
- `Guides/OTP_VERIFICATION_SETUP.md` - Complete guide
- `Guides/OTP_QUICK_REFERENCE.md` - This file
- `Guides/README.md` - Updated index

## 💡 Pro Tips

1. **Test with log mailer first** - Easier to debug
2. **Use Mailtrap for staging** - Safe testing environment
3. **Gmail needs App Password** - Not regular password
4. **OTP in logs** - Search for the 6-digit code
5. **Mobile users** - Numeric keyboard shows automatically
6. **Copy-paste** - OTP can be pasted directly
7. **Auto-submit** - No need to click button

## 🎯 User Experience

### What Users See

1. **Registration** → Success message + redirected to verify page
2. **Email** → "Your verification code is: **123456**"
3. **Verify Page** → Large input field, auto-focused
4. **Enter Code** → Auto-submits at 6 digits
5. **Success** → Redirected to home page

### UX Features

✨ Auto-focus on input field  
✨ Only accepts numbers  
✨ Auto-submit when complete  
✨ Paste support  
✨ Mobile numeric keyboard  
✨ Clear error messages  
✨ Resend button visible  
✨ Expiration timer shown

---

**Need More Details?** See [OTP_VERIFICATION_SETUP.md](OTP_VERIFICATION_SETUP.md)

