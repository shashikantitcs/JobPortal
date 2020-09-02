<?php

namespace App\Http\Controllers;
use App\MeetingMaster;
use App\UserMaster;
use App\DepartmentMaster;
use App\SectionMaster;
use App\AgendaMaster;
use App\AgendaUserMapping;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;

use Validator;
use Session;
use DB;
class AgendaMasterController extends Controller
{
    //

    public function index($meetingId = null){
        $user = UserMaster::select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        if($meetingId){
            $agenda=AgendaMaster::Where('am_mm_id',$meetingId)->select('am_created_at','am_um_id','am_id','am_title','am_mm_id','am_expected_completion_date',
            'am_actual_completion_date','mm_title','mm_status','mm_description','mm_um_id','mm_status','mm_created_at')
             ->join('meeting_master','agenda_master.am_mm_id','=','meeting_master.mm_id')   
            ->paginate(4);
            $magenda = true;
          
            return view('app.agenda.allagenda',compact('agenda','user','magenda'));
        }else{
            $agenda=AgendaMaster::select('am_created_at','am_um_id','am_id','am_title','am_mm_id','am_expected_completion_date',
            'am_actual_completion_date','mm_title','mm_status','mm_description','mm_um_id','mm_status','mm_created_at')
             ->join('meeting_master','agenda_master.am_mm_id','=','meeting_master.mm_id')   
            ->paginate(4);
            return view('app.agenda.allagenda',compact('agenda','user'));
        }
        
    }

    public function getSectionByDepartment(Request $request){
       if($request->deptId){
            $data=SectionMaster::where('sm_dm_id',$request->deptId)->get();
            // ->where('um_dm_id',$request->deptId)
            $user=UserMaster::where('um_user_type','U')->get();
            $deptuser=[];
            foreach($user as $u){
                if($u->um_dm_id == $request->deptId){
                    $deptuser[]=$u;
                }else{
                    foreach($data as $d){
                        if($d->sm_id == $u->um_sm_id){
                            $deptuser[]=$u;
                        }
                    }
                }
            }
            
            $result=array('status'=> true,'data'=> $data,'user'=>$deptuser);
            return response()->json($result);   
       }
       if($request->sectId){
        // $data=SectionMaster::where('sm_dm_id',$request->deptId)->get();
        $user=UserMaster::where('um_user_type','U')->where('um_sm_id',$request->sectId)
        ->get();
        $result=array('status'=> true,'data'=>'','user'=>$user);
        return response()->json($result);   
       }
       $user=UserMaster::where('um_user_type','U')->get();
        $result=array('status'=> true,'data'=>'','user'=>$user);
        return response()->json($result); 

    }


    public function create($meetingId)
    {   
        $department = DB::table('department_master')
        ->where('dm_status','=','A')
        ->select('dm_id','dm_name','dm_short_name','dm_status')
       
        ->get();
       
        // $section = DB::table('section_master')
        // ->where('sm_status','=','A')
        // ->select('sm_id','sm_name','sm_short_name','sm_status','um_email','um_first_name','um_last_name','um_email','um_id','sm_head_id')
        // ->join('user_master', 'user_master.um_id', '=', 'section_master.sm_head_id')
        // ->get();
        // dd($meetingId);
        $user=UserMaster::where('um_user_type','U')->select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
       $meeting=MeetingMaster::select('mm_id','mm_title')->where('mm_status','A')->where('mm_id',$meetingId)->get();
     
    //     if($meetingId){
    //         $m->where('mm_id',$meetingId);
    //    }
    //  $meeting = $m->get();
        // dd($meeting[0]);
        return view('app.agenda.agendacreate',compact('meeting','department','user'));
    }


    public function store(Request $request)
    {
    
        $request->validate([
            "am_mm_id"=>"required",
            "am_title"=>"required|max:255",
            "am_expected_completion_date"=>'required'
        ]);
        // $aum_du_id = $request->aum_du_id;
        // $aum_su_id = $request->aum_su_id;
        $aum_uu_id = $request->aum_uu_id;
        if( count($aum_uu_id)==0){
            session()->flash('error',"Plaese Select atleast one Department Or Section Or User");
            return redirect()->route('agenda.create');
        }
        if($request->userId){
                $userId= explode(",",$request->userId);
                $uu_id= $request->aum_uu_id;
                $aum_uu_id = array_unique( array_merge($userId, $uu_id));
              // dd(  $aum_uu_id);
        }
        $user_id = Session::get('user')['um_id'];
       //  dd( $request->all());
        $am= AgendaMaster::create([
            "am_title"=>strtolower($request->am_title),
            "am_description"=>$request->am_description,
            "am_mm_id"=>$request->am_mm_id,
            "am_um_id"=> $user_id,
            "am_expected_completion_date"=>$request->am_expected_completion_date,
            "am_actual_completion_date"=>$request->am_actual_completion_date
        ]);
       
        if(count($aum_uu_id) > 0){
            //echo count($aum_uu_id);dd();
            $this->insertMeetingSchedule($am,$aum_uu_id,'U');
        }
        session()->flash('success',"Agenda Added Successfully");
       // return redirect()->back();
        return redirect()->route('meetingschedule.edit',['meetingschedule'=>$request->am_mm_id]);
      //  return redirect()->route('agenda.index');
    }

    public function insertMeetingSchedule($am,$countarray,$flag){
       $i=0;
        foreach($countarray as $c){
            AgendaUserMapping::create([
                "aum_am_id"=>$am->am_id,
                "aum_um_id"=>$c,
                "aum_status"=>"A",
                "aum_user_type"=>$flag
            ]);
            $i++;
        }
        // for($i =0;$i < count($countarray);$i++){
        
        //     AgendaUserMapping::create([
        //         "aum_am_id"=>$am->am_id,
        //         "aum_um_id"=>$countarray[$i],
        //         "aum_status"=>"A",
        //         "aum_user_type"=>$flag
        //     ]);
        // }
       
    }

    
    public function edit($id)
    {
        $editagenda=AgendaMaster::where('am_id',$id)->select('am_id','am_title','am_mm_id','am_expected_completion_date',
        'am_actual_completion_date','mm_title','mm_status')
         ->join('meeting_master','agenda_master.am_mm_id','=','meeting_master.mm_id')   
        ->first();
        // dd($editagenda->am_actual_completion_date);
        $meeting=MeetingMaster::select('mm_id','mm_title')->where('mm_status','A')->get();
        return view('app.agenda.agendacreate',compact('editagenda','meeting'));
    }

    public function update(Request $request, $id)
    {
       

        $request->validate([
            "am_mm_id"=>"required",
            "am_title"=>"required|max:255",
            "am_expected_completion_date"=>"required"
        ]);
         $update= [
            "am_title"=>strtolower($request->am_title),
            "am_description"=>$request->am_description,
            "am_mm_id"=>$request->am_mm_id,
       
            "am_expected_completion_date"=>$request->am_expected_completion_date,
            // "am_actual_completion_date"=>$request->am_actual_completion_date
         ];
         if($request->am_status && $request->am_status == 'C'){
            $update['am_actual_completion_date']= date('Y-m-d');
         }  
        $mm= AgendaMaster::where('am_id',$id)->update($update);
        session()->flash('success',"Agenda Updated Successfully");
        return redirect()->route('meetingschedule.edit',['meetingschedule'=>$request->am_mm_id]);

        // return redirect()->route('agenda.index');

    }

    public function getAgendaUser(Request $request){
        $url = route('agenda.getAgendaU');
        $ses_um_user_type = Session::get('user')['um_user_type'];
        
        if($request->deleteAgendaUser){
            $check=AgendaMaster::where('am_id',$request->agendaId)->select('mm_status','am_actual_completion_date')
            ->join('meeting_master','meeting_master.mm_id','=','agenda_master.am_mm_id')->first();
            if($check->mm_status == 'A' &&  $check->am_actual_completion_date == NULL){
                AgendaUserMapping::where('aum_id',$request->userId)
                ->where('aum_am_id',$request->agendaId)
                ->update([
                    "aum_status"=>"D"
                ]);
                $result=array('status'=> true,'data'=> '','url'=>$url);
            }else{
                $result=array('status'=> false,'msg'=>"Meeting Not Activated or Agenda Completed",'data'=> '');
            }
           
            return response()->json($result);    
        }else if($request->saveagendaUsers){
            $form = json_decode($request->form);
            $check=AgendaMaster::where('am_id',$request->agendaId)->select('mm_status','am_actual_completion_date')
            ->join('meeting_master','meeting_master.mm_id','=','agenda_master.am_mm_id')->first();
            if(count($form) > 0){
                if($check->mm_status == 'A' &&  $check->am_actual_completion_date == NULL){
                    for($i =0;$i < count($form);$i++){
                        $userCheck=AgendaUserMapping::where('aum_am_id',$request->agendaId)->Where('aum_um_id',$form[$i])->Where('aum_status','A')->first();
                        if(!$userCheck){
                            AgendaUserMapping::create([
                                "aum_am_id"=>$request->agendaId,
                                "aum_um_id"=>$form[$i],
                                "aum_status"=>"A",
                                "aum_user_type"=>'U'
                            ]);
                        }
                      
                    }
                    $result=array('status'=> true,'data'=> '','url'=>$url);
                }else{
                    $result=array('status'=> false,'msg'=>"Meeting Not Activated or Agenda Completed",'data'=> '');
                }               
               
                return response()->json($result);  
            }
            
        }else{
        $agnedaUser=AgendaUserMapping::select('aum_id','aum_am_id','mm_status','um_email','um_first_name','um_last_name','um_designation','dm_name','dm_short_name','sm_name','sm_short_name','sm_id','sm_dm_id','mm_um_id')->where('aum_am_id',$request->aum_am_id)
        ->where('aum_status','A')
        ->join('user_master','user_master.um_id','=','agenda_user_mapping.aum_um_id')
        ->join('agenda_master','agenda_master.am_id','=','agenda_user_mapping.aum_am_id')
        ->join('meeting_master','meeting_master.mm_id','=','agenda_master.am_mm_id')
        ->leftjoin('department_master','department_master.dm_id','=','user_master.um_dm_id')
        ->leftjoin('section_master','section_master.sm_id','=','user_master.um_sm_id')
        ->get();
            // dd($agnedaUser);
        foreach( $agnedaUser as $ag){
            if($ag->sm_id){
                //  dd($ag->sm_dm_id);
               $dm= DepartmentMaster::select('dm_id','dm_name','dm_short_name')->
                where('dm_status','A')->where('dm_id',$ag->sm_dm_id)->first();
                //  dd( $dm);
                $ag->dm_name =$dm->dm_name;
                $ag->dm_short_name =$dm->dm_short_name;
            }
            
        }
        $ses_um_id = Session::get('user')['um_id'];
        if( $ses_um_user_type == 'A'){
            $editManageUser= true;
        }else {
            if(isset($agnedaUser[0])){
                if($agnedaUser[0]->mm_um_id == $ses_um_id){
                    $editManageUser= true;
                }else{
                    $editManageUser= false;
                }
            }else{
                $editManageUser= false;
            }
        }
    //  dd($agnedaUser);
        $result=array('status'=> true,'data'=> $agnedaUser,'url'=>$url,'aum_am_id'=>$request->aum_am_id,'editManageUser'=> $editManageUser);
        return response()->json($result);    
       }
    }

    public function destroy($id)
    {
        // dd($id);
        $am=AgendaMaster::select('am_mm_id')->where('am_id',$id)->first();
        AgendaMaster::where('am_id',$id)->update([
            "is_deleted"=>1
        ]);
        session()->flash('success',"Agenda Deleted Successfully !!");
        return redirect()->route('meetingschedule.edit',['meetingschedule'=>$am->am_mm_id]);
        // return redirect()->route('agenda.index');
    }
}
