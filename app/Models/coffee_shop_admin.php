<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\AdminOtpVerificationNotification;

class coffee_shop_admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'coffee_shop_admin';
    protected $primaryKey = 'admin_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'admin_name',
        'admin_email',
        'admin_password',
        'otp_code',
        'otp_expires_at',
        'email_verified_at',
    ];

    protected $hidden = [
        'admin_password',
        'otp_code',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = true;

    /**
     * Get the password attribute name for authentication
     */
    public function getAuthPassword()
    {
        return $this->admin_password;
    }

    /**
     * Get the email attribute for notifications
     */
    public function getEmailForNotifications()
    {
        return $this->admin_email;
    }

    /**
     * Route notifications for the mail channel
     */
    public function routeNotificationForMail()
    {
        return $this->admin_email;
    }

    /**
     * Check if email is verified
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Mark email as verified
     */
    public function markEmailAsVerified()
    {
        return $this->update(['email_verified_at' => now()]);
    }

    /**
     * Generate a new OTP code for the admin
     */
    public function generateOtpCode()
    {
        $otpCode = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        $this->update([
            'otp_code' => $otpCode,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        return $otpCode;
    }

    /**
     * Verify the OTP code
     */
    public function verifyOtpCode($code)
    {
        if ($this->otp_code === $code && 
            $this->otp_expires_at && 
            now()->lessThan($this->otp_expires_at)) {
            
            $this->markEmailAsVerified();
            $this->clearOtpCode();
            
            return true;
        }

        return false;
    }

    /**
     * Clear the OTP code
     */
    public function clearOtpCode()
    {
        $this->update([
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
    }

    /**
     * Send the OTP verification notification
     */
    public function sendEmailVerificationNotification()
    {
        $otpCode = $this->generateOtpCode();
        $this->notify(new AdminOtpVerificationNotification($otpCode));
    }

    /**
     * Admin has many employees
     */
    public function employees()
    {
        return $this->hasMany(coffee_shop_employee::class, 'admin_id', 'admin_id');
    }
}