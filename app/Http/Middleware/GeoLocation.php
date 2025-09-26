<?php

namespace App\Http\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Closure;
use GeoIP;
use Illuminate\Http\Request;

class GeoLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Test to see if the requesters have an ip address.
        $location = geoip()->getLocation($request->ip());
        //dd($location->iso_code);
        if(isset($location)){
            if ($location->iso_code !== 'US') {
                return response('Unauthorized.', 401);
            }
        }

        return $next($request);
    }
}