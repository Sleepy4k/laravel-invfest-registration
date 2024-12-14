<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamApproved extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        protected string $whatsapp_link
    ) {}

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
                    ->subject('Team anda disetujui!')
                    ->line('Selamat team anda telah disetujui oleh Panitia.')
                    ->line('Selanjutnya, silahkan bergabung dengan tautan whatsapp berikut untuk mendapatkan informasi lebih lanjut.')
                    ->action('Tautan Whatsapp Group', $this->whatsapp_link)
                    ->line('Terima kasih sudah berpartisipasi dalam event '.config('app.name').'.');
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
