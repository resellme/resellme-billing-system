<?php

namespace Modules\DomainRegistrar;

use App\Models\Domain;

interface DomainRegistrarInterface
{
    /**
     * Creates hosting account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Domain $domain);

    public function transfer(Domain $domain);
}
