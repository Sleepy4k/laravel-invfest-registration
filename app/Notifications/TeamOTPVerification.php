<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TeamOTPVerification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Define otp var
     *
     * @var string
     */
    protected $otp;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $otp)
    {
        $this->otp = $otp || '#####';
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
                    ->subject('Verifikasi Pendaftaran Team')
                    ->line('Berikut adalah kode OTP untuk verifikasi pendaftaran team anda.')
                    ->line('Kode OTP: ' . $this->otp)
                    ->line('Kode OTP ini akan kedaluwarsa dalam 5 menit.')
                    ->line('Jika Anda tidak meminta OTP, tidak ada tindakan lebih lanjut yang diperlukan.');
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
