<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeoUsRestriction
{
    public function handle(Request $request, Closure $next): Response
    {
        $country = strtoupper($request->header('CF-IPCountry') ?? $request->header('X-Country-Code') ?? 'US');

        $request->attributes->set('is_us_visitor', $country === 'US');

        return $next($request);
    }
}
