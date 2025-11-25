<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address',
        'google_id',
        'avatar',
        'email_verified_at',
        'otp_code',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'otp_expires_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public static function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:8|confirmed',
            'address' => 'required|string|max:500',
        ];
    }

    /**
     * Generate a 6-digit OTP code
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
     * Mark email as verified
     */
    public function markEmailAsVerified()
    {
        return $this->update(['email_verified_at' => now()]);
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
     * Check if email is verified
     */
    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    /**
     * Send email verification notification with OTP
     */
    public function sendEmailVerificationNotification()
    {
        $otpCode = $this->generateOtpCode();
        $this->notify(new \App\Notifications\UserOtpVerification($otpCode));
    }
}