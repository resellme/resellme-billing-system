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
        $contact = $domain->contact;
        $contacts = [
            "registrant" => [
                "first_name"    =>  $contact->first_name,
                "last_name"     =>  $contact->last_name,
                "email"         =>  $contact->email,
                "company"       =>  $contact->company,
                "mobile"        =>  $contact->mobile,
                "street_address"=>  $contact->street_address,
                "core_business" =>  $contact->core_business,
                "city"          =>  $contact->city,
                "country"       =>  $contact->country,
            ]
        ];

        // Nameservers
        $nameserver = $domain->nameserver;
        if (is_null($domain->nameserver)) {
            $nameservers = [
                'ns1.freehosting.co.zw',
                'ns2.freehosting.co.zw',
            ];
        } else {
            $nameservers = [
                "ns1"   =>  $nameserver->ns1,
                "ns2"   =>  $nameserver->ns2,
                "ns3"   =>  $nameserver->ns3,
                "ns4"   =>  $nameserver->ns4,
            ];
        }        

        // Prepare the data
        $data = [
            'domain' => $domain->name,
            'nameservers' => $nameservers,
            'contacts' => $contacts
        ]; 

        // $domainSearch = $client->searchDomain($domain->name);

        // if ($domainSearch->status == 'not_available') {
        //     throw new Exception("Domain is already register. Try transfering it if its yours. Domain: " . $domain->name, 1);
            
        // }

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
