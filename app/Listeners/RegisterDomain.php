<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\DomainRegistrar\DomainRegistrarInterface;
use App\Models\Domain;

class RegisterDomain implements ShouldQueue
{
    public $domainRegistrar;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        DomainRegistrarInterface $domainRegistrar
    )
    {
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
        $orderItem = $event->order->orderItems->where('itemable_type', Domain::class)->first();
        $domain = Domain::find($orderItem->itemable_id);

        \Log::info('Processing Domain : ' . $domain->name);

        // Submit domain
        $this->domainRegistrar->register($domain);
    }

    public $delay = 10;
}
