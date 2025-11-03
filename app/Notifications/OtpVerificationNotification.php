<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * OTP Verification Notification
 * 
 * This notification sends a 6-digit OTP code to users
 * for email verification when they register for Kape Na!
 */
class OtpVerificationNotification extends Notification
{
    use Queueable;

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
            ->subject('Your Verification Code - Kape Na!')
            ->greeting('Welcome to Kape Na! ☕')
            ->line('Thank you for registering with us! We\'re excited to have you as part of our coffee-loving community.')
            ->line('Your verification code is:')
            ->line('')
            ->line('**' . $this->otpCode . '**')
            ->line('')
            ->line('This code will expire in 10 minutes.')
            ->line('Please enter this code on the verification page to complete your registration.')
            ->line('')
            ->line('If you did not create an account, no further action is required.')
            ->salutation('Warm regards, The Kape Na! Team ☕');
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

