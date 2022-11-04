<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\OrderCompletedClientNotification;

class SendOrderCompletedNotificationToClient implements ShouldQueue
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
     * @param  \App\Events\OrderCompleted  $event
     * @return void
     */
    public function handle(OrderCompleted $event)
    {
        $order = $event->order;

        \Log::info('Sending Order Notification to Client. Order: ' . $order->id);

        $order->user->notify(new OrderCompletedClientNotification($order));
    }

    public $delay = 5;
}
