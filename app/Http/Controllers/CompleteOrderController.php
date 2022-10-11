<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CP\CPInterface;
use Modules\DomainRegistrar\DomainRegistrarInterface;
use App\Models\Domain;
use App\Models\Hosting;
use App\Models\Order;

class CompleteOrderController extends Controller
{
    public $cp;
    public $domainRegistrar;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct(
        CPInterface $cp, 
        DomainRegistrarInterface $domainRegistrar
    )
    {
        $this->cp = $cp;
        $this->domainRegistrar = $domainRegistrar;
    }

    public function callback(Request $request) {
        // Verify payment using the poll url
        // Provision services
        // and show appropriate page
        $orderId = $request->reference;

        $order = Order::find($orderId);
        $status = $request->status;
        $pollUrl = $request->pollurl;
        $paynowreference = $request->paynowreference;

        dd($status);

        if ($status == 'Paid' || $status == 'Awaiting Delivery' || $status == 'Delivered') {
            // Update transation status
            $order->status = 'completed';
            $order->save();

            // Provision Services
            foreach ($order->orderItems as $key => $orderItem) {
                if ($orderItem->service_type == 'hosting') {
                    $hosting = Hosting::find($orderItem->record_id);
                    $this->cp->create($hosting);
                } elseif ($orderItem->service_type == 'domain') {
                    $domain = Domain::find($orderItem->record_id);
                    $this->domainRegistrar->register($domain);
                }
            }
        
            return view('orders.complete');
        }
    }

    public function complete(Order $order)
    {
        return view('orders.complete');
    }
}
