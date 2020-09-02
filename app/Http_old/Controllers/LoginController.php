<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Hash;
use Session,Mail;
use App\UserMaster;
use App\AuditTrail;
use Helper;
class LoginController extends Controller
{
    //

    public function index(){

      $view =view('app.login.login');
      $view->captcha = captcha_src();


      // dd(  $a);
      return $view;
    }
    public function captchaRefresh(){
      return captcha_src();
    }

    public function attemptLogin(Request $request){
      $validator = Validator::make($request->all(),[
            "email"=>"required|email|max:255",
            "password"=>"required|min:5|max:100",
            //"captcha"=>"required|captcha|min:6|max:6",
        ]
      //   ,
      //   [
			// 'captcha.required' => 'Please enter captcha',
			// 'captcha.captcha' => 'Please enter vaild captcha'
      //   ]
    );
    
      if ($validator->fails()) {
          $result=array('status'=> false,'code'=>422,'msg'=>'validation failed','data'=>$validator->errors());
          return response()->json($result);  
      }
        $u=UserMaster::where('um_email',trim($request->email))->first();

         if($u){
           $status=Hash::check(trim($request->password),$u->um_password);
          //  dd($status);
           if(!$status){
          

            if($u->um_user_islocked == 1 && strtotime($u->um_account_lock_time) >  strtotime(date("Y-m-d H:i:s"))){
              $result=array('status'=> false,'code'=>401,'msg'=>'','data'=>'Account locked because of too much invalid login password attempt please try after 30 minutes');
              return response()->json($result);  
             }

            UserMaster::where('um_email',trim($request->email))
            ->update([
              'um_login_fail_count'=>0,
              'um_user_islocked'=>0,
              'um_account_lock_time'=>null
            ]);
            // AuditTrail::create([
            //   "AT_USER_ID"=>$u->um_id,
            //   "AT_USER_NAME"=>$u->um_first_name." ".$u->um_last_name,
            //   "AT_IP_ADDRESS"=>$_SERVER["REMOTE_ADDR"],
            //   "AT_STATUS"=>"Y"
              
            // ]);
            Session::flush();
            $request->session()->regenerate();
            Session::put('start_time', strtotime(date("Y/m/d H:i:s",strtotime("+35 minutes"))) );
            Session::put('user', ['um_id' => $u->um_id, 'um_email' => $u->um_email, 'um_full_name' => $u->um_first_name.' '.$u->um_last_name,'um_user_type'=>$u->um_user_type]);
            Helper::doneAuditTrail("Login Attempt","SL"); 
              session()->flash('success',"Welcome To MOM Dashboard!!");
              $result=array('status'=> true,'code'=>200,'msg'=>'Welcome To MOM Dashboard!!','data'=>route('dashboard.index'));
              return response()->json($result);  
              // if($u->um_user_type == 'A'){
                // return redirect()->route('dashboard.index');
              // }else{
              //   return redirect()->route('meeting.index');
              // }
           }else{
            $fail_c = $u->um_login_fail_count + 1;
            $update['um_login_fail_count'] = $fail_c;
            if($u->um_login_fail_count  >= 3 ){
             
             $update['um_user_islocked'] = 1;
             $update['um_account_lock_time']=date("Y/m/d H:i:s", strtotime("+30 minutes"));
            }
           UserMaster::where('um_email',trim($request->email))
           ->update($update);
            $result=array('status'=> false,'code'=>401,'msg'=>'','data'=>'User Email Id And Password Not Matched !!');
            $userAuditDetail = [
              'um_id'=>$u->um_id,
              'um_full_name'=>$u->um_first_name.' '.$u->um_last_name,
              'um_user_type'=>$u->um_user_type
            ];

            Helper::doneAuditTrail("Login Attempt","LF",null, $userAuditDetail); 
            // return response()->json($result);  
            //  session()->flash('error',"User Email Id And Password Not Matched !!");
            //  $showLoginModal = true; 
            //  return redirect()->route('home.index',$showLoginModal);
             //return redirect()->route('login.index');
             return response()->json($result);  
           }
         }else{
          $result=array('status'=> false,'code'=>404,'msg'=>'','data'=>'User Email Id Not Exist !!');
          return response()->json($result);  
            // $showLoginModal = true; 
            // session()->flash('error',"User Email Id Not Exist !!");
            // return redirect()->route('home.index',$showLoginModal); 
            //return redirect()->route('login.index');
         }
    }

    public function logout(){
     
      unset($_COOKIE['authkey']);
      setcookie("authkey", "", time()-3600);

      Session::flush();
      header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
      header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
      return redirect()->route('home.index');
    }

}
