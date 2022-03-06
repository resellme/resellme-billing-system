<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompleteOrderController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Verify payment using the poll url
        // and show appropriate page
        return view('orders.complete');
    }
}
