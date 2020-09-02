<?php

namespace App\Http\Controllers;
use App\SectionMaster;
use App\DepartmentMaster;
use App\UserMaster;
use App\Role;
use Illuminate\Http\Request;
use Validator;
use Session,Mail;
use DB;
class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $section = DB::table('section_master')
        // ->where('sm_status','=','A')
        ->select('sm_id','sm_name','sm_short_name','sm_description','sm_status','dm_name','dm_short_name','dm_status')
        ->join('department_master', 'department_master.dm_id', '=', 'section_master.sm_dm_id')
        ->paginate(20); 
        // dd($section);
        return view('app.section.allsection',compact('section'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $department= DepartmentMaster::where('dm_status','A')->get();
        // $user=UserMaster::select('um_id','um_email','um_first_name','um_last_name','um_designation')->get();
        // dd($user);
        return view('app.section.sectioncreate',compact('department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            "sm_name"=>"required|max:255",
            "sm_short_name"=>"required|max:100",
            // "sm_head_id"=>"required|integer",
            "sm_dm_id"=>"required|integer",
            "sm_status"=>"required|in:A",
        ]);
        SectionMaster::create([
            "sm_name"=>strtolower($request->sm_name),
            "sm_short_name"=>strtolower($request->sm_short_name),
            "sm_description"=>$request->sm_description,
            "sm_dm_id"=>$request->sm_dm_id,
            "sm_status"=>$request->sm_status,
        ]);
        session()->flash('success',"Section Added Successfully");
        return redirect()->route('section.index');
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
        $editsection = DB::table('section_master')
        ->select('sm_id','sm_name','sm_short_name','sm_dm_id','sm_description','sm_status','sm_dm_id','dm_id','dm_name','dm_short_name')
        ->join('department_master', 'department_master.dm_id', '=', 'section_master.sm_dm_id')
        ->where('section_master.sm_id', $id)
        ->first(); 
        $department= DepartmentMaster::where('dm_status','A')->get();
       // dd($editsection);
        return view('app.section.sectioncreate',compact('editsection','department'));
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
            "sm_name"=>"required|max:255",
            "sm_short_name"=>"required|max:100",
            // "sm_head_id"=>"required|integer",
            "sm_dm_id"=>"required|integer",
            "sm_status"=>"required|in:A,I",
        ]);
        SectionMaster::where('sm_id',$id)->update([
            "sm_name"=>strtolower($request->sm_name),
            "sm_short_name"=>strtolower($request->sm_short_name),
            "sm_description"=>$request->sm_description,
            "sm_dm_id"=>$request->sm_dm_id,
            "sm_status"=>$request->sm_status,
        ]);
        session()->flash('success',"Section Updated Successfully");
        return redirect()->route('section.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SectionMaster::where('sm_id',$id)->update([
            "sm_status"=>'D'
        ]);
        // SectionMaster::where('sm_id',$id)->delete();
        session()->flash('success',"Section Deleted Successfully !!");
        return redirect()->route('section.index');
    }
    
}
