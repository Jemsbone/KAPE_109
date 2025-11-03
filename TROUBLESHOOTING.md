# 🔧 Troubleshooting Guide - Checkout Issues

## Quick Fix for "Failed to process order" Error

The error you're seeing is likely due to one of these issues. Let's fix them step by step:

---

## 🚀 Quick Diagnostic Steps

### Step 1: Run the Debug Script

```bash
php debug-checkout.php
```

This will check:
- ✅ Database connection
- ✅ Required tables
- ✅ Email configuration
- ✅ Routes
- ✅ Order creation

### Step 2: Clear Laravel Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 3: Check Laravel Logs

Open: `storage/logs/laravel.log`

Look for the most recent error. The error will show you exactly what's wrong.

---

## 🔍 Common Issues and Solutions

### Issue 1: Email Not Configured ⚠️

**Error message:**
- "Failed to process order"
- Email-related errors in logs

**Solution:**

The checkout will now work **even without email configured**. Just try the checkout again after updating the controller.

If you want emails to work:
1. Follow the steps in `EMAIL_ENV_CONFIG.txt`
2. Configure Gmail app password
3. Update your `.env` file
4. Run: `php artisan config:clear`

---

### Issue 2: Database Connection Failed ❌

**Error message:**
- "SQLSTATE[HY000]"
- "Access denied for user"
- "Connection refused"

**Solution:**

Check your `.env` file:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

Then run:
```bash
php artisan config:clear
php artisan migrate
```

---

### Issue 3: Orders Table Missing ❌

**Error message:**
- "Table 'orders' doesn't exist"
- "SQLSTATE[42S02]"

**Solution:**

Run migrations:
```bash
php artisan migrate
```

If that fails, check if migration files exist:
- `database/migrations/*_orders_table.php`

---

### Issue 4: User Not Authenticated 🔐

**Error message:**
- "User not authenticated"
- "Unauthenticated"

**Solution:**

Make sure you're logged in:
1. Go to your website
2. Click "Login" or "Register"
3. Log in with valid credentials
4. Try checkout again

---

### Issue 5: Cart Data Invalid ❌

**Error message:**
- "Invalid order data"
- "Validation failed"

**Solution:**

Your cart might have invalid data. Try:
1. Clear your browser's localStorage
2. Refresh the page
3. Add items to cart again
4. Try checkout

To clear localStorage:
- Open browser console (F12)
- Run: `localStorage.clear()`
- Refresh page

---

### Issue 6: CSRF Token Mismatch 🔒

**Error message:**
- "419 | Page Expired"
- "CSRF token mismatch"

**Solution:**

```bash
php artisan cache:clear
php artisan config:clear
```

Then refresh your browser page.

---

## 📋 Step-by-Step Debugging Process

### 1. Check the Browser Console

Open Developer Tools (F12) → Console tab

Look for JavaScript errors. Common errors:
- Network errors (404, 500, 419)
- CORS errors
- Authentication errors

### 2. Check Network Tab

Developer Tools (F12) → Network tab

1. Click "Proceed to Checkout"
2. Look for the `checkout/process` request
3. Check the response

**If 500 Error:**
- Check `storage/logs/laravel.log`

**If 419 Error:**
- CSRF token issue - clear cache and refresh

**If 401/403 Error:**
- Authentication issue - log in again

### 3. Check Laravel Logs

File: `storage/logs/laravel.log`

Look for the most recent error entries. The log will show:
- The exact error message
- File and line number
- Stack trace

### 4. Test Database Connection

```bash
php artisan tinker
```

Then run:
```php
DB::connection()->getPdo();
echo "Database connected!";
```

### 5. Test Order Creation

```bash
php debug-checkout.php
```

This will attempt to create a test order and show you if it works.

---

## 🛠️ Advanced Troubleshooting

### Check All Environment Variables

```bash
php artisan config:show
```

### Recreate Config Cache

```bash
php artisan config:clear
php artisan cache:clear
php artisan config:cache
```

### Check Routes

```bash
php artisan route:list | grep checkout
```

Expected output:
```
POST | checkout/process | checkout.process | CheckoutController@processCheckout
```

### Check Database Tables

```bash
php artisan tinker
```

Then:
```php
Schema::hasTable('orders'); // Should return true
Schema::hasTable('users');  // Should return true
```

### Test Email (if configured)

```bash
php test-email.php
```

---

## 📝 Collecting Debug Information

If the issue persists, collect this information:

1. **Error from browser console** (F12 → Console)
2. **Error from Laravel logs** (`storage/logs/laravel.log`)
3. **Network response** (F12 → Network → checkout/process → Response)
4. **Output from debug script** (`php debug-checkout.php`)

---

## ✅ Verification After Fix

After applying fixes, verify:

1. ✅ Clear all caches
   ```bash
   php artisan config:clear
   php artisan cache:clear
   php artisan route:clear
   ```

2. ✅ Run debug script
   ```bash
   php debug-checkout.php
   ```

3. ✅ Test checkout
   - Log in to your website
   - Add items to cart
   - Click "Proceed to Checkout"
   - Verify success message

4. ✅ Check order in database
   ```bash
   php artisan tinker
   ```
   ```php
   App\Models\orders::latest()->first();
   ```

---

## 🎯 Most Likely Solutions

Based on your error, try these in order:

### Solution 1: Updated Controller (Already Done) ✅

I've already updated the `CheckoutController` to handle email failures gracefully. The checkout will now work even without email configuration.

### Solution 2: Clear Cache and Test

```bash
php artisan config:clear
php artisan cache:clear
```

Then try checkout again.

### Solution 3: Check You're Logged In

Make sure you're logged in to the website before attempting checkout.

### Solution 4: Check Browser Console

Open F12 and look for the actual error in the Console or Network tabs.

### Solution 5: Check Laravel Logs

Open `storage/logs/laravel.log` and find the detailed error message.

---

## 📞 Getting More Help

If you're still stuck:

1. Run: `php debug-checkout.php`
2. Share the output
3. Share the error from `storage/logs/laravel.log`
4. Share any browser console errors

---

## 🔄 Reset Everything (Nuclear Option)

If nothing works, try a complete reset:

```bash
# Clear all caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Regenerate caches
php artisan config:cache
php artisan route:cache

# Check database
php artisan migrate:status

# Run migrations if needed
php artisan migrate

# Test
php debug-checkout.php
```

---

## ✨ Expected Success Behavior

When checkout works correctly:

1. Click "Proceed to Checkout"
2. See loading overlay
3. Order saves to database
4. Success message appears:
   - With email: "Order processed successfully! Check your email for confirmation."
   - Without email: "Order processed successfully! (Note: Email notification not sent - please configure email settings)"
5. Cart clears
6. Page shows empty cart message

---

**Most Common Fix:** The updated `CheckoutController` should fix your issue. Just run:

```bash
php artisan config:clear
php artisan cache:clear
```

Then try checkout again! 🚀

