<?php

namespace App\Http\Middleware;

use Closure;

class CacheControl
{
    public function handle($request, Closure $next,$guard=null)
    {
        // $response = $next($request);
        $response = $next($request);
         $response->header('Access-Control-Allow-Origin', 'http://10.247.18.136/')
                ->header('Cache-Control', 'no-cache, must-revalidate')
                ->header('Cache-Control','no-cache,no-store,max-age=0,must-revalidate');
                // ->header('Pragma','no-cache')
                // ->header('Content-Disposition', 'attachment; filename="filename.gz"')
                // ->header("Expires: Sat, 01 Jan 1990 00:00:00 GMT");
        // Or whatever you want it to be:
        // $response->header('Cache-Control', 'max-age=100');

        return $response;
    }
}