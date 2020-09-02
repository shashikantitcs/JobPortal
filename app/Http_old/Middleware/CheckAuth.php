<?php

namespace App\Http\Middleware;

use Closure;
use Session;
class CheckAuth
{
    public function handle($request, Closure $next, $user_type, $equal_to = 0,$access3=0)
    {
        $isUserSession = Session::get('user')['um_id'];
        $um_user_type = Session::get('user')['um_user_type'];
       
        $user_type =  [$user_type];
        if($equal_to){
            $user_type[] = $equal_to;
        }
        if($access3){
            $user_type[] = $access3;
        }
      
        if(!$isUserSession || !$um_user_type){
            return redirect()->route('user.logout');
        }
      
        if(!in_array( $um_user_type, $user_type)){
            return redirect()->route('user.logout');
        }
        return $next($request);
    }
}