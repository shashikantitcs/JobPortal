<?php

namespace App\Http\Controllers;
use App\MeetingMaster;
use App\UserMaster;
use App\AgendaMaster;
use App\MeetingSchedule;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;
class MeetingScheduleController extends Controller
{
  public $user = null;

  public function __construct(){
    $this->middleware(function ($request, $next) {
      $this->user = (Object)Session::get('user');
      return $next($request);
    });
  }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  // public function index()
  // {
  //    $msl= DB::select("SELECT mm.mm_id,mm.mm_title,mm.mm_description,mm.mm_status,um.um_email,um.um_first_name,um.um_last_name,um.um_designation,msc.ms_id,msc.ms_meeting_notice,msc.ms_meeting_date,msc.ms_meeting_time,msc.ms_mm_id,msc.ms_status,msc.ms_chaired_by FROM meeting_schedule msc INNER JOIN (SELECT max(ms.ms_id) mid FROM `meeting_schedule` ms GROUP BY ms.ms_mm_id) mn_ms ON msc.ms_id = mn_ms.mid INNER JOIN user_master um ON um.um_id = msc.ms_chaired_by INNER JOIN meeting_master mm ON msc.ms_mm_id = mm.mm_id");

  //    return view('app.dashboard.allschedulemeeting',compact('msl'));
  // }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    // dd('dssdd');
    $where = '';
    if($this->user->um_user_type != 'A'){
      $where = "and ( mm.mm_um_id = ".$this->user->um_id." OR am.am_um_id = ".$this->user->um_id." OR atl.atl_um_id = ".$this->user->um_id." OR (aum.aum_um_id = ".$this->user->um_id." and aum.aum_status = 'A'))";
    }
    $qry = "SELECT * FROM `meeting_master` mm INNER JOIN meeting_schedule ms on ms.ms_mm_id = mm.mm_id
    INNER JOIN user_master um ON um.um_id = ms.ms_chaired_by
    LEFT JOIN agenda_master am on mm.mm_id = am.am_mm_id
    LEFT JOIN agenda_task_list atl ON am.am_id = atl.atl_am_id
    LEFT JOIN agenda_user_mapping aum ON am.am_id = aum.aum_am_id
    WHERE mm.mm_id= $id $where GROUP BY ms_id";
    // dd($qry);
    $umsl= DB::select($qry);
    // dd( $umsl);
    if($this->user->um_user_type != 'A'){
      $where = " and (am.am_um_id = ".$this->user->um_id." OR atl.atl_um_id = ".$this->user->um_id." OR aum.aum_um_id = ".$this->user->um_id.")";
    }

    if($umsl){
      $qry = "SELECT * FROM `agenda_master` am INNER JOIN user_master um ON um.um_id = am.am_um_id
      LEFT JOIN agenda_task_list atl ON am.am_id = atl.atl_am_id
      LEFT JOIN agenda_user_mapping aum ON am.am_id = aum.aum_am_id
      WHERE am.am_mm_id= $id $where GROUP BY am_id";
      $agenda= DB::select($qry);
    }
    //  dd($agenda);
    $department = DB::table('department_master')
    ->where('dm_status','=','A')
    ->select('dm_id','dm_name','dm_short_name','dm_status')
    ->get();
    $agendaUsers = [];
    if($umsl){
    $agendaUsersQry = AgendaMaster::where('am_mm_id',$umsl[0]->am_mm_id)->where('aum_status','A')->join('agenda_user_mapping','agenda_master.am_id','=','agenda_user_mapping.aum_am_id')->get();
    $user=UserMaster::select('um_id','um_email','um_user_type','um_first_name','um_last_name','um_designation')->get();
      foreach($agendaUsersQry as $agqry){
          $agendaUsers[$agqry->am_id][] = $agqry->aum_um_id;
      } 
    }
    // dd()
    //  dd($agendaUsers);
    return view('app.schedulemeeting.allschedulemeeting',compact('umsl','user','agenda','department','agendaUsers'));

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
    $meeting = DB::table('meeting_schedule')
    ->where('ms_id','=',$id)
    ->join('meeting_master', 'meeting_master.mm_id', '=', 'meeting_schedule.ms_mm_id')
    ->first();
    //dd($request->all());
    $request->validate([
      "ms_status"=>"required|in:C,P,CA",
    ]);
    if($request->ms_status == 'P'){
      $request->validate([
        "ms_meeting_date"=>"required",
        "ms_meeting_time"=>"required",
        "ms_chaired_by"=>"required"
      ]);
      $ms=MeetingSchedule::where('ms_id',$id)->first();
      if($ms->ms_status != 'C'){
        MeetingSchedule::where('ms_id',$id)->update([
          "ms_status"=>"P"
        ]);
      }
      $user_id = Session::get('user')['um_id'];
      MeetingSchedule::create([
        "ms_meeting_notice"=>$request->ms_meeting_notice,
        "ms_meeting_date"=>$request->ms_meeting_date,
        "ms_meeting_time"=>$request->ms_meeting_time,
        "ms_mm_id"=>$meeting->mm_id,
        "ms_status"=>"O",
        "ms_chaired_by"=>$request->ms_chaired_by,
        "ms_created_by"=>$user_id
      ]);
      session()->flash('success',"Meeting Scheduled Successfully");
    }else{
      MeetingSchedule::where('ms_id',$id)->update([
        "ms_status"=>$request->ms_status
      ]);
      if($request->ms_status == 'C'){
        $flag = "Concluded";
      }
      if($request->ms_status == 'CA'){
        $flag = "Cancelled";
      }
      // MeetingMaster::where('mm_id',$meeting->ms_mm_id)->update([
      //     "mm_status"=>"C"
      // ]);
      session()->flash('success',"Meeting ".$flag." Successfully");
    }
    return redirect()->back();
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //
  }
}
