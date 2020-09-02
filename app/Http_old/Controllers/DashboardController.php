<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserMaster;
use App\MeetingMaster;
use App\AgendaMaster;
use Validator;
use Session;
use DB;

class DashboardController extends Controller
{
    //

    public function index(){
        $um_id = Session::get('user')['um_id'];
        $um_user_type = Session::get('user')['um_user_type'];
        if($um_user_type == 'A'){
          $ca = DB::table('agenda_master')->where('am_actual_completion_date','!=',null)
          ->where('is_deleted','0')->count();
        }else{
          $ca = DB::table('agenda_master')->where('am_actual_completion_date','!=',null)
          ->where('is_deleted','0')->where('am_um_id',Session::get('user')['um_id'])->count();
        }
        if($um_user_type == 'A'){
          $oa=DB::table('agenda_master')->select('am_expected_completion_date')->where('am_actual_completion_date',null)->where('is_deleted','0')->whereDate('am_expected_completion_date','<',DATE(NOW()))->count();
        }else{
          $oa=DB::table('agenda_master')->select('am_expected_completion_date')->where('am_um_id',Session::get('user')['um_id'])->where('am_actual_completion_date',null)->where('is_deleted','0')->whereDate('am_expected_completion_date','<',DATE(NOW()))->count();
        }
        if($um_user_type == 'A'){
          $pa=DB::table('agenda_master')->select('am_expected_completion_date')->where('am_actual_completion_date',null)->where('is_deleted','0')->whereDate('am_expected_completion_date','>=',DATE(NOW()))->count();
        }else{
          $pa=DB::table('agenda_master')->select('am_expected_completion_date')->where('am_um_id',Session::get('user')['um_id'])->where('am_actual_completion_date',null)->where('is_deleted','0')->whereDate('am_expected_completion_date','>=',DATE(NOW()))->count();
        } 
        // for admin meeting admin
        if($um_user_type == 'A' || $um_user_type == 'MA'){
       
          $ucount=  UserMaster::where('um_user_type','U')
                    ->where('um_status','!=','D')->count();
         
         // dd( $ucount);
         if($um_user_type == 'A'){
          $m =  DB::table('meeting_master')->select('mm_status',DB::raw('count(*) as total'))->groupBy('mm_status')->get();
         }else{
            $m =  DB::table('meeting_master')->select('mm_status',DB::raw('count(*) as total'))->where('mm_um_id',Session::get('user')['um_id'])->groupBy('mm_status')->get();
         }
        
        //   $m->groupBy('mm_status')->get();
       
          $meeting=['A'=>0,'C'=>0];
          for($i=0; $i<count($m);$i++){
            if($m[$i]->mm_status == 'A'){
                $meeting['A']= $m[$i]->total;
            } 
            if($m[$i]->mm_status == 'C'){
                $meeting['C']= $m[$i]->total;
            }  
          }
     
        //  dd($pa);
           $mquery = "SELECT mm.mm_id,mm.mm_um_id,mm.mm_title,mm.mm_description,mm.mm_status,um.um_email,um.um_first_name,um.um_last_name,um.um_designation,msc.ms_id,msc.ms_meeting_notice,msc.ms_meeting_date,msc.ms_meeting_time,msc.ms_mm_id,msc.ms_status,msc.ms_chaired_by FROM meeting_schedule msc INNER JOIN (SELECT max(ms.ms_id) mid FROM `meeting_schedule` ms GROUP BY ms.ms_mm_id) mn_ms ON msc.ms_id = mn_ms.mid INNER JOIN user_master um ON um.um_id = msc.ms_chaired_by INNER JOIN meeting_master mm ON msc.ms_mm_id = mm.mm_id WHERE mm.mm_status != 'D' ";
           $mquery .="AND DATE(msc.ms_meeting_date) = DATE(NOW())";
           if($um_user_type == 'MA'){
            $mquery .= " AND mm.mm_um_id = $um_id";
           } 
          $todayMeeting= DB::select($mquery);
        // dd( $todayMeeting);
          if($um_user_type == 'A'){
            $agendaOverdue = DB::table('agenda_master')->select('am_id','mm_title','mm_status','am_mm_id','am_expected_completion_date')->where('meeting_master.mm_status','A')->where('am_actual_completion_date',null)->where('is_deleted','0')->whereDate('am_expected_completion_date','<',DATE(NOW()))
            ->join('meeting_master','meeting_master.mm_id','=','agenda_master.am_mm_id')
            ->get();
          }else{
            $agendaOverdue = DB::table('agenda_master')->select('am_id','mm_title','mm_status','am_mm_id','am_expected_completion_date')->where('meeting_master.mm_status','A')
            ->where('meeting_master.mm_um_id',$um_id)->where('am_actual_completion_date',null)->where('is_deleted','0')->whereDate('am_expected_completion_date','<',DATE(NOW()))
            ->join('meeting_master','meeting_master.mm_id','=','agenda_master.am_mm_id')
            ->get();
          }
          $agendaOverdueArry=[];
          foreach($agendaOverdue as $aoarry){
              if(isset($agendaOverdueArry[$aoarry->am_mm_id])){
                $agendaOverdueArry[$aoarry->am_mm_id]['count'] +=1;
              }else{
                $agendaOverdueArry[$aoarry->am_mm_id]=[
                    'mm_title'=>$aoarry->mm_title,
                    'mm_status'=>$aoarry->mm_status,
                    'am_mm_id'=>$aoarry->am_mm_id,
                    'count'=>1
                ];
              }
          }
        
         $adminResult = ['ucount'=>$ucount,'m'=> $m,'meeting'=>$meeting,'ca'=>$ca,'oa'=>$oa
         ,'pa'=>$pa,'todayMeeting'=>$todayMeeting,'agendaOverdueArry'=>$agendaOverdueArry];
         return view('app.dashboard.adashboard',$adminResult);
        }else{
          $mquery = "SELECT mm.mm_id,mm.mm_um_id,mm.mm_title,mm.mm_description,mm.mm_status,msc.ms_id,msc.ms_meeting_notice,msc.ms_meeting_date,msc.ms_meeting_time,msc.ms_mm_id,msc.ms_status, mm.mm_status,msc.ms_chaired_by,am.am_id FROM meeting_schedule msc INNER JOIN (SELECT max(ms.ms_id) mid FROM `meeting_schedule` ms GROUP BY ms.ms_mm_id) mn_ms ON msc.ms_id = mn_ms.mid INNER JOIN meeting_master mm ON msc.ms_mm_id = mm.mm_id INNER JOIN agenda_master am ON am.am_mm_id=mm.mm_id INNER JOIN  agenda_user_mapping aum ON aum.aum_am_id = am.am_id  WHERE mm.mm_status != 'D' AND am.is_deleted = 0 AND aum.aum_status = 'A' AND aum.aum_um_id = $um_id AND DATE(msc.ms_meeting_date) = DATE(NOW())";
          $queryMeeting= DB::select($mquery);
        
          $todayMeeting=[];
          $checkarray=[];
          foreach($queryMeeting as $qm){
            if(!in_array($qm->mm_id, $checkarray)){
              $todayMeeting[]=$qm;
              $checkarray[]=$qm->mm_id;
            }
          }

          
          $agquery = "SELECT mm.mm_id,mm.mm_um_id,mm.mm_title,mm.mm_description,mm.mm_status,msc.ms_id,msc.ms_meeting_notice,msc.ms_meeting_date,msc.ms_meeting_time,msc.ms_mm_id,msc.ms_status,am.am_actual_completion_date,am.am_expected_completion_date, mm.mm_status,msc.ms_chaired_by,am.am_id,am.am_mm_id FROM meeting_schedule msc INNER JOIN (SELECT max(ms.ms_id) mid FROM `meeting_schedule` ms GROUP BY ms.ms_mm_id) mn_ms ON msc.ms_id = mn_ms.mid INNER JOIN meeting_master mm ON msc.ms_mm_id = mm.mm_id INNER JOIN agenda_master am ON am.am_mm_id=mm.mm_id INNER JOIN  agenda_user_mapping aum ON aum.aum_am_id = am.am_id  WHERE mm.mm_status != 'D' AND am.is_deleted = 0 AND aum.aum_status = 'A' AND aum.aum_um_id = $um_id AND am.am_actual_completion_date IS NULL AND DATE(am.am_expected_completion_date) < DATE(NOW())";
          $agendaOverdue =  DB::select($agquery);
          $agendaOverdueArry=[];
          foreach($agendaOverdue as $aoarry){
              if(isset($agendaOverdueArry[$aoarry->mm_id])){
                $agendaOverdueArry[$aoarry->mm_id]['count'] +=1;
              }else{
                $agendaOverdueArry[$aoarry->mm_id]=[
                    'mm_title'=>$aoarry->mm_title,
                    'mm_status'=>$aoarry->mm_status,
                    'am_mm_id'=>$aoarry->mm_id,
                    'count'=>1
                ];
              }
          }
          
          // dd( $agendaOverdueArry);
       
          $adminResult = ['ca'=>$ca,'oa'=>$oa,'pa'=>$pa,'todayMeeting'=>$todayMeeting,
          'agendaOverdueArry'=>$agendaOverdueArry];
          return view('app.dashboard.adashboard',$adminResult);
       
        }       
    }

    public function getCalendarData(Request $request){
      // dd($request->all());
      $um_user_type = Session::get('user')['um_user_type'];
      $um_id = Session::get('user')['um_id'];
      if($um_user_type == 'A' || $um_user_type == 'MA'){
      $calendarData = "SELECT mm.mm_id,mm.mm_um_id,mm.mm_title,mm.mm_description,mm.mm_status,um.um_email,um.um_first_name,um.um_last_name,um.um_designation,msc.ms_id,msc.ms_meeting_notice,msc.ms_meeting_date,msc.ms_meeting_time,msc.ms_mm_id,msc.ms_status,msc.ms_chaired_by FROM meeting_schedule msc INNER JOIN (SELECT max(ms.ms_id) mid FROM `meeting_schedule` ms GROUP BY ms.ms_mm_id) mn_ms ON msc.ms_id = mn_ms.mid INNER JOIN user_master um ON um.um_id = msc.ms_chaired_by INNER JOIN meeting_master mm ON msc.ms_mm_id = mm.mm_id WHERE mm.mm_status != 'D' ";
      if($request->month){
        // $calendarData .= "AND MONTH(msc.ms_meeting_date) = MONTH($request->month) AND YEAR(msc.ms_meeting_date) = YEAR($request->year)";
        $calendarData .= "AND DATE_FORMAT(msc.ms_meeting_date,'%m') = $request->month AND DATE_FORMAT(msc.ms_meeting_date,'%Y') = $request->year";
      }else{
        $calendarData .= " AND MONTH(msc.ms_meeting_date) = MONTH(NOW()) AND YEAR(msc.ms_meeting_date) = YEAR(NOW())";
      }
      
      if($um_user_type == 'MA'){
        $calendarData .= " AND mm.mm_um_id = $um_id";
       } 
      //  dd($calendarData);
      $calendararry= DB::select($calendarData);
      // dd($calendararry);
      $data =[];
       foreach( $calendararry as $ca){
        if($ca->ms_status == 'O'){
          $back = 'blue';
        }else if($ca->ms_status == 'P'){
          $back = 'yellow';
        }else if($ca->ms_status == 'C'){
          $back = 'green';
        }else{
          $back = 'red';
        }
        $data[]=array('title'=>$ca->mm_title,'start'=>$ca->ms_meeting_date.'T'.$ca->ms_meeting_time,
        'end'=>$ca->ms_meeting_date,'backgroundColor'=>$back,'textColor'=>'white','url'=>route('meetingschedule.edit',['meetingschedule'=>$ca->mm_id]));
       
       }
       $result=array('data'=> $data);
      }else{
        $calendarData = "SELECT mm.mm_id,mm.mm_um_id,mm.mm_title,mm.mm_description,mm.mm_status,msc.ms_id,msc.ms_meeting_notice,msc.ms_meeting_date,msc.ms_meeting_time,msc.ms_mm_id,msc.ms_status, mm.mm_status,msc.ms_chaired_by,am.am_id FROM meeting_schedule msc INNER JOIN (SELECT max(ms.ms_id) mid FROM `meeting_schedule` ms GROUP BY ms.ms_mm_id) mn_ms ON msc.ms_id = mn_ms.mid INNER JOIN meeting_master mm ON msc.ms_mm_id = mm.mm_id INNER JOIN agenda_master am ON am.am_mm_id=mm.mm_id INNER JOIN  agenda_user_mapping aum ON aum.aum_am_id = am.am_id  WHERE mm.mm_status != 'D' AND am.is_deleted = 0 AND aum.aum_status = 'A' AND aum.aum_um_id = $um_id";
        
        if($request->month){
          // $calendarData .= "AND MONTH(msc.ms_meeting_date) = MONTH($request->month) AND YEAR(msc.ms_meeting_date) = YEAR($request->year)";
          $calendarData .= " AND DATE_FORMAT(msc.ms_meeting_date,'%m') = $request->month AND DATE_FORMAT(msc.ms_meeting_date,'%Y') = $request->year";
        }else{
          $calendarData .= " AND MONTH(msc.ms_meeting_date) = MONTH(NOW()) AND YEAR(msc.ms_meeting_date) = YEAR(NOW())";
        }
        $calendarData .= " GROUP BY msc.ms_id";
       
        $calendararry= DB::select($calendarData);
      //  dd($calendararry);
        $data =[];
        foreach( $calendararry as $ca){
         if($ca->ms_status == 'O'){
           $back = 'blue';
         }else if($ca->ms_status == 'P'){
           $back = 'yellow';
         }else if($ca->ms_status == 'C'){
           $back = 'green';
         }else{
           $back = 'red';
         }
         $data[]=array('title'=>$ca->mm_title,'start'=>$ca->ms_meeting_date.'T'.$ca->ms_meeting_time,
         'end'=>$ca->ms_meeting_date,'backgroundColor'=>$back,'textColor'=>'white','url'=>route('meetingschedule.edit',['meetingschedule'=>$ca->mm_id]));
        
        }
        $result=array('data'=> $data);
      }
       return response()->json($result);   
    }

  
}
