<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Bunnypro\Zenziva\SmsNotificationChannel as ZenzivaChannel;

class NewMessageNotif extends Notification
{
    use Queueable;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message=$message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via()
    {
        return [ZenzivaChannel::class];
    }

    public function toZenzivaSms()
    {
        return $this->message;
    }
}
