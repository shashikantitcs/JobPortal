<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AgendaMaster;
use App\AgendaTaskList;
use App\AgendaTaskAction;
use App\AgendaTaskActionFiles;
use Validator;
use Session,Mail;
use Cookie;
use DB;
class AgnedaTaskAction extends Controller
{
    
    public function store(Request $request){
        $image=$request->file('img');
        $validate=[];
        if($image){
            // dd( $image);
            // $validate['img'] = "required|image|max:7048";
            $validate['img.*'] = "mimes:pdf|max:4000";
        }
        $validate=[
            "ata_atl_id"=>"required",
            "ata_action_taken"=>"required",
        ];
        $allowedfileExtension=['pdf'];
        $validator = Validator::make($request->all(),$validate);
        if ($validator->fails()) {
            $result=array('status'=> false,'msg'=>'Validation Falied','data'=>$validator->fails());
            return response()->json($result);  
        }
        
        $user_id = Session::get('user')['um_id'];
        $ata=AgendaTaskAction::create([
            "ata_action_taken"=>$request->ata_action_taken,
            "ata_remarks"=>$request->ata_remarks,
            "ata_atl_id"=>$request->ata_atl_id,
            'ata_um_id'=>$user_id,
        ]);
        if($request->hasfile('img'))
        {
           foreach($request->file('img') as $file)
           {
                if($file->getClientOriginalExtension() != 'pdf' || $file->getClientMimeType() !='application/pdf'){
                    continue;
                }
               $name=$file->getClientOriginalName();
            //    $check=in_array($extension,$allowedfileExtension);
               $mgimg = rand().'.'.$file->getClientOriginalExtension();
               $file->move(public_path('uploads'),$mgimg);  
               AgendaTaskActionFiles::create([
                   "file_ata_id"=>$ata->ata_id,
                   "file_name"=>$mgimg,
                   "file_extension"=>$file->getClientOriginalExtension(),
                   "file_real_name"=>$name,
                   "status"=>"A"
               ]);
           }
        }
        $result=array('status'=> true,'msg'=>'Agenda Task Action Added Successfully','data'=>'');
        return response()->json($result);
        // session()->flash('success',"Agenda Task Action Added Successfully");
        // return redirect()->back();    
    }


    public function getAgendaTaskActionList(Request $request){
        $validate=[
            "ata_atl_id"=>"required",
        ];
   
        $validator = Validator::make($request->all(),$validate);
        if ($validator->fails()) {
            $result=array('status'=> false,'msg'=>'Validation Falied','data'=>$validator->fails());
            return response()->json($result);  
        }
       $ata= AgendaTaskAction::where('ata_atl_id',$request->ata_atl_id)
        ->select('ata_id','ata_action_taken','ata_remarks','um_email','um_first_name',
        'um_last_name','ata_created_at')
        ->join('user_master','agenda_task_action.ata_um_id','=','user_master.um_id')
        ->get();
        $files = [];
        // dd($ata);
        foreach($ata as $at){
            $file = AgendaTaskActionFiles::where('file_ata_id',$at->ata_id)->get();
            $files[$at->ata_id] = $file;
        }
        return view('app.agendataskaction.taskactionlist',compact('ata','files'));
        
    }

    public function updateTaskStatus(Request $request){
        $validate=[
            "atl_id"=>"required",
        ];
        $validator = Validator::make($request->all(),$validate);
        if ($validator->fails()) {
            $result=array('status'=> false,'msg'=>'Validation Falied','data'=>$validator->fails());
            return response()->json($result);  
        }
        $a=AgendaTaskList::select('atl_am_id')->where('atl_id',$request->atl_id)->first();
        AgendaTaskList::where('atl_id',$request->atl_id)->update([
            "atl_status"=>'C'
        ]);
        $route=  route('agendatask.getAgendatask');
        $result=array('status'=> true,'msg'=>'Agenda Task Status Updated','data'=>['amId'=>$a->atl_am_id,
        "aturl"=>$route]);
        return response()->json($result);  
    }



}
