<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\OtpVerificationNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    // Add this line to specify the primary key
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'address',
        'otp_code',
        'otp_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp_code',
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
     * Generate a new OTP code for the user.
     *
     * @return string
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
     * Verify the OTP code.
     *
     * @param string $code
     * @return bool
     */
    public function verifyOtpCode($code)
    {
        // Check if OTP exists, matches, and hasn't expired
        if ($this->otp_code === $code && 
            $this->otp_expires_at && 
            now()->lessThan($this->otp_expires_at)) {
            
            // Mark email as verified and clear OTP
            $this->markEmailAsVerified();
            $this->clearOtpCode();
            
            return true;
        }

        return false;
    }

    /**
     * Clear the OTP code.
     *
     * @return void
     */
    public function clearOtpCode()
    {
        $this->update([
            'otp_code' => null,
            'otp_expires_at' => null,
        ]);
    }

    /**
     * Send the OTP verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $otpCode = $this->generateOtpCode();
        $this->notify(new OtpVerificationNotification($otpCode));
    }
}