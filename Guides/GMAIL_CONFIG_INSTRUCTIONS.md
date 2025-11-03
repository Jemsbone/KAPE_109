# Gmail SMTP Configuration for Kape Na! ☕

## Your Configuration

You want to use: **berderajembo99@gmail.com** to send verification emails.

## Step-by-Step Setup

### Step 1: Update Your .env File

Open the `.env` file in the root of your project and add/update these lines:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=berderajembo99@gmail.com
MAIL_PASSWORD=pxowhbnjaurxruwd
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=berderajembo99@gmail.com
MAIL_FROM_NAME="Kape Na!"
```

**Important Notes:**
- Make sure there are NO SPACES around the `=` sign
- Don't add extra quotes unless shown
- Save the file after editing

### Step 2: Clear Laravel Cache

Run this command in your terminal:

```bash
php artisan config:clear
```

Or simply double-click: **`setup-email-config.bat`**

### Step 3: Test Email Configuration

Run the test script:

```bash
php test-email.php
```

When prompted, enter: **magbanuajembo17@gmail.com** (your test email)

### Step 4: Resend Verification Email

1. Go back to your verification page (the one showing "VERIFY YOUR EMAIL")
2. Click the **"Resend Verification Email"** button
3. Check your inbox at **magbanuajembo17@gmail.com**
4. **Check spam folder** if not in inbox
5. Click the verification link

## Quick Commands

```bash
# Clear config
php artisan config:clear

# Test email
php test-email.php

# Check current mail config
php artisan tinker
config('mail.default')
exit
```

## Troubleshooting

### Email Still Not Sending?

1. **Check .env file was saved properly**
   - Open `.env` and verify the MAIL_ settings are there
   - Make sure no extra spaces or quotes

2. **Clear ALL caches:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   php artisan view:clear
   ```

3. **Check logs for errors:**
   - Open: `storage/logs/laravel.log`
   - Look for any error messages

4. **Verify Gmail App Password:**
   - Make sure you're using an App Password (not regular password)
   - App Password should be 16 characters
   - No spaces in the password

### Common Gmail Errors

**"Authentication failed"**
- Verify the app password is correct: `pxowhbnjaurxruwd`
- Make sure 2FA is enabled on your Gmail account
- Generate a new App Password if needed

**"Connection refused"**
- Check your internet connection
- Verify MAIL_PORT is 587
- Make sure firewall isn't blocking SMTP

**Email goes to spam**
- This is normal for the first few emails
- Check spam folder
- Mark as "Not Spam" to train Gmail

## Testing

### Test 1: Send Test Email
```bash
php test-email.php
```
Enter: **magbanuajembo17@gmail.com**

### Test 2: Resend Verification
1. Go to verification page
2. Click "Resend Verification Email"
3. Should see success message
4. Check email inbox

### Test 3: Manual Test
```bash
php artisan tinker
```
Then run:
```php
Mail::raw('Test from Kape Na!', function($msg) {
    $msg->to('magbanuajembo17@gmail.com')
        ->subject('Test Email');
});
exit
```

## What Your .env Should Look Like

Here's the complete mail section of your `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=berderajembo99@gmail.com
MAIL_PASSWORD=pxowhbnjaurxruwd
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=berderajembo99@gmail.com
MAIL_FROM_NAME="Kape Na!"
```

## Security Note

⚠️ **IMPORTANT**: 
- The password `pxowhbnjaurxruwd` appears to be a Gmail App Password
- Keep your `.env` file secure and never commit it to Git
- The `.env` file should be in `.gitignore`

## Expected Result

When configured correctly:

1. ✅ User registers on your site
2. ✅ Verification email sent from **berderajembo99@gmail.com**
3. ✅ Email arrives at **magbanuajembo17@gmail.com**
4. ✅ User clicks verification link
5. ✅ User is verified and redirected to home page

## Need Help?

If you're still having issues:

1. Run: `setup-email-config.bat`
2. Check: `storage/logs/laravel.log`
3. Verify .env file is saved properly
4. Try test script: `php test-email.php`

---

**Ready to test?**

1. Save your `.env` file with the configuration above
2. Run: `php artisan config:clear`
3. Go to verification page
4. Click "Resend Verification Email"
5. Check your email! ☕

