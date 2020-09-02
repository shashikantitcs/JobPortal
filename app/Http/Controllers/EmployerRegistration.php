<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserMaster;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use Mail;
class EmployerRegistration extends Controller
{
    

    public function store(Request $request)
    {   
        // dd($request->all());
        $validatearray=[
            //"um_email"=>'required|max:255|unique:user_master',
            "um_email"=>'required|max:255|unique:user_master',
            "um_mobile"=>"required|min:10|max:10",
            "um_first_name"=>'required|max:100',
            "um_last_name"=>"max:100",
            "um_password"=>"required|min:8",
            // "um_status"=>"required|in:A",
            "um_gender"=>"required|in:M,F,O",
            "um_department_name"=>"required",
            "um_company_name"=>"required",
            "um_address_line_1"=>"required",
            "um_city"=>"required",
            "um_state"=>"required",
            "um_zip_code"=>"required",
            // "um_user_type"=>"required|in:A,MA,U",
            // "um_designation"=>"max:255"
        ];
        // if($request->um_user_type == "U"){
        //     $validatearray['um_dm_id']="required";
        //     if(!empty($request->um_sm_id)){$validatearray['um_sm_id']="required";  }
        // }

        $request->validate($validatearray);


        $storedata=[
            "um_first_name"=>$request->um_first_name,
            "um_last_name"=>$request->um_last_name,
            "um_email"=>$request->um_email,
            "um_password"=>Hash::make($request->um_password),
            "um_mobile"=>$request->um_mobile,
            "um_gender"=>$request->um_gender,
            "um_first_name"=>$request->um_first_name,
            "um_department_name"=>$request->um_first_name,
            "um_company_name"=>$request->um_first_name,
            "um_gstin"=>$request->um_gstin,
            "um_address_line_1"=>$request->um_address_line_1,
            "um_address_line_2"=>$request->um_address_line_2,
            "um_city"=>$request->um_city,
            "um_state"=>$request->um_state,
            "um_zip_code"=>$request->um_zip_code,
            "um_user_type"=>'E',
            "um_user_islocked"=>2,
            "um_status"=>'A',
            ];

        $user = UserMaster::create($storedata);
    
        $token = md5(rand(1, 10) . microtime());
        if($user) {
            $user->password_reset_token = $token;
            $user->update();

            //send activation mail
            $active_url = route('user.resetpassword', ['email' => base64_encode($user->um_email), 'key' => base64_encode($token)]);
            // echo $active_url;die(); 
           
            //return view('app.email.activateUser', ['active_url' => $active_url, 'name' => $user->um_first_name.' '.$user->um_last_name]);
            try{
                Mail::send('app.email.activateUser', ['active_url' => $active_url, 'name' => $user->um_first_name.' '.$user->um_last_name], function ($m) use ($user) {
                    $m->to($user->um_email, $user->um_first_name . ' ' .$user->um_last_name)->subject('Registration Activation Link');
                });
            } catch (\Exception $e) {
                //continue;
            }
            session()->flash('success',"Employer Added Successfully verification link seneded to
            account");
        }else{
          session()->flash('error',"Employer not added");
        }

        return redirect()->route('home.index');
    }
}
