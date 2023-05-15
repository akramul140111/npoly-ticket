<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\students_panel\StudentExamRoutineModel;
use DB;
use Session;
use Auth;
use Redirect;
use Validation;
use Response;

class StudentExamRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Exam Routine',
            'tableTitle' => 'Exam Routine List'

        );

        $teacherId=Auth::user()->id;
        $departmentId=Auth::user()->department_id;
        $courseTypeId=Auth::user()->course_type;
        $course_name=Auth::user()->course_name;
       

        $results = DB::table('tea_exam_routine as dt1')
        ->leftJoin('sa_lookup_data as dt2', 'dt1.exam_id', '=', 'dt2.LOOKUP_DATA_ID') 
        ->leftJoin('set_class_room as dt3', 'dt1.room', '=', 'dt3.id')
        ->leftJoin('sa_lookup_data as dt4', 'dt1.examinees_from', '=', 'dt4.LOOKUP_DATA_ID') 
        ->leftJoin('users as dt5', 'dt1.exam_coordinator', '=', 'dt5.id')
        // ->where('dt1.department_id', $departmentId)
        // ->where('dt1.course_type', $courseTypeId)
        // ->where('dt1.course_name_id', $course_name)
        ->select('dt1.*','dt2.LOOKUP_DATA_NAME as examName','dt3.room_no as classRoom','dt4.LOOKUP_DATA_NAME as examineesFromName','dt5.name as teacherName')
        ->orderBy('dt1.id','desc')
        ->get();


        return view('student_portal.eaxm_routine.index',compact('header','results'));
    }

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
        //
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
        //
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
        //
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
