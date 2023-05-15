<?php

namespace App\Http\Controllers\setup\exam_marks_type_setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\setup\ExamMarksTypeSetupModel;
use Session;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;


class ExamMarksTypeSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header=array(
            'pageTitle'=>'Exam Marks Type Setup',
            'tableTitle'=>'Exam Marks Type List'
         
        );
    
        $examMarksTypes=ExamMarksTypeSetupModel::orderBy('id', 'DESC')->get();
    
        return view('setup.exam_marks_type.index',compact('header','examMarksTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('setup.exam_marks_type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $examMarksType=new ExamMarksTypeSetupModel();
        $examMarksType->exam=$request->exam;
        $examMarksType->description=$request->description;
        $examMarksType->type=$request->criteria_type;
        $examMarksType->active_status=$request->active_status;
        $examMarksType->created_by=Auth::user()->id;
        $examMarksType->org_id=1;
        $examMarksType->save();

        Session::flash('success', "Data Save Successfully");
        return redirect()->route('exammarkstype');   
          

        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $examMarksType=ExamMarksTypeSetupModel::where('id',$id)->first();
        
        return view('setup.exam_marks_type.edit',compact('examMarksType'));
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
        $examMarksType=ExamMarksTypeSetupModel::find($id);
        $examMarksType->exam=$request->exam;
        $examMarksType->description=$request->description;
        $examMarksType->type=$request->criteria_type;
        $examMarksType->active_status=$request->active_status;
        $examMarksType->updated_by=Auth::user()->id;
        $examMarksType->save();
        Session::flash('success', "Data Update Successfully");
        return redirect()->route('exammarkstype');   
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
