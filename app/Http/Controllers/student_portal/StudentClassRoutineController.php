<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\students_panel\StudentClassRoutineModel;
use DB;
use Auth;
use Session;

class StudentClassRoutineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Student Class Routine',
            'tableTitle' => 'Student Class Routine List'
        );
        $departmentId=Auth::user()->department_id;
        $courseTypeId=Auth::user()->course_type;
        $studenId=Auth::user()->student_id;
        $studentClassRoutines = StudentClassRoutineModel::leftJoin('sa_lookup_data','tea_class_routine.class_type','=','sa_lookup_data.LOOKUP_DATA_ID')
        ->leftJoin('users','tea_class_routine.teacher_id','=','users.id')
        ->leftJoin('set_class_room','tea_class_routine.class_room','=','set_class_room.id')
        ->leftJoin('set_topic_chd','tea_class_routine.topic_id','=','set_topic_chd.id')
        ->leftJoin('stu_class_attendance','tea_class_routine.id','=','stu_class_attendance.class_routine_id')
        ->where('tea_class_routine.department_id',$departmentId)
        ->where('tea_class_routine.course_type',$courseTypeId)
        ->where('tea_class_routine.active_status',1)
        ->select('sa_lookup_data.LOOKUP_DATA_NAME as classTypeName','stu_class_attendance.attendance_status','users.name as teacherName','set_class_room.room_no as classRoomNo','set_topic_chd.topic as topicName','tea_class_routine.*')
        ->orderBy('id','DESC')
        ->get();
    
       return view('student_portal.class_routine.index', compact('header','studentClassRoutines'));

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
