<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHostingRequest;
use App\Http\Requests\UpdateHostingRequest;
use App\Models\Hosting;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Domain;

class HostingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hosting = Hosting::where('user_id', \Auth::id())->get();
        return view('hosting.index', compact('hosting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('hosting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHostingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHostingRequest $request)
    {
        $hostingData = [
            'domain' => $request->domain,
            'billing_cycle' => 'free',
            'package' => 'freehosting',
            'user_id' => \Auth::id(),
        ];

        $hosting = Hosting::create($hostingData);

        // Domain Data
        $domain = Domain::create(
            [
                'name' => $request->domain,
                'user_id' => \Auth::id(),
            ]
        );

        // Create order and items
        $order = Order::create(['user_id' => \Auth::id()]);

        // Order Items
        $domainPrice = env('DOMAIN_PRICE');
        $orderItems = OrderItem::insert([
            [
                'order_id' => $order->id,
                'service_type' => 'hosting',
                'record_id' => $hosting->id,
                'amount' => 0
            ],
            [
                'order_id' => $order->id,
                'service_type' => 'domain',
                'record_id' => $domain->id,
                'amount' => $domainPrice,
            ]
        ]);

        // Redirect to order summary
        return redirect(route('orders.show', $order));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Hosting  $hosting
     * @return \Illuminate\Http\Response
     */
    public function show(Hosting $hosting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Hosting  $hosting
     * @return \Illuminate\Http\Response
     */
    public function edit(Hosting $hosting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHostingRequest  $request
     * @param  \App\Models\Hosting  $hosting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHostingRequest $request, Hosting $hosting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Hosting  $hosting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hosting $hosting)
    {
        //
    }
}
