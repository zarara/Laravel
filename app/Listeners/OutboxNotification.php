<?php

namespace App\Listeners;

use App\Notifications\NewMessageNotif;
use App\Outbox;
use Carbon\Carbon;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OutboxNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NotificationSent  $event
     * @return void
     */
    public function handle(NotificationSent $event)
    {
        if ($event->notification instanceof NewMessageNotif){
            $event->notifiable->outbox()->create([
                'message'=>$event->notification->message,
                'send_at'=>Carbon::now(),
            ]);
        }
    }
}
