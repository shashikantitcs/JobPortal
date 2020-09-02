<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate 
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
				
				
                return response('Unauthorized.', 401);
				
            }

            return redirect()->guest('login');
        }
        
        $response = $next($request);
        $response->header('Cache-Control','no-cache,no-store,max-age=0,must-revalidate')
                    ->header('Pragma','no-cache')
                    ->header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        
        return  $response;
    }
    // protected function redirectTo($request)
    // {
    //     if (! $request->expectsJson()) {
    //         return route('login');
    //     }
    // }
}
