<?php

namespace Modules\Domains;

use App\Models\Domain;

interface DomainRegistrarInterface
{
    /**
     * Creates hosting account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Domain $domain, string $package);

    public function transfer(string $domain, string $package);
}
