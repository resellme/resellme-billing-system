<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Resellme\Client;

class SearchDomainController extends Controller
{
    public function search(String $domain) {
        // Get Token
        $token = env('RESELLME_TOKEN');
        
        // Create RM client
        $client = new Client($token);

        // Search domain
        $domainSearch = $client->searchDomain($domain);

        return $domainSearch;
    } 
}
