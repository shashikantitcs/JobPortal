<?php

namespace App\Http\Controllers;
use App\DepartmentMaster;
use App\UserMaster;
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

        $request->validate([
            "dm_name"=>"required|max:255|unique:department_master",
            "dm_short_name"=>"required|max:100",
            // "dm_head_id"=>"required|integer",
            "dm_status"=>"required|in:A",
        ]);
        DepartmentMaster::create([
            "dm_name"=>strtolower($request->dm_name),
            "dm_short_name"=>strtolower($request->dm_short_name),
            "dm_description"=>$request->dm_description,
            // "dm_head_id"=>$request->dm_head_id,
            "dm_status"=>$request->dm_status,
        ]);
        session()->flash('success',"Department Added Successfully");
        return redirect()->route('department.index');
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
        $editdepartment=DB::table('department_master')
        ->select('dm_id','dm_name','dm_short_name','dm_description','dm_status')
        // ->join('user_master', 'user_master.um_id', '=', 'department_master.dm_head_id')
        ->where('department_master.dm_id', $id)
        ->first();
        // dd($editdepartment->dm_id);
        // $user=UserMaster::select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        return view('app.department.departmentcreate',compact('editdepartment'));
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
}
