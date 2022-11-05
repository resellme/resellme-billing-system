<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\CP\CPInterface;
use App\Models\Hosting;
use App\Notifications\CpanelLoginDetailsNotification;

class ProvisionHosting implements ShouldQueue
{
    public $cp;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        CPInterface $cp
    )
    {
        $this->cp = $cp;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCompleted  $event
     * @return void
     */
    public function handle(OrderCompleted $event)
    {
        $orderItem = $event->order->orderItems->where('itemable_type', Hosting::class)->first();
        $hosting = Hosting::find($orderItem->itemable_id);


        \Log::info('Processing Hosting for : ' . $hosting->domain);

        // Submit Hosting, if not yet active
        if($hosting->status !== 'active' && $this->cp->create($hosting)) {
            $hosting->status = 'active';
            $hosting->save();

            // Send Cpanel Details
            $hosting->user->notify(new CpanelLoginDetailsNotification($hosting));
        } else {
            \Log::error('Failed to create hosting for ' . $hosting->domain . ' because it already exist.');
        }
    }

    public $delay = 10;
}
