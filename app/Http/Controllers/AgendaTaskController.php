<?php

namespace App\Http\Controllers;
use App\MeetingMaster;
use App\AgendaMaster;
use App\AgendaTaskList;
use App\AgendaTaskActionFiles;
use App\UserMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Session;
class AgendaTaskController extends Controller
{
  public $user = null;

  public function __construct(){
    $this->middleware(function ($request, $next) {
      $this->user = (Object)Session::get('user');
      return $next($request);
    });
  }

   public function index($amId=null){
    if($amId){
        $agenda=DB::table('agenda_master')->where('agenda_master.am_id',$amId)->select('mm_id','mm_title','mm_status','am_expected_completion_date','am_actual_completion_date','am_title','am_id')
        ->join('meeting_master','meeting_master.mm_id','=','agenda_master.am_mm_id')
        ->paginate(2);
        //  dd($agenda);
    }else{
        $agenda=DB::table('agenda_master')->select('mm_id','mm_title','mm_status','am_expected_completion_date','am_actual_completion_date','am_title','am_id')
        ->join('meeting_master','meeting_master.mm_id','=','agenda_master.am_mm_id')
        ->paginate(2);
    }

    // dd( $agenda);
    // $tasklist=DB::table('agenda_task_list')->select('atl_id','atl_title','atl_description','atl_um_id','atl_status','am_title','mm_title')
    // ->join('agenda_master','agenda_master.am_id','=','agenda_task_list.atl_am_id')
    // ->join('meeting_master','meeting_master.mm_id','=','agenda_master.am_mm_id')
    // ->paginate(2);
    $atskl=[];
    $files=[];
    foreach($agenda as $a){
        $a->am_id."<br>";
        $ataf=DB::table('agenda_task_list')->where('atl_am_id',$a->am_id)->
        join('user_master','agenda_task_list.atl_um_id','=','user_master.um_id')->get();
       if($ataf){
            $atskl[$a->am_id]=$ataf;

            foreach($ataf as $at){
                $filedb=DB::table('agenda_task_action_files')->where('file_atl_id',$at->atl_id)
                ->get();
                $files[$at->atl_id]=$filedb;
            }

        }
   }

    return view('app.agendatask.allagendatask',compact('agenda','atskl','files'));
   }

   public function getAgendatask(Request $request){
    //    dd("hhhh");
    $amId = $request->amId;
    if($this->user->um_user_type != 'A'){
      $where = " and (am.am_um_id = ".$this->user->um_id." OR atl.atl_um_id = ".$this->user->um_id." OR atl.atl_created_by = ".$this->user->um_id.")";
    }
    $qry = "SELECT * FROM `agenda_master` am
    JOIN agenda_task_list atl ON am.am_id = atl.atl_am_id
    JOIN agenda_user_mapping aum ON am.am_id = aum.aum_am_id
    JOIN user_master um ON um.um_id = atl.atl_um_id
    JOIN meeting_master mm ON mm.mm_id = am.am_mm_id
    WHERE am.am_id= $amId $where GROUP BY atl.atl_id";
    $agenda= DB::select($qry);
   
    $atskl=[];
    $files=[];
    foreach($agenda as $at){
      $filedb=DB::table('agenda_task_action_files')->where('file_atl_id',$at->atl_id)
      ->get();
      $files[$at->atl_id]=$filedb;
     }
     $isAjaxView = true;
    //  dd($agenda);
     return view('app.agendatask.agendatasksubview',compact('agenda','files','isAjaxView'));
   }

    public function create($meetingId,Request $request)
    {
    //  dd($request->all());
        $user=UserMaster::where('um_user_type','U')->select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        $agenda=MeetingMaster::select('am_title','am_id')
                ->where('am_id',$request->amId)
                    ->join('agenda_master','agenda_master.am_mm_id','=','meeting_master.mm_id')
                    ->get();

                    

        $meeting=MeetingMaster::select('mm_id','mm_title')->where('mm_id',$meetingId)->where('mm_status','A')->get();
        // dd($meeting);
        return view('app.shared.agtaskchildform',compact('meeting','user','agenda'));
    }

    public function getAgendaDetail(Request $request){
         //dd($request->all());
        $meetingId = $request->input('meetingId');
        //dd($meetingId);
        $agendadetail=AgendaMaster::select('am_id','am_title')
        ->where('am_mm_id',$meetingId)->get();
        $result=array('status'=> true,'data'=> $agendadetail);
        return response()->json($result);
    }

    public function store(Request $request)
    {
        // dd($this->user->um_id);
       
        $image=$request->file('img');
        $validate=[];
        if($image){
            // $validate['img'] = "required|image|max:7048";
            $validate['img.*'] = "mimes:pdf|max:4000";
        }
        $validate=[
            // "am_mm_id"=>"required",
            "atl_title"=>"required",
            "atl_am_id"=>"required",
            "atl_um_id"=>"required",
            // "atl_created_by"=>"required",
            "atl_expected_completion_date"=>"required"
        ];
        $a = $request->validate($validate);
       $am_re =AgendaMaster::select('am_mm_id')->where('am_id',$request->atl_am_id)->first();
        // $user_id = Session::get('user')['um_id'];
       
        $am= AgendaTaskList::create([
            "atl_title"=>strtolower($request->atl_title),
            "atl_description"=>$request->atl_description,
            "atl_am_id"=>$request->atl_am_id,
            "atl_um_id"=> $request->atl_um_id,
            "atl_status"=>"O",
            "atl_created_by"=>$this->user->um_id,
            "atl_expected_completion_date"=>$request->atl_expected_completion_date,
            // "atl_actual_completion_date"=>$request->atl_actual_completion_date
        ]);
        if($request->hasfile('img'))
         {

            foreach($request->file('img') as $file)
            {
                 $file->getClientMimeType();
                $name=$file->getClientOriginalName();
				$file_last__ext = explode(".",$name);
			   $size = number_format($file->getSize() / 1048576,2);
				if(count($file_last__ext) !=1){
					 continue;	
				}	
                // $file->move(public_path().'/files/', $name);
                // $data[] = $name;
				
                if($file->getClientOriginalExtension() != 'pdf' || $file->getClientMimeType() !='application/pdf' || $size > 2 ){
                    continue;
                }
                $mgimg = rand().'.'.$file->getClientOriginalExtension();
                $file->move(public_path('uploads'),$mgimg);
                AgendaTaskActionFiles::create([
                    "file_atl_id"=>$am->atl_id,
                    "file_name"=>$mgimg,
                    "file_extension"=>$file->getClientOriginalExtension(),
                    "file_real_name"=>$name,
                    // "file_size"=>$file->getClientSize(),
                    "status"=>"A"
                ]);
            }
         }
         $result=array('status'=> true,'data'=> '','amId'=>$request->atl_am_id,url=>route('agendatask.getAgendatask'));
            return response()->json($result);   
        // session()->flash('success',"Agenda Task Added Successfully");
        // return redirect()->route('meetingschedule.edit',['meetingschedule'=>$request->am_mm_id]);
        // return redirect()->route('agenda.index');
    }

    public function edit($id,Request $request)
    {
      
        $atl= AgendaTaskList::where('atl_id',$id)
                                ->join('agenda_master','agenda_task_list.atl_am_id','=','agenda_master.am_id')->first();
        // dd($atl->am_mm_id);
        $user=UserMaster::where('um_user_type','U')->select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        $editagendatask= AgendaMaster::where('am_mm_id',$atl->am_mm_id)
        // ->join('agenda_task_list','agenda_task_list.atl_am_id','=','agenda_master.am_id')
        ->get();
        // $editagendatask=MeetingMaster::select('am_title','am_id')
        //         ->where('am_id',$atl->atl_am_id)
        //             ->join('agenda_master','agenda_master.am_mm_id','=','meeting_master.mm_id')
        //             ->get();
      
                    

        $meeting=MeetingMaster::select('mm_id','mm_title')->where('mm_id',$meetingId)->where('mm_status','A')->get();
        // dd($meeting);
        return view('app.shared.agtaskchildform',compact('meeting','user','editagendatask','atl'));
    }

    public function update($id,Request $request)
    {
            // dd($request->all());
        $image=$request->file('img');
        $validate=[];
        if($image){
            // $validate['img'] = "required|image|max:7048";
            $validate['img.*'] = "mimes:pdf|max:4000";
        }
        $validate=[
            // "am_mm_id"=>"required",
            "atl_title"=>"required",
            "atl_am_id"=>"required",
            "atl_um_id"=>"required",
            "atl_expected_completion_date"=>"required"
        ];
        $a = $request->validate($validate);
        // dd($request->atl_expected_completion_date);
     $am_re =AgendaTaskList::select('atl_am_id')->where('atl_id',$id)->first();
        // $user_id = Session::get('user')['um_id'];
        $agtlist=AgendaTaskList::select('atl_am_id')->where('atl_id',$id)->first();
        $am= AgendaTaskList::where('atl_id',$id)->update([
            "atl_title"=>strtolower($request->atl_title),
            "atl_description"=>$request->atl_description,
            "atl_am_id"=>$request->atl_am_id,
            "atl_um_id"=> $request->atl_um_id,
            "atl_status"=>"O",
            "atl_created_by"=>$this->user->um_id,
            "atl_expected_completion_date"=>$request->atl_expected_completion_date,
            // "atl_actual_completion_date"=>$request->atl_actual_completion_date
        ]);
        if($request->hasfile('img'))
         {

            foreach($request->file('img') as $file)
            {
                 $file->getClientMimeType();
                $name=$file->getClientOriginalName();
                // $file->move(public_path().'/files/', $name);
                // $data[] = $name;
				$file_last__ext = explode(".",$name);
				$size = number_format($file->getSize() / 1048576,2);
			
				if(count($file_last__ext) !=1){
					 continue;	
				}	
                if($file->getClientOriginalExtension() != 'pdf' || $file->getClientMimeType() !='application/pdf' || $size > 2){
                    continue;
                }
                $mgimg = rand().'.'.$file->getClientOriginalExtension();
				
                $file->move(public_path('uploads'),$mgimg);
                AgendaTaskActionFiles::create([
                    "file_atl_id"=>$id,
                    "file_name"=>$mgimg,
                    "file_extension"=>$file->getClientOriginalExtension(),
                    "file_real_name"=>$name,
                    // "file_size"=>$file->getClientSize(),
                    "status"=>"A"
                ]);
            }
         }
         $result=array('status'=> true,'data'=> '','amId'=>$agtlist->atl_am_id,url=>route('agendatask.getAgendatask'));
            return response()->json($result);   
    }



}
