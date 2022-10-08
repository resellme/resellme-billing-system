<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Hosting\Contracts\HostingInterface;

class CompleteOrderController extends Controller
{
    public $hosting;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __construct(HostingInterface $hosting)
    {
        $this->hosting = $hosting;
    }

    public function complete(Request $request)
    {
        // Verify payment using the poll url
        // Provision services
        // and show appropriate page
        return view('orders.complete');
    }
}
