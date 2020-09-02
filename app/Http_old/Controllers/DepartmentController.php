<?php

namespace App\Http\Controllers;
use App\DepartmentMaster;
use App\UserMaster;
use App\AgendaTaskActionFiles;
use App\Role;
use Illuminate\Http\Request;
use Validator;
use Session,Mail;
use DB;
class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $department = DB::table('department_master')
        // ->where('dm_status','=','A')->orWhere('dm_status','=','I')
        ->select('dm_id','dm_name','dm_short_name','dm_description','dm_status')
        // ->join('user_master', 'user_master.um_id', '=', 'department_master.dm_head_id')
                // ->where('countries.country_name', $country)
        ->paginate(20); 
                // dd($department);
        // $department = DepartmentMaster::latest('dm_id')->paginate(2);
        return view('app.department.alldepartment',compact('department'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user=UserMaster::select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        // dd($user);
        return view('app.department.departmentcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image=$request->file('img');
        $validate=[];
        if($image){
            // $validate['img'] = "required|image|max:7048";
            $validate['img.*'] = "mimetypes:image/jpeg,image/png,image/jpg|max:4000";
        }
        $validate=[
            "dm_name"=>"required|max:255|unique:department_master",
            "dm_short_name"=>"required|max:100",
            // "dm_head_id"=>"required|integer",
            "dm_status"=>"required|in:A",
        ];
        $request->validate($validate);
        $dM = DepartmentMaster::create([
            "dm_name"=>strtolower($request->dm_name),
            "dm_short_name"=>strtolower($request->dm_short_name),
            "dm_description"=>$request->dm_description,
            // "dm_head_id"=>$request->dm_head_id,
            "dm_status"=>$request->dm_status,
        ]);

        if($request->hasfile('img'))
        {
            

           foreach($request->file('img') as $file)
           {
            //dd($file);
                $file->getClientMimeType();
               $name=$file->getClientOriginalName();
            //    $file->move(public_path().'/files/', $name);
               $data[] = $name;
            //    if($file->getClientOriginalExtension() != 'pdf' || $file->getClientMimeType() !='application/pdf'){
            //        continue;
            //    }
               $mgimg = rand().'.'.$file->getClientOriginalExtension();
               $file->move(public_path().'/uploads/',$mgimg);
               AgendaTaskActionFiles::create([
                   "file_atl_id"=>$dM->dm_id,
                   "file_name"=>$mgimg,
                   "file_extension"=>$file->getClientOriginalExtension(),
                   "file_real_name"=>$name,
                   // "file_size"=>$file->getClientSize(),
                   "status"=>"A"
               ]);
           }
        }

        session()->flash('success',"Product Added Successfully");
        return redirect()->route('department.index');
    }


    public function createDepartment(Request $request){

        $validator = Validator::make($request->all(),[
             "dm_name"=>"required|max:255|unique:department_master",
            "dm_short_name"=>"required|max:100",
            // "dm_head_id"=>"required|integer",
            "dm_status"=>"required|in:A",
            // "captcha"=>"required|captcha|min:6|max:6",
        ]);
        if ($validator->fails()) {
          $result=array('status'=> false,'code'=>422,'msg'=>'validation failed','data'=>$validator->errors());
          return response()->json($result);  
        }
        
        $dM = DepartmentMaster::create([
            "dm_name"=>strtolower($request->dm_name),
            "dm_short_name"=>strtolower($request->dm_short_name),
            "dm_description"=>$request->dm_description,
            // "dm_head_id"=>$request->dm_head_id,
            "dm_status"=>$request->dm_status,
        ]);

        if($request->hasfile('img'))
        {
            foreach($request->file('img') as $file)
           {
            //dd($file);
                $file->getClientMimeType();
               $name=$file->getClientOriginalName();
            //    $file->move(public_path().'/files/', $name);
               $data[] = $name;
            //    if($file->getClientOriginalExtension() != 'pdf' || $file->getClientMimeType() !='application/pdf'){
            //        continue;
            //    }
               $mgimg = rand().'.'.$file->getClientOriginalExtension();
               $file->move(public_path().'/uploads/',$mgimg);
               AgendaTaskActionFiles::create([
                   "file_atl_id"=>$dM->dm_id,
                   "file_name"=>$mgimg,
                   "file_extension"=>$file->getClientOriginalExtension(),
                   "file_real_name"=>$name,
                   // "file_size"=>$file->getClientSize(),
                   "status"=>"A"
               ]);
           }

        }
        $result=array('status'=> false,'code'=>200,'msg'=>'data uploaded successfully','data'=>null);
          return response()->json($result);  

    }

    public function getProductdata($id)
    {
        $editdepartment=DB::table('department_master')
        ->select('dm_id','dm_name','dm_short_name','dm_description','dm_status')
        // ->join('user_master', 'user_master.um_id', '=', 'department_master.dm_head_id')
        ->where('department_master.dm_id', $id)
        ->get();
         
        $file = AgendaTaskActionFiles::where('file_atl_id',$id)->get();
        $result['file'] = $file;
        $result['product'] = $editdepartment;
        $response=array('status'=> false,'code'=>200,'msg'=>'data uploaded successfully','data'=>$result);
           return response()->json($response);  
    }

     public function updateProduct(Request $request)
    {
       
        $validator = Validator::make($request->all(),[
            'dm_id'=>'required',
             "dm_name"=>"required|max:255|",
            "dm_short_name"=>"required|max:100",
            // "dm_head_id"=>"required|integer",
            "dm_status"=>"required|in:A",
            "dm_description"=>"required"
            // "captcha"=>"required|captcha|min:6|max:6",
        ]);
         
        if ($validator->fails()) {
          $result=array('status'=> false,'code'=>422,'msg'=>'validation failed','data'=>$validator->errors());
          return response()->json($result);  
        }
        $d= DepartmentMaster::where('dm_id',$request->dm_id)->update([
            "dm_name"=>strtolower($request->dm_name),
            "dm_short_name"=>strtolower($request->dm_short_name),
            "dm_description"=>$request->dm_description,
            // "dm_head_id"=>$request->dm_head_id,
            "dm_status"=>$request->dm_status,
        ]);
        if($d){
             $response=array('status'=> true,'code'=>200,'msg'=>'data updated successfully','data'=>null);
        }else{
             $response=array('status'=> false,'code'=>500,'msg'=>'data Not Updated','data'=>null);
        }
       
           return response()->json($response);  
        
         
    }

    public function deleteDepatment($id){
        $dm = DepartmentMaster::where('dm_id',$id)->update([
            "dm_status"=>'D'
        ]);
        // DepartmentMaster::where('dm_id',$id)->delete();
        // session()->flash('success',"Department Deleted Successfully !!");
        // return redirect()->route('department.index');
        if($d){
             $response=array('status'=> true,'code'=>200,'msg'=>'data deleted successfully','data'=>null);
              return response()->json($response);  
        }else{
             $response=array('status'=> false,'code'=>500,'msg'=>'data already deleted','data'=>null);
              return response()->json($response);  
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editdepartment=DB::table('department_master')
        ->select('dm_id','dm_name','dm_short_name','dm_description','dm_status')
        // ->join('user_master', 'user_master.um_id', '=', 'department_master.dm_head_id')
        ->where('department_master.dm_id', $id)
        ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editdepartment=DB::table('department_master')
        ->select('dm_id','dm_name','dm_short_name','dm_description','dm_status')
        // ->join('user_master', 'user_master.um_id', '=', 'department_master.dm_head_id')
        ->where('department_master.dm_id', $id)
        ->first();
        $file = AgendaTaskActionFiles::where('file_atl_id',$id)->get();
        //dd($file);
        // dd($editdepartment->dm_id);
        // $user=UserMaster::select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        return view('app.department.departmentcreate',compact('editdepartment','file'));
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
        $request->validate([
            "dm_name"=>"required|max:255|unique:department_master,dm_name,".$id.",dm_id",
            "dm_short_name"=>"required|max:100",
            // "dm_head_id"=>"required|integer",
            "dm_status"=>"required|in:A,I",
        ]);
           
        DepartmentMaster::where('dm_id',$id)->update([
            "dm_name"=>strtolower($request->dm_name),
            "dm_short_name"=>strtolower($request->dm_short_name),
            "dm_description"=>$request->dm_description,
            // "dm_head_id"=>$request->dm_head_id,
            "dm_status"=>$request->dm_status,
        ]);
        session()->flash('success',"Department Updated Successfully !!");
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DepartmentMaster::where('dm_id',$id)->update([
            "dm_status"=>'D'
        ]);
        // DepartmentMaster::where('dm_id',$id)->delete();
        session()->flash('success',"Department Deleted Successfully !!");
        return redirect()->route('department.index');
    }



    public function uploadimages(Request $request){
      dd($request->file('fileName'));
        $dyanamic_form = $request->input('dynamic_form')['dynamic_form'];
       
    }
}
