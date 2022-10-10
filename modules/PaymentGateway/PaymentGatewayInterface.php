<?php

namespace Modules\PaymentGateway;

use Illuminate\Http\Request;

interface PaymentGatewayInterface
{
    public function callback(Request $request);

    public function pay($data);
}
