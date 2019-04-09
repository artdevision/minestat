<?php

namespace App\Http\Middleware;

use Illuminate\Routing\Middleware\ThrottleRequests;
use RuntimeException;

class ThrottleHosts extends ThrottleRequests
{

    /**
     * Resolve request signature.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     *
     * @throws \RuntimeException
     */
    protected function resolveRequestSignature($request)
    {
        if($host = $request->get("hostname", false)) {
            return sha1($host);
        }

        throw new RuntimeException('Unable to generate the request signature. Route unavailable.');
    }

}
