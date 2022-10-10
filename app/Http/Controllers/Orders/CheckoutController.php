<?php

namespace App\Http\Controllers\Orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Paynow\Payments\Paynow;
use App\Models\Order;

class CheckoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Order $order)
    {
        $paynow = new Paynow(
            env('PAYNOW_INTEGRATION_ID'),
            env('PAYNOW_INTEGRATION_KEY'),
            env('PAYNOW_RETURN_URL'),
            env('PAYNOW_RESULT_URL')
        );

        $payment = $paynow->createPayment($order->id, $order->user->email);

        foreach($order->orderItems as $item) {
            $payment->add($item->service_type, $item->amount);
        }

        $response = $paynow->send($payment);

        if($response->success()) {
            // Store pollUrl for later checking
            $order->paynow_poll_url = $response->pollUrl();
            $order->save();

            // Redirect the user to Paynow
            return redirect($response->redirectUrl());
        }
    }
}
