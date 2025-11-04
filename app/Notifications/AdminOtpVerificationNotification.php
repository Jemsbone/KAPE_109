<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Admin OTP Verification Notification
 * 
 * This notification sends a 6-digit OTP code to admins
 * for email verification when they log in to Kape Na!
 */
class AdminOtpVerificationNotification extends Notification
{
    // Don't use Queueable trait - send immediately
    // use Queueable;

    protected $otpCode;

    /**
     * Create a new notification instance.
     */
    public function __construct($otpCode)
    {
        $this->otpCode = $otpCode;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Admin Login Verification Code - Kape Na!')
            ->greeting('Hello Admin! ☕')
            ->line('You have requested to log in to the Kape Na! Admin Dashboard.')
            ->line('Your verification code is:')
            ->line('')
            ->line('**' . $this->otpCode . '**')
            ->line('')
            ->line('This code will expire in 10 minutes.')
            ->line('Please enter this code on the verification page to complete your login.')
            ->line('')
            ->line('If you did not attempt to log in, please contact the system administrator immediately.')
            ->salutation('Regards, The Kape Na! System ☕');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
