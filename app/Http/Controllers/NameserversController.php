<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNameserverRequest;
use App\Http\Requests\UpdateNameserverRequest;
use App\Models\Nameserver;
use Illuminate\Http\Request;
use App\Models\Domain;

class NameserversController extends Controller
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
        return view('domains.nameservers.create', compact('domain'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNameserverRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNameserverRequest $request)
    {
        $nameservers = Nameserver::create($request->all());

        return redirect(route('create_contacts_page', [$nameservers->domain]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nameserver  $nameserver
     * @return \Illuminate\Http\Response
     */
    public function show(Nameserver $nameserver)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nameserver  $nameserver
     * @return \Illuminate\Http\Response
     */
    public function edit(Nameserver $nameserver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNameserverRequest  $request
     * @param  \App\Models\Nameserver  $nameserver
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNameserverRequest $request, Nameserver $nameserver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nameserver  $nameserver
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nameserver $nameserver)
    {
        //
    }
}
