<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterDomainController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // If user has enough funds
        if (!hasEnoughFunds()) {
            return redirect('/load-funds');
        }

        // Get Token
        $token = env('RESELLME_TOKEN');
        
        // Create RM client
        $client = new Client($token);

        // Domain Owner
        $contact = [
            "contacts" => [
                "registrant" => $domain->contact->toArray()
            ]
        ];

        // Nameservers
        $nameservers = $domain->nameserver->toArray();

        // Prepare the data
        $data = [
            'domain' => $request->domain,
            'nameservers' => $nameservers,
            'contacts' => $contacts
        ];     

        /**
         * Register the domain now
         * @return array
         *
         */
        $domain = $client->registerDomain($data);
    }
}
