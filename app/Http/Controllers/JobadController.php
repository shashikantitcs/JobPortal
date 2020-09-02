<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobAd;
use Validator;
use Session;
use DB;
class JobadController extends Controller
{
    //

    public function fresherjobad(){
        $fjobad =JobAd::latest('ja_id')->where('ja_type','F')->get();
       // dd($fjobad[0]->ja_id);
        return view('app.jobad.fresheradlist',compact('fjobad'));
    }

    public function deputationjobad(){
        $djobad =JobAd::latest('ja_id')->where('ja_type','D')->get();
       //dd($djobad[0]->ja_id);
        return view('app.jobad.deputationadlist',compact('djobad'));
    }

    public function create()
    {
        // $user=UserMaster::where('um_user_type','U')->select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        // dd($user);
        return view('app.jobad.createjobad',compact('user'));
    }

    public function store(Request $request)
    {
      // dd($request->all());
      $validateData = [
          'ja_post'=>'required|max:255',
          'ja_no_of_post'=>'required',
          'ja_max_age'=>'required',
          'ja_last_date_submission'=>'required',
          'ja_type'=>'required|in:F,D'
      ];
      if($request->ja_type == 'F'){
        $validateData['ja_classification']='required';
        $validateData['ja_particulars_of_pay']='required';
        $validateData['ja_qualification']='required';
        $validateData['ja_eligibilty']='required';
      }
      if($request->ja_type == 'D'){
        $validateData['ja_pay_scale']='required';
      }
      $request->validate($validateData);
      $storedata = [
        'ja_post'=>strtolower($request->ja_post),
        'ja_no_of_post'=>$request->ja_no_of_post,
        'ja_max_age'=>$request->ja_max_age,
        'ja_last_date_submission'=>$request->ja_last_date_submission,
        'ja_type'=>$request->ja_type
      ];
      if($request->ja_type == 'F'){
        $storedata['ja_classification']=$request->ja_classification;
        $storedata['ja_particulars_of_pay']=$request->ja_particulars_of_pay;
        $storedata['ja_qualification']=$request->ja_qualification;
        $storedata['ja_eligibilty']=$request->ja_eligibilty;
        $route = 'jobad.index';
      }
      if($request->ja_type == 'D'){
        $storedata['ja_pay_scale']=$request->ja_pay_scale;
        $route = 'jobad.deputationjobad';
      }
      $storedata['ja_um_id']=Session::get('user')['um_id'];
        JobAd::create($storedata);
        session()->flash('success',"Job Ad Added Successfully");
        return redirect()->route($route);
    }

}
