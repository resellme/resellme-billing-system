<?php

namespace Modules\Domains;

interface DomainRegistrarInterface
{
    /**
     * Creates hosting account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(string $domain, string $package);

    public function transfer(string $domain, string $package);
}
