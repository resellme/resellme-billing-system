<?php

namespace Modules\CP;

use App\Models\Hosting;

interface CPInterface
{
    /**
     * Creates hosting account.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Hosting $hosting);
}
