<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordReset extends Notification
{
    use Queueable;

    protected $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Your Password Has Been Reset')
            ->line('Your password has been reset by an administrator.')
            ->line('Your new password is: ' . $this->password)
            ->line('Please change your password after logging in.')
            ->action('Login Now', url('/login'));
    }
} 