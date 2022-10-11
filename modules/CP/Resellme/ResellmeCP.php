<?php

namespace Modules\CP\Resellme;

use Modules\CP\CPInterface;
use Resellme\Client;

class ResellmeCP implements CPInterface
{
    /**
     * Create a hosting account.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $domain, string $package)
    {
        $token = env('RESELLME_TOKEN');
        $resellmeClient = new Client($token);

        // create hosting
        $hostingData = [
            'domain' => $domain,
            'billing_cycle' => 'monthly',
            'package' => $package,
        ];

        $hosting = $resellmeClient->createHosting($hostingData);

        return $hosting;
    }
}