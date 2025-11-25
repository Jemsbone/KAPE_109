<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminOtpVerificationNotification extends Notification
{
    use Queueable;

    /**
     * The OTP code
     */
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
            ->subject('Admin Email Verification - Kape Na!')
            ->greeting('Hello ' . $notifiable->admin_name . '!')
            ->line('Thank you for registering as an Admin for Kape Na! ☕')
            ->line('Your One-Time Password (OTP) for admin email verification is:')
            ->line('**' . $this->otpCode . '**')
            ->line('This OTP will expire in 10 minutes.')
            ->line('Please enter this code on the admin verification page to activate your account.')
            ->line('If you did not create an admin account, please contact the system administrator immediately.')
            ->salutation('Best regards, The Kape Na! Team');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'otp_code' => $this->otpCode,
        ];
    }
}
