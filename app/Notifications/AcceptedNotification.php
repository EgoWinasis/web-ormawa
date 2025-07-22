<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AcceptedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $calon;
    public $websiteUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct($calon, $websiteUrl)
    {
        $this->calon = $calon;
        $this->websiteUrl = $websiteUrl;
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
    public function toMail($notifiable)
    {
        // URL untuk mengecek status pendaftaran
        $websiteUrl = $this->websiteUrl;

        return (new MailMessage)
            ->subject('Perubahan Status Pendaftaran di Web Ormawa PHB')
            ->markdown('email.acceptedEmailNotification', [
                'calon' => $this->calon, // Objek calon yang dikirim
                'websiteUrl' => $websiteUrl // URL untuk cek status pendaftaran
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         'status' => $this->user->status,
    //         'keterangan' => $this->user->keterangan,
    //     ];
    // }
}
