<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use Auth;
use App\Models\Domain;
use App\Models\OrderItem;
use Paynow\Payments\Paynow;

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
    public function create(Domain $domain)
    {
        $price = env('DOMAIN_PRICE');
        return view('orders.create', compact('domain', 'price'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        $domain = json_decode($request->domain);
        $user = Auth::user();
        $price = env('DOMAIN_PRICE');

        $orderData = [
            'user_id' => $user->id,
            'status' => 'pending'
        ];

        $order = Order::create($orderData);

        // Order Items
        $items = $request->items;

        foreach ($items as $key => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'amount' => $price,
                'description' => 'Domain: ' . $domain->name,
                'service_type' => 'domain_registration',
                'domain_id' => $domain->id,
            ]);   
        }

        // Process payment
        $paynow = new Paynow(
            env('PAYNOW_INTEGRATION_ID'),
            env('PAYNOW_INTEGRATION_KEY'),
            env('PAYNOW_RETURN_URL'),
            env('PAYNOW_RESULT_URL')
        );

        $payment = $paynow->createPayment($order->id, $user->email);

        // foreach($orderItems as $item) {
            // $payment->add($item->description, $item->amount);
        // }

        $payment->add($orderItem->description, $orderItem->amount);

        $response = $paynow->send($payment);

        if($response->success()) {
            // Store pollUrl for later checking
            $order->paynow_poll_url = $response->pollUrl();
            $order->save();

            // Redirect the user to Paynow
            return redirect($response->redirectUrl());
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
        return view('orders.show', compact('order'));
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
