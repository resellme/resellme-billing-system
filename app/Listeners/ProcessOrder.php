<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\CP\CPInterface;
use Modules\DomainRegistrar\DomainRegistrarInterface;
use App\Models\Domain;
use App\Models\Hosting;

class ProcessOrder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        CPInterface $cp, 
        DomainRegistrarInterface $domainRegistrar
    )
    {
        $this->cp = $cp;
        $this->domainRegistrar = $domainRegistrar;
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\OrderCompleted  $event
     * @return void
     */
    public function handle(OrderCompleted $event)
    {
        $client = rmClient();
        $order = $event->order;

        $orderItems = $order->orderItems;

        foreach ($orderItems as $key => $orderItem) {
            if ($orderItem->service_type == 'hosting') {
                $hosting = Hosting::find($orderItem->record_id);
                $this->cp->create($hosting);
            } elseif ($orderItem->service_type == 'domain') {
                $domain = Domain::find($orderItem->record_id);
                $this->domainRegistrar->register($domain);
            }
        }
    }

    // Delay for 10 Seconds
    public $delay = 5;
    public $cp;
    public $domainRegistrar;
}
