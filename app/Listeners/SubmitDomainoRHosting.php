<?php

namespace App\Listeners;

use App\Events\OrderCompleted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SubmitDomainoRHosting
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
        $client = rmClient();
        $order = $event->order;

        $orderItems = $order->orderItems;

        foreach ($orderItems as $key => $oi) {
            if ($oi->service_type == 'domain_registration') {
                $contact = [
                    "contacts" => [
                        "registrant" => $oi->domain->toArray()
                    ]
                ];

                // Nameservers
                $nameservers = $oi->domain->nameservers->toArray();

                // Prepare the data
                $data = [
                    'domain' => $oi->domain->name,
                    'nameservers' => $nameservers,
                    'contacts' => $contacts
                ]; 

                $client->registerDomain($data);
            }
        }
    }

    // Delay for 10 Seconds
    public $delay = 5;
}
