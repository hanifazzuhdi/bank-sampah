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
    public $penarikan;
    public $permintaan;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($email, $penarikan)
    {
        $this->email = $email;
        $this->penarikan = $penarikan;
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
            ->to('@sammpah_2')
            ->content("*PEMBERITAHUAN BENDAHARA*\nPermintaan penarikan uang :\n- Email : {$this->email}\n- Alias : {$this->penarikan->nama}\n- No.Rekening : {$this->penarikan->rekening}\n\nSedang menunggu untuk di proses, segera proses permintaan\n\nPermintaan belum diproses : {$this->permintaan}")
            ->button('Kelola Keuangan', 'http://sammpah.herokuapp.com');
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
