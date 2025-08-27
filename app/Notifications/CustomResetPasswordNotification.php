<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotificationBase;

class CustomResetPasswordNotification extends ResetPasswordNotificationBase
{
    use Queueable;

    public function __construct($token)
    {
        parent::__construct($token);
    }

    public function toMail($notifiable): MailMessage
    {
        $url = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('🔑 Reset Password Akun Anda')
            ->greeting('Halo, ' . $notifiable->name . ' 👋')
            ->line('Kami menerima permintaan untuk mereset password akun Anda.')
            ->action('Reset Password', $url)
            ->line('Link reset password ini hanya berlaku selama 60 menit.')
            ->line('Jika Anda tidak merasa meminta reset password, abaikan email ini.')
            ->salutation('Salam hangat, Tim Ormawa Poltek Harber');
    }
}
