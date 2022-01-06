<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $user = Auth::user();
        $order = Order::create([
            //
        ]);

        // Order Items
        $orderItems = $request->order_items;
        // Process payment
        $paynow = new Paynow\Payments\Paynow(
            env('PAYNOW_INTEGRATION_ID'),
            env('PAYNOW_INTEGRATION_KEY'),
            env('PAYNOW_RESULT_URL'),
            env('PAYNOW_RETURN_URL')
        );

        $payment = $paynow->createPayment($order->id, $user->email);

        foreach($orderItems as $item) {
            $payment->add($item->description, $item->amount);
        }


        $response = $paynow->send($payment);

        if($response->success()) {
            // Store pollUrl for later checking
            $order->paynow_poll_url = $response->pollUrl();

            // Redirect the user to Paynow
            $response->redirect();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
