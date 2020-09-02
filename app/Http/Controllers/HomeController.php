<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserMaster;
use App\MeetingMaster;
use App\AgendaMaster;
use Validator;
use Session;
use DB;

class HomeController extends Controller
{
    //

    public function index(){
        // dd('sdsdd');
        $ucount=  UserMaster::where('um_user_type','U')
                    ->where('um_status','!=','D')->count();
        $ca = DB::table('agenda_master')->where('am_actual_completion_date','!=',null)
        ->where('is_deleted','0')->count();
        $oa=DB::table('agenda_master')->select('am_expected_completion_date')->where('am_actual_completion_date',null)->where('is_deleted','0')->whereDate('am_expected_completion_date','<',DATE(NOW()))->count();
        $pa=DB::table('agenda_master')->select('am_expected_completion_date')->where('am_um_id',Session::get('user')['um_id'])->where('am_actual_completion_date',null)->where('is_deleted','0')->whereDate('am_expected_completion_date','>=',DATE(NOW()))->count();

        $m =  DB::table('meeting_master')->select('mm_status',DB::raw('count(*) as total'))->groupBy('mm_status')->get();
        $meeting=['A'=>0,'C'=>0];
        for($i=0; $i<count($m);$i++){
          if($m[$i]->mm_status == 'A'){
              $meeting['A']= $m[$i]->total;
          } 
          if($m[$i]->mm_status == 'C'){
              $meeting['C']= $m[$i]->total;
          }  
        }
        
        $completedMeeting = "SELECT * FROM meeting_master JOIN( SELECT * FROM meeting_schedule WHERE ms_id IN (SELECT max(ms_id) FROM `meeting_schedule` GROUP BY ms_mm_id) ) md on md.ms_mm_id = meeting_master.mm_id JOIN user_master ON user_master.um_id = md.ms_chaired_by WHERE meeting_master.mm_status = 'C' AND md.ms_meeting_date  BETWEEN DATE_SUB(NOW(),INTERVAL 10 DAY) AND DATE(NOW())";
        
        $UpcommingMeeting = "SELECT * FROM meeting_master JOIN( SELECT * FROM meeting_schedule WHERE ms_id IN (SELECT max(ms_id) FROM `meeting_schedule` GROUP BY ms_mm_id) ) md on md.ms_mm_id = meeting_master.mm_id JOIN user_master ON user_master.um_id =  md.ms_chaired_by WHERE meeting_master.mm_status != 'C' AND md.ms_meeting_date BETWEEN DATE(NOW()) AND DATE_ADD(NOW(),INTERVAL 10 DAY)";
        // echo  $completedMeeting; die();
        $cMeeting= DB::select($completedMeeting);
        $uMeeting= DB::select($UpcommingMeeting);
        // dd($uMeeting);
        $homeResultarray =[
            'ca'=>$ca,
            'oa' =>$oa,
            'pa'=>$pa,
            'meeting'=>$meeting,
            'cMeeting'=>$cMeeting,
            'uMeeting'=>$uMeeting,
            'uCount'=>$ucount
        ];
       

    
        $view= view('app.landingpage.landingpage',$homeResultarray);
        $view->captcha = captcha_src();
        return $view; 
    }
}
