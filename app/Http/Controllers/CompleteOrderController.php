<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\CP\CPInterface;
use Modules\DomainRegistrar\DomainRegistrarInterface;
use App\Models\Domain;
use App\Models\Hosting;
use App\Models\Order;
use App\Events\OrderCompleted;

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
        \Log::info('Callback from Paynow');
        $status = $request->status;
        $pollUrl = $request->pollurl;
        $orderId = $request->reference;
        $order = Order::find($orderId);
        $paynowreference = $request->paynowreference;

        if ($status == 'Paid' || $status == 'Awaiting Delivery' || $status == 'Delivered') {
            // Update transation status
            $order->status = 'completed';
            $order->save();

            // Trigger Funds Loaded Event
            event(new OrderCompleted($order));

        } else {
           \Log::error('Transaction failed ' . $order->id);
        }
    }

    public function complete(Order $order)
    {
        return view('orders.complete');
    }
}
