<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Resellme\Client;
use App\Http\Requests\DomainSearchRequest;

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
    public function search(DomainSearchRequest $request) {
        $status = 'available';
        $domain = $request->domain;

        $client = rmClient();

        // Search domain
        $domainSearch = $client->searchDomain($domain);

        if ($domainSearch->status == 'not_available') {
            $status = 'not_available';
        } else {
            $status = 'available';
        }

        return view('search-domain-page', compact('status', 'domain'));
    } 
}
