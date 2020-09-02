<?php

namespace App\Http\Controllers;

use App\UserMaster;
use App\DepartmentMaster;
use App\SectionMaster;
use App\UserPasswordHistory;
use App\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;
use Mail;

use App\Http\Requests\UserMasterStore;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = UserMaster::where('um_status','=','A')->orWhere('um_status','=','I')->latest('um_id')->paginate(20);

        return view('app.user.alluser',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department = DepartmentMaster::where('dm_status','A')->get();
        $role= Role::select('role_id','role','role_full_name')->get();
        return view('app.user.usercreate',compact('role','department'));
    }

    public function getSectionDetail(Request $request){
        $request->validate([
            "sm_dm_id"=>"required"
        ]);
        $data=SectionMaster::where('sm_dm_id',$request->sm_dm_id)->get();
        $result=array('status'=> true,'data'=> $data);
        return response()->json($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // UserMasterStore
    public function store(Request $request)
    {   $validatearray=[
            //"um_email"=>'required|max:255|unique:user_master',
            "um_email"=>'required|max:255',
            "um_mobile"=>"required|min:10|max:10",
            "um_first_name"=>'required|max:100',
            "um_last_name"=>"max:100",
            "um_password"=>"required|min:5|max:100",
            // "um_status"=>"required|in:A",
            "um_gender"=>"required|in:M,F,O",
            "um_user_type"=>"required|in:A,MA,U",
            "um_designation"=>"max:255"
        ];
        if($request->um_user_type == "U"){
            $validatearray['um_dm_id']="required";
            if(!empty($request->um_sm_id)){$validatearray['um_sm_id']="required";  }
        }

        $request->validate($validatearray);


        $storedata=[
                "um_email"=>strtolower(trim($request->um_email)),
                "um_mobile"=>$request->um_mobile,
                "um_first_name"=>$request->um_first_name,

                "um_last_name"=>$request->um_last_name,
                //"um_password"=>Hash::make($request->um_password),
                "um_password"=>'',

                "um_status"=>"A",
                "um_gender"=>$request->um_gender,
                "um_user_type"=>$request->um_user_type,
                "um_designation"=>$request->um_designation
            ];

        if($request->um_user_type == "U"){
            if(!empty($request->um_sm_id)){
                $storedata['um_sm_id']=$request->um_sm_id;
                $storedata['um_dm_id']=null;
            }else{
                $storedata['um_dm_id']=$request->um_dm_id;
                $storedata['um_sm_id']=null;
            }
        }

        $user = UserMaster::create($storedata);
        $token = md5(rand(1, 10) . microtime());
        if($user) {
            $user->password_reset_token = $token;
            $user->update();

            //send activation mail
            $active_url = route('user.resetpassword', ['email' => base64_encode($user->um_email), 'key' => base64_encode($token)]);
            //return view('app.email.activateUser', ['active_url' => $active_url, 'name' => $user->um_first_name.' '.$user->um_last_name]);
            try{
                Mail::send('app.email.activateUser', ['active_url' => $active_url, 'name' => $user->um_first_name.' '.$user->um_last_name], function ($m) use ($user) {
                    $m->to($user->um_email, $user->um_first_name . ' ' .$user->um_last_name)->subject('Registration Activation Link');
                });
            } catch (\Exception $e) {
                //continue;
            }
            session()->flash('success',"User Added Successfully");
        }else{
          session()->flash('error',"User not added");
        }

        return redirect()->route('user.index');
    }

    public function resetPassword($email,$key,Request $request){
      $uemail = base64_decode($email);
      $ukey = base64_decode($key);
      $view =view('app.auth.passwords.reset');
      $view->captcha = captcha_src();
      $view->email = $uemail;
      $view->token = $ukey;
      return $view;
    }

    public function forgotPassword(Request $request){
      if ($request->isMethod('post')) {
          

        $request->validate([
            "email"=>"required|email",
            "captcha"=>"required|captcha|min:6|max:6",
        ]);
        // Validator::make($request->all(),[
        //     "email"=>"required|email",
        //     "captcha"=>"required|captcha|min:6|max:6"
        // ],[
        //   'captcha.required' => 'Please enter captcha',
        //   'captcha.captcha' => 'Please enter vaild captcha'
        // ])->validate();
        $user = UserMaster::where('um_email', $request->email)->first();

   
        $token = md5(rand(1, 10) . microtime());
        if($user) {
          $user->password_reset_token = $token;
          $user->update();

          //send reset mail
          $active_url = route('user.resetpassword', ['email' => base64_encode($user->um_email), 'key' => base64_encode($token)]);
         
          //return view('app.email.forgetpass', ['active_url' => $active_url, 'name' => $user->um_first_name.' '.$user->um_last_name]);
          echo "go to this ur and set your password ".($active_url );
         dd();
        //   try{

        //       Mail::send('app.email.forgetpass', ['active_url' => $active_url, 'name' => $user->um_first_name.' '.$user->um_last_name], function ($m) use ($user) {
        //           $m->to($user->um_email, $user->um_first_name . ' ' .$user->um_last_name)->subject('We received a password reset request');
        //       });
        //   } catch (\Exception $e) {
        //       dd($e);
        //   }
          session()->flash('success',"An Email has been sent to reset your password !!");
          return redirect()->route('login.index');
        } else {
          session()->flash('error',"User does not exist !!");
          return redirect()->route('login.index');
        }
      }
      $view =view('app.auth.passwords.forgot');
      $view->captcha = captcha_src();
      return $view;
    }

    public function updatePassword(Request $request){
      Validator::make($request->all(),[
          "email"=>"required|email",
          'token' => 'required',
          'password' => 'required|min:8|max:100|same:password_confirmation',
          'password_confirmation' => 'required|min:8',
          "captcha"=>"required|captcha|min:6|max:6",
      ],[
        'captcha.required' => 'Please enter captcha',
        'captcha.captcha' => 'Please enter vaild captcha'
      ])->validate();
      $user = UserMaster::where('um_email', $request->email)->first();
      $uph=UserPasswordHistory::orderBy('UPH_ID','desc')->take(3)->where('UPH_UM_ID', $user->um_id)->get();
      $flag = false;
      if($uph){
          foreach($uph as $up){
             if ($up->UPH_PASSWORD == $request->password){
              $flag = true;
             break;
             }
          }
          if($flag){
          session()->flash('error',"New Password does not same with previous three password!!");
          return redirect()->back();
         }
      }

      if($user->password_reset_token == $request->token) {
        $user->um_password = trim($request->password);
        $user->password_reset_token = '';
        $user->update();
        UserPasswordHistory::create([
            'UPH_UM_ID'=>$user->um_id,
            'UPH_PASSWORD'=>$request->password
        ]);
        session()->flash('success', 'Password changed successfully !!');
        return redirect()->route('home.index');
      } else {
        session()->flash('error',"Password reset link has been expired, please regenerate it !!");
        return redirect()->route('login.index');
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = DepartmentMaster::where('dm_status','A')->get();
        $role= Role::select('role_id','role','role_full_name')->get();
        $edituser =UserMaster::where('um_id',$id)->first();
        $section='';  $fullsection='';

        if($edituser->um_sm_id){
            $section = SectionMaster::where('sm_id',$edituser->um_sm_id)->first();
            $fullsection = SectionMaster::where('sm_dm_id',$section->sm_dm_id)->get();
        }
    // dd(  $section->sm_dm_id );
        $role= Role::select('role_id','role','role_full_name')->get();
        return view('app.user.usercreate',compact('edituser','department','role','section','fullsection'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd(Session::get('user')['um_id']);
        // dd($id);
    
        $validatearray=[
            "um_email"=>'required|max:255|unique:user_master,um_email,'.$id.',um_id',
            "um_mobile"=>"required|min:10|max:10",
            "um_first_name"=>'required|max:100',
            "um_last_name"=>"max:100",

            "um_status"=>"required|in:A,I",
            "um_gender"=>"required|in:M,F,O",
            "um_user_type"=>"required|in:A,MA,U",
            "um_designation"=>"max:255"
        ];
        if($request->um_user_type == "U"){
            $validatearray['um_dm_id']="required";
            if(!empty($request->um_sm_id)){$validatearray['um_sm_id']="required";  }
        }

        $request->validate($validatearray);
        // if($request->um_user_type == "D"){$validatearray['um_dm_id']="required";  }
        // if($request->um_user_type == "S"){$validatearray['um_sm_id']="required";  }
        $storedata=[
            "um_email"=>strtolower($request->um_email),
            "um_mobile"=>$request->um_mobile,
            "um_first_name"=>$request->um_first_name,
            "um_last_name"=>$request->um_last_name,

            "um_status"=>$request->um_status,
            "um_gender"=>$request->um_gender,
            "um_user_type"=>$request->um_user_type,
            "um_designation"=>$request->um_designation
        ];
        // if($request->um_user_type == "D"){$storedata['um_dm_id']=$request->um_dm_id;
        //     $storedata['um_sm_id']="";  }
        // if($request->um_user_type == "S"){$storedata['um_sm_id']=$request->um_sm_id;
        //     $storedata['um_dm_id']=""; }
        if($request->um_user_type == "U"){

            if(!empty($request->um_sm_id)){
                $storedata['um_sm_id']=$request->um_sm_id;
                $storedata['um_dm_id']=null;
            }else{
                $storedata['um_dm_id']=$request->um_dm_id;
                $storedata['um_sm_id']=null;
            }
        }
        UserMaster::where('um_id',$id)->update($storedata);
        session()->flash('success',"User Updated Successfully !!");
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserMaster::where('um_id',$id)->update([
            "um_status"=>'D'
        ]);
        // UserMaster::where('um_id',$id)->delete();
        session()->flash('success',"User Deleted Successfully !!");
        return redirect()->route('user.index');
    }

    public function passwordreset(){
        return view('app.passwordreset.passwordreset');
    }
    public function passwordresetStore(Request $request){
        $request->validate([
            "old_password"=>"required|min:8|max:100",
            "new_password"=>"required|min:8|max:100",
            "confirm_password"=>"required|min:8|max:100",

        ]);
        if( $request->new_password != $request->confirm_password){
            session()->flash('error',"New Password and Confirm password does not matched !!");
            return redirect()->route('user.passwordreset');
        }
        $um_id = Session::get('user')['um_id'];
        $u=UserMaster::where('um_id', $um_id)->first();

        if($u){
            $status=Hash::check(trim($request->old_password),$u->um_password);
            if($status){
                $uph=UserPasswordHistory::orderBy('UPH_ID','desc')->take(3)->where('UPH_UM_ID', $um_id)->get();
               
                $flag = false;
                if($uph){
                    foreach($uph as $up){
                      
                       if ($up->UPH_PASSWORD == $request->new_password){
                        $flag = true;
                       break;
                       }
                    }
                 
                    if($flag){
                    session()->flash('error',"New Password does not same with previous three password!!");
                 
                    return redirect()->route('user.passwordreset');
                   }
                }
                $hasedpassword = Hash::make(trim($request->new_password));
                UserMaster::where('um_id',$um_id)->update([
                        "um_password"=> $hasedpassword
                ]);
                UserPasswordHistory::create([
                    'UPH_UM_ID'=>$um_id,
                    'UPH_PASSWORD'=>$request->new_password
                ]);
                
                 return $this->logout();
                // return redirect()->route('user.logout',['type'=>1]);
            }else{
                session()->flash('error',"Old Password does not matched with your given password!!");
               
                return redirect()->route('user.passwordreset');
            }
        }else{
            return redirect()->route('user.logout');
        }


    }

    public function faq(){
        return view('app.faq.faq');
    }


    public function logout(){
        unset($_COOKIE['authkey']);
        setcookie("authkey", "", time()-3600);
  
        Session::flush();
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        session()->flash('success',"Password Changed Successfully, Please Login !!");
        return redirect()->route('login.index');
    }

}
