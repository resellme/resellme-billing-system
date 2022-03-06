<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class PaynowCallbackController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $status = $request->status;
        $pollUrl = $request->pollurl;
        $orderId = $request->reference;
        $order = Order::find($orderId);
        $paynowreference = $request->paynowreference;

        // $status = $this->paynow->pollTransaction($pollUrl);

        if ($status == 'Paid' || $status == 'Awaiting Delivery' || $status == 'Delivered') {
            // Update transation status
            $order->status = 'paid';
            $order->save();

            // Trigger Funds Loaded Event
            event(new OrderCompleted($order));

        } else {
           \Log::error('Transaction failed ' . $transaction->id);
        }
    }
}
