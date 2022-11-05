<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;
use App\Models\Hosting;

class CpanelLoginDetailsNotification extends Notification
{
    use Queueable;

    public $hosting;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Hosting $hosting)
    {
        $this->hosting = $hosting;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $password = Crypt::decryptString($this->hosting->password);
        $link = 'https://alpha.freehosting.co.zw:2083';

        return (new MailMessage)
                    ->subject('Cpanel Login Details: ' . $this->hosting->domain)
                    ->cc('privyreza@gmail.com')
                    ->line('Here are your hosting cpanel login details. Keep then private and safe.')
                    ->line('Username: ' . $this->hosting->username)
                    ->line('Password: ' . $password)
                    ->line('Link: ' . $link);
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
