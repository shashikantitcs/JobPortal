<?php

namespace App\Http\Controllers;
use App\MeetingMaster;
use App\MeetingSchedule;
use App\UserMaster;
use App\Role;
use Illuminate\Http\Request;
use Validator;
use Session;
use DB;
class MeetingMasterController extends Controller
{
    public $user = null;
    public function __construct(){
      $this->middleware(function ($request, $next) {
        $this->user = (Object)Session::get('user');
      return $next($request);
      });
    }
    public function index()
    {
        // dd($this->user);
        $where = '';
        if($this->user->um_user_type != 'A'){
          $where = "where mm.mm_um_id = ".$this->user->um_id." OR am.am_um_id = ".$this->user->um_id." OR atl.atl_um_id = ".$this->user->um_id." OR (aum.aum_um_id = ".$this->user->um_id." and aum.aum_status = 'A')";
        } 
        $qry = "SELECT mm.mm_id,mm.mm_title,mm.mm_description,mm.mm_status,um.um_email,um.um_first_name,
        um.um_last_name,um.um_designation,msc.ms_id,msc.ms_meeting_notice,msc.ms_meeting_date,msc.ms_meeting_time,msc.ms_mm_id,msc.ms_status,msc.ms_chaired_by
        FROM meeting_schedule msc INNER JOIN (SELECT max(ms.ms_id) mid FROM `meeting_schedule` ms GROUP BY ms.ms_mm_id) mn_ms ON msc.ms_id = mn_ms.mid
        INNER JOIN user_master um ON um.um_id = msc.ms_chaired_by INNER JOIN meeting_master mm ON msc.ms_mm_id = mm.mm_id
        LEFT JOIN agenda_master am on mm.mm_id = am.am_mm_id
        LEFT JOIN agenda_task_list atl ON am.am_id = atl.atl_am_id
        LEFT JOIN agenda_user_mapping aum ON am.am_id = aum.aum_am_id
        $where GROUP BY mm.mm_id";
        $meeting= DB::select($qry);
        // dd( $meeting);
        // $meeting = DB::table('meeting_master')
        // ->select('mm_id','mm_title','mm_description','um_first_name','um_last_name','um_email','mm_status')
        // ->join('user_master', 'user_master.um_id', '=', 'meeting_master.mm_um_id')
        // ->get();
      //dd($meeting);
        return view('app.meeting.allmeeting',compact('meeting'));
    }

    public function create()
    {
        $user=UserMaster::where('um_user_type','U')->select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        // dd($user);
        return view('app.meeting.meetingcreate',compact('user'));
    }

    public function store(Request $request)
    {
      // dd($request->all());
        $request->validate([
            "mm_title"=>"required|max:255",
            "ms_meeting_date"=>"required",
            "ms_meeting_time"=>"required",
            "ms_chaired_by"=>"required",
        ]);
        $user_id = Session::get('user')['um_id'];
        $mm= MeetingMaster::create([
            "mm_title"=>strtolower($request->mm_title),
            "mm_description"=>$request->mm_description,
            "mm_um_id"=>$user_id,
            "mm_status"=>"A"
        ]);
        $ms= MeetingSchedule::create([
            "ms_meeting_notice"=>strtolower($request->ms_meeting_notice),
            "ms_meeting_date"=>$request->ms_meeting_date,
            "ms_meeting_time"=>$request->ms_meeting_time,
            "ms_mm_id"=>$mm->mm_id,
            "ms_status"=>"O",
            "ms_chaired_by"=>$request->ms_chaired_by,
            "ms_created_by"=>$user_id
        ]);
        // dd($mm->mm_id);
        session()->flash('success',"Meeting Added Successfully");
        return redirect()->route('meeting.index');
    }

    public function edit($id)
    {

        $editmeeting = DB::table('meeting_master')
        ->latest('meeting_schedule.ms_id')
        ->where('meeting_master.mm_id', $id)
        // ->WhereIn('mm_status',['A','C'])
        ->select('mm_id','mm_title','mm_description','mm_status','ms_id','ms_meeting_notice','ms_meeting_date','ms_meeting_time','ms_chaired_by','ms_status','um_id','um_first_name','um_last_name','um_email')
        ->join('meeting_schedule', 'meeting_schedule.ms_mm_id', '=', 'meeting_master.mm_id')
         ->join('user_master', 'user_master.um_id', '=', 'meeting_schedule.ms_chaired_by')
        ->first();
    // dd($editmeeting);
        $user=UserMaster::select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        return view('app.meeting.meetingcreate',compact('editmeeting','user'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            "mm_title"=>"required|max:255|unique:meeting_master,mm_title,".$id.",mm_id",
            "mm_status"=>"required|in:A,C",
        ]);
        //
        $mm= MeetingMaster::where('mm_id',$id)->update([
            "mm_title"=>strtolower($request->mm_title),
            "mm_description"=>$request->mm_description,

            "mm_status"=>$request->mm_status
        ]);

        // $updateArray['ms_meeting_notice'] = strtolower($request->ms_meeting_notice);
        // if($request->mm_status == 'CA' || $request->mm_status == 'C'){
        //     $updateArray['ms_status'] = 'C';
        // }
        // $ms= MeetingSchedule::latest('ms_id')->where('ms_mm_id',$id)->first()->update($updateArray);

        session()->flash('success',"Meeting Updated Successfully");
        return redirect()->route('meeting.index');

    }

    public function destroy($id)
    {
        MeetingMaster::where('mm_id',$id)->update([
            "mm_status"=>'D'
        ]);
        // SectionMaster::where('sm_id',$id)->delete();
        session()->flash('success',"Meeting Deleted Successfully !!");
        return redirect()->route('meeting.index');
    }


}
