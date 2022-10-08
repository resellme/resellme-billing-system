<?php

namespace Modules\Hosting\Contracts;

interface HostingInterface
{
    /**
     * Creates hosting account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create($domain, $package);
}
