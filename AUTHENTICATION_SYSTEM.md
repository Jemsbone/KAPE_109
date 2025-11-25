# Authentication System - Simple Email/Password + Sanctum

## ✅ Overview

Your Coffee Shop application uses **simple email/password authentication** with:
- **Instant registration** - No email verification required
- **Laravel Sanctum** for API token authorization
- **Immediate access** - Users can login right after registration

---

## 🎯 Features

### **1. Quick Registration**
- ✅ User fills registration form (name, email, phone, password, address)
- ✅ Account created instantly
- ✅ **No email verification needed**
- ✅ Automatically logged in
- ✅ Sanctum token generated
- ✅ Redirected to customer home

### **2. Email/Password Login**
- ✅ Login with email and password
- ✅ Remember me functionality
- ✅ Sanctum token generated on login
- ✅ Immediate access to the application

### **3. Laravel Sanctum Authorization**
- ✅ API tokens generated on login/registration
- ✅ Tokens stored in session
- ✅ Tokens revoked on logout
- ✅ Ready for API endpoint protection

---

## 🚀 How It Works

### **Registration Flow:**

```
1. User visits /register
2. Fills form (name, email, phone, password, address)
3. Clicks "Register"
   ↓
4. System creates user account
5. Logs user in automatically
6. Generates Sanctum token
   ↓
7. Redirects to customer home ✅
   (No verification needed!)
```

### **Login Flow:**

```
1. User visits /login
2. Enters email and password
3. Clicks "Login"
   ↓
4. System validates credentials
5. Generates Sanctum token
   ↓
6. Redirects to customer home ✅
```

---

## 📝 Usage

### **For Users:**

#### **Register New Account:**
```
1. Visit: http://localhost:8000/register
2. Fill: Name, Email, Phone, Password, Address
3. Click: "Register"
4. Done: Instantly logged in! ✅
```

#### **Login:**
```
1. Visit: http://localhost:8000/login
2. Enter: Email and Password
3. Click: "Login"
4. Done: Logged in! ✅
```

### **For Developers:**

#### **Protecting API Routes:**

In `routes/api.php`:

```php
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/cart', [CartController::class, 'index']);
});
```

#### **Making API Requests:**

```javascript
// Get token from session
const token = document.querySelector('meta[name="api-token"]').content;

// Make authenticated request
fetch('/api/user', {
    headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
})
.then(response => response.json())
.then(data => console.log(data));
```

#### **Adding Token to Blade Templates:**

In your layout file:

```blade
<head>
    <!-- ... -->
    @if(session('api_token'))
        <meta name="api-token" content="{{ session('api_token') }}">
    @endif
</head>
```

---

## 🗄️ Database Schema

### **Users Table:**

| Column | Type | Description |
|--------|------|-------------|
| `user_id` | Primary Key | User ID |
| `name` | String | Full name |
| `email` | String (Unique) | Email address |
| `phone` | String | Phone number |
| `password` | String (Hashed) | User password |
| `address` | String | Full address |
| `remember_token` | String | Remember me token |
| `created_at` | Timestamp | Account creation |
| `updated_at` | Timestamp | Last update |

---

## 🔐 Security Features

### **1. Password Security**
- ✅ Bcrypt hashing
- ✅ Minimum 8 characters
- ✅ Confirmation required on registration

### **2. Sanctum Security**
- ✅ Tokens hashed in database
- ✅ Tokens revoked on logout
- ✅ Per-user token management
- ✅ CSRF protection for web routes

### **3. Session Security**
- ✅ Session regeneration on login
- ✅ Session invalidation on logout
- ✅ CSRF protection

---

## 📋 API Endpoints

### **Authentication:**

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET | `/register` | Show registration form |
| POST | `/register` | Register with email/password |
| GET | `/login` | Show login form |
| POST | `/login` | Login with email/password |
| POST | `/logout` | Logout and revoke tokens |

### **Protected Routes:**

All routes with `middleware('auth')` require user to be logged in.

---

## 🧪 Testing

### **Test Registration:**
```bash
php artisan serve

# Visit: http://localhost:8000/register
# Fill: Registration form
# Click: "Register"
# Result: Instantly logged in ✅
```

### **Test Login:**
```bash
php artisan serve

# Visit: http://localhost:8000/login
# Enter: Email and password
# Click: "Login"
# Result: Logged in ✅
```

### **Test API with Sanctum:**
```bash
# After login, token is in session
# Make request with Authorization header
curl -H "Authorization: Bearer YOUR_TOKEN" \
     -H "Accept: application/json" \
     http://localhost:8000/api/user
```

---

## 📁 Key Files

### **Controllers:**
- `app/Http/Controllers/AuthController.php` - Registration and login

### **Models:**
- `app/Models/User.php` - User model with Sanctum tokens

### **Views:**
- `resources/views/Auth/Login.blade.php` - Login form
- `resources/views/Auth/Register.blade.php` - Registration form

### **Routes:**
- `routes/web.php` - Authentication routes

---

## ✨ Benefits

### **For Users:**
- ✅ **Instant Access** - No waiting for verification emails
- ✅ **Simple** - Just register and go
- ✅ **Fast** - Immediate login after registration

### **For Developers:**
- ✅ **API Ready** - Sanctum tokens for all users
- ✅ **Simple** - No complex verification flows
- ✅ **Flexible** - Web + API support
- ✅ **Maintainable** - Clean, minimal codebase

---

## 🚨 Important Notes

1. **No Email Verification**
   - Users can register and login immediately
   - No OTP or email verification required
   - Faster user onboarding

2. **Sanctum Tokens**
   - Generated on registration and login
   - Stored in session (`api_token` key)
   - Revoked on logout
   - Ready for API endpoints

3. **Password Requirements**
   - Minimum 8 characters
   - Must be confirmed on registration
   - Hashed with bcrypt

4. **Remember Me**
   - Checkbox on login form
   - Extends session lifetime
   - Convenient for returning users

---

## 📞 Troubleshooting

### **Can't Login:**
- Check email and password are correct
- Password is case-sensitive
- Make sure account exists (register first)

### **Forgot Password:**
- Currently no password reset
- Contact admin or create new account

### **Session Expired:**
- Login again
- Sessions expire after inactivity

---

## 🎉 Summary

✅ **Simple Authentication** - Email and password only  
✅ **Instant Registration** - No email verification  
✅ **Sanctum Tokens** - API authorization ready  
✅ **Fast** - Immediate access after registration  
✅ **Secure** - Password hashing + session management  
✅ **Clean** - Minimal, maintainable code  

**Your Coffee Shop app has a fast, simple authentication system!** ☕🔐✨

---

**Date:** November 16, 2025  
**Status:** ✅ Complete and Ready to Use  
**Authentication Method:** Simple Email/Password + Sanctum  
**Verification:** None Required

