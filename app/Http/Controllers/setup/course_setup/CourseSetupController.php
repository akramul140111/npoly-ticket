<?php

namespace App\Http\Controllers\setup\course_setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\academic_officer\CourseModel;
use DB;

class CourseSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Course Setup',
            'tableTitle' => 'Course Setup List'

        );

        $results = DB::table('set_course as dt1')
            ->leftJoin('sa_lookup_data as dt2', 'dt1.course_type', '=', 'dt2.LOOKUP_DATA_ID') 
            ->leftJoin('sa_lookup_data as dt3', 'dt1.course_name', '=', 'dt3.LOOKUP_DATA_ID') 
            ->leftJoin('sa_lookup_data as dt4', 'dt1.department', '=', 'dt4.LOOKUP_DATA_ID') 
            ->select('dt1.*','dt2.LOOKUP_DATA_NAME AS COURSE_TYPE','dt3.LOOKUP_DATA_NAME AS COURSE_NAME','dt4.LOOKUP_DATA_NAME AS DEPARTMENT')
            ->orderBy('dt1.course_id','desc')
            ->get();

        return view('setup.course.index',compact('header','results'));
    }

    /**
     * Create course setup form
     * @param None
     * 
     */  
    public function create()
    {       
        $header = array(
            'pageTitle' => 'Course Setup',
            'tableTitle' => 'Course Setup List'

        );

        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $courseNames = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 5)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $departments = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 3)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();
        
        return view('setup.course.create', compact('header', 'courseTypes', 'courseNames', 'departments'));
    }

    /* save course setup information
     * @param Request $request
     * 
     */ 
    public function store(Request $request)
    {
        CourseModel::createCourseSetup($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('courseSetup');    
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

    /* course setup update page
     * @param $id
     * 
     */ 
    public function edit($id)
    { 
        $header = array(
            'pageTitle' => 'Course Setup',
            'tableTitle' => 'Course Setup List'

        );

        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $courseNames = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 5)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $departments = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 3)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $result = CourseModel::find($id);
        return view('setup.course.update', compact('header', 'result', 'courseTypes', 'courseNames', 'departments'));

    }

    /* course setup update action
     * @param $request
     * 
     */ 
    public function update(Request $request)
    {
        CourseModel::updateCourseSetup($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('courseSetup');
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

    /* check duplicate course setup
     * @param $type, $name, $dept
     * 
     */ 
    public function checkDuplicateCourse($type=null, $name=null, $dept=null)
    {
        $data = 0;
        if(!empty($type) && !empty($name) && !empty($dept)){

            $results = DB::table('set_course as dt1')
            ->where('dt1.course_type', '=',$type)
            ->where('dt1.course_name', '=',$name)
            ->where('dt1.department', '=',$dept)
            ->get();
            if(count($results) > 0){
                $data = count($results);
            }

        }
        return $data;

    }
}
