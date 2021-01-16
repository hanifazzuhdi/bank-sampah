<?php

namespace App\Notifications;

use App\Model\Penarikan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramNotif extends Notification
{
    use Queueable;

    public $email;
    public $permintaan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
        $this->permintaan = Penarikan::whereStatus(1)->get()->count();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to('@test_aja')
            ->content("*PEMBERITAHUAN BENDAHARA*\nPermintaan penarikan uang No.Rekening {$this->email}\nsedang menunggu untuk di proses\n\nPermintaan belum diproses : {$this->permintaan}");       // ->button('Buka Aplikasi', 'http://sammpah.herokuapp.com/');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
