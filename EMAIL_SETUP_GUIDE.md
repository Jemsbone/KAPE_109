# 📧 Email Setup Guide for Kape Na! Order Receipts

## Overview
This guide will help you configure email functionality so customers receive beautiful order receipt emails when they complete checkout.

---

## 🔧 Setup Instructions

### Step 1: Configure Your Gmail Account

Since you're using **berderajembo99@gmail.com**, follow these steps:

#### A. Enable 2-Factor Authentication (2FA)
1. Go to your Google Account: https://myaccount.google.com/
2. Navigate to **Security** → **2-Step Verification**
3. Follow the prompts to enable 2FA

#### B. Generate App Password
1. Go to: https://myaccount.google.com/apppasswords
2. Select **Mail** as the app
3. Select **Windows Computer** (or your device)
4. Click **Generate**
5. **SAVE THE 16-CHARACTER PASSWORD** (you'll need it in Step 2)

---

### Step 2: Update Your `.env` File

Open your `.env` file in the root directory and add/update these settings:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=berderajembo99@gmail.com
MAIL_PASSWORD=your-16-character-app-password-here
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=berderajembo99@gmail.com
MAIL_FROM_NAME="Kape Na!"
```

**Important Notes:**
- Replace `your-16-character-app-password-here` with the actual app password from Step 1B
- The app password has NO SPACES (just 16 characters)
- DO NOT use your regular Gmail password
- Keep your `.env` file secure and never commit it to version control

---

### Step 3: Clear Laravel Cache

Run these commands in your terminal:

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

---

### Step 4: Test the Email Functionality

#### Option A: Test with Real Order
1. Start your Laravel server: `php artisan serve`
2. Go to your website and log in
3. Add items to your cart
4. Click "Proceed to Checkout"
5. Check the email inbox at **berderajembo99@gmail.com**

#### Option B: Test with Artisan Tinker
```bash
php artisan tinker
```

Then run:
```php
Mail::raw('Test email from Kape Na!', function ($message) {
    $message->to('berderajembo99@gmail.com')
            ->subject('Test Email');
});
```

Check your inbox for the test email.

---

## 🎨 Email Template Features

Your enhanced email template includes:

### ✨ Visual Enhancements
- **Modern Design**: Gradient backgrounds and rounded corners
- **Branded Colors**: Uses your Kape Na! color scheme (#d3ad7f, #222)
- **Animated Coffee Icon**: Subtle animation for visual appeal
- **Responsive Layout**: Works perfectly on mobile and desktop

### 📋 Content Sections
1. **Success Banner**: Immediate order confirmation
2. **Order Information Card**: Order number, date, customer details
3. **Order Details**: Itemized list with quantities and prices
4. **Order Summary**: Subtotal, fees, tax, and total
5. **Next Steps**: What to expect after ordering
6. **Contact Information**: Your email, phone, location, and hours
7. **Social Links**: Facebook, Instagram, LinkedIn

### 📱 Mobile Responsive
- Automatically adapts to smaller screens
- Easy to read on all devices
- Touch-friendly buttons and links

---

## 🔍 Troubleshooting

### Problem: Emails not sending
**Solutions:**
1. Verify your app password is correct (no spaces, 16 characters)
2. Make sure 2FA is enabled on your Google account
3. Check Laravel logs: `storage/logs/laravel.log`
4. Run: `php artisan config:clear && php artisan cache:clear`

### Problem: "Authentication failed" error
**Solutions:**
1. Generate a new app password
2. Make sure you're using the app password, NOT your regular password
3. Check that MAIL_USERNAME matches your Gmail address exactly

### Problem: Emails going to spam
**Solutions:**
1. Check spam folder and mark as "Not Spam"
2. Add berderajembo99@gmail.com to your contacts
3. Gmail may initially flag emails from your own domain

### Problem: Email looks broken
**Solutions:**
1. Some email clients may not support all CSS
2. The template is optimized for Gmail, Outlook, and Apple Mail
3. Try opening in a different email client

---

## 📝 Email Content Customization

### To Change Email Content
Edit: `resources/views/emails/order-summary.blade.php`

### To Change Sender Name
Update in `.env`:
```env
MAIL_FROM_NAME="Your Custom Name"
```

### To Add Logo
Add an image URL in the email template header section.

---

## 🔐 Security Best Practices

1. ✅ **Never commit `.env` file** to Git
2. ✅ **Use app passwords** instead of regular passwords
3. ✅ **Keep `.env.example`** as a template (without real credentials)
4. ✅ **Rotate app passwords** periodically
5. ✅ **Monitor email sending** for unusual activity

---

## 📊 What Happens During Checkout

```
User clicks "Proceed to Checkout"
    ↓
JavaScript sends order data to server
    ↓
CheckoutController validates data
    ↓
Order saved to database
    ↓
Email sent to customer (berderajembo99@gmail.com)
    ↓
Success message shown to user
    ↓
Cart cleared
```

---

## 🚀 Alternative Email Providers

### For Development/Testing: Mailtrap
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
```

### For Testing Without Sending: Log Driver
```env
MAIL_MAILER=log
```
(Emails will be written to `storage/logs/laravel.log` instead of being sent)

---

## 📞 Support

If you encounter issues:
1. Check the Laravel logs: `storage/logs/laravel.log`
2. Review this guide carefully
3. Test with a simple email first (using Tinker)
4. Verify all environment variables are set correctly

---

## ✅ Checklist

Before going live, ensure:
- [ ] 2FA enabled on Gmail account
- [ ] App password generated
- [ ] `.env` file updated with correct credentials
- [ ] Laravel cache cleared
- [ ] Test email sent successfully
- [ ] Email appears correctly in inbox
- [ ] Email design looks good on mobile
- [ ] Order data displays correctly

---

**Last Updated:** {{ date('Y-m-d') }}

**Email Provider:** Gmail (berderajembo99@gmail.com)

**Status:** ✅ Ready to use after configuration

