<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Domain;

class ConfigureDomainController extends Controller
{
    public function contact(Domain $domain) {
        return view('domains.contacts.create', compact('domain'));
    }

    public function nameserver($order) {

    }
}
