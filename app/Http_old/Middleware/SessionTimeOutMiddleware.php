<?php
 namespace App\Http\Middleware;
 use Illuminate\Contracts\Encryption\DecryptException;

 use closure;
 use Auth;
 Use Session;


 class SessionTimeOutMiddleware{

 	public function handle($request, Closure $next){
         $a =Session::get('start_time');
        
 		if($a){
 			if(strtotime(date("Y/m/d H:i:s")) >= $a){
                 Session::forget('start_time');
				 if($request->ajax()){
					return response()->json(['session_time_out'=>1,'url'=>route('user.logout')]);
				}
 				return redirect()->route('user.logout');
 			}	
 		}

 		Session::put('start_time', strtotime(date("Y/m/d H:i:s",strtotime("+35 minutes"))) );
 
       return $next($request);

 	}

 }

?>