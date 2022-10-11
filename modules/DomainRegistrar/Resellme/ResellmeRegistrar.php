<?php

namespace Modules\DomainRegistrar\Resellme;

use Resellme\Client;
use App\Models\Domain;
use Modules\DomainRegistrar\DomainRegistrarInterface;

class ResellmeRegistrar implements DomainRegistrarInterface
{
    /**
     * Registers a domain
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Domain $domain) {
        // Get token from env
        $token = getenv('RM_TOKEN');

        // Initialize the Client
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
            'domain' => $domain->name,
            'nameservers' => $nameservers,
            'contacts' => $contacts
        ]; 

        $domainSearch = $client->searchDomain($domain->name);

        if ($domainSearch->status == 'not_available') {
            throw new Exception("Domain is already register. Try transfering it if its yours.", 1);
            
        }

        $domain = $client->registerDomain($data);
    }

    public function transfer(Domain $domain) {
        // Get token from env
        $token = getenv('RM_TOKEN');

        // Initialize the Client
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
            'domain' => $domain->name,
            'nameservers' => $nameservers,
            'contacts' => $contacts
        ]; 

        $domainSearch = $client->searchDomain($domain->name);

        if ($domainSearch->status == 'available') {
            throw new Exception("Domain is not registered. Try registering it instead.", 1);
        }

        $domain = $client->transferDomain($data);
    }
}
