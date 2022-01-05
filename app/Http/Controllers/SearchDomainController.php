<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Resellme\Client;

class SearchDomainController extends Controller
{
    /**
     * Search domain page / client portal home
     * 
     * Can search domaain passed from other systems as well as GET 
     * 
     * EG ?s=domain.co.zw
     */
    public function index() {
        return view('search-domain-page');
    }

    /**
     * Search if domain is available
     * 
     * @return array $domainSearchResult
     *
     */
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
