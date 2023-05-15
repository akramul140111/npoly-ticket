<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\students_panel\StudentsActivityAttendanceModel;
use App\Models\admin_portal\ActivityEventModel;
use App\Models\User;
use DB;
use Auth;
use Session;

class StudentsActivityAttendanceControllerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activityAttendanceIndex()
    {
        $header = array(
            'pageTitle' => 'Activity Attendance',
            'tableTitle' => 'Activity Attendance List',
            'back' => 'Back'
        );
        $studentId=Auth::user()->student_id;
        $departmentId=Auth::user()->department_id;
        $courseTypeId=Auth::user()->course_type;
        $batch_id=Auth::user()->batch_id;


        $activityAttendances=StudentsActivityAttendanceModel::leftJoin('set_activity_setup','set_activity_setup.activity_id','=','stu_activity_attendance.activity')
        ->leftJoin('set_topic_chd','set_topic_chd.id','=','stu_activity_attendance.topic_name')
        ->leftJoin('users','users.id','=','stu_activity_attendance.activity_authorize')
        ->where('stu_activity_attendance.student_id',$studentId)
        //->where('stu_activity_attendance.course_type_id',$courseTypeId)
        //->where('stu_activity_attendance.department_id',$departmentId)
        //->where('stu_activity_attendance.batch_id',$batch_id)
        ->select('set_activity_setup.activity_name as activityName','set_topic_chd.topic as topicName','users.name as activityAuthorizer','stu_activity_attendance.*')
        ->orderBy('stu_activity_attendance.activity_attendance_id','DESC')
        ->get();
       // dd($activityAttendances);
        return view('student_portal.attendance.activity_attendance.index',compact('header','activityAttendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createActivityAttendance()
    {
        $topics=DB::table('set_topic_chd')
        ->where('set_topic_chd.department_id', Auth::user()->department_id)
        ->where('set_topic_chd.course_type', Auth::user()->course_type)
        ->where('set_topic_chd.course_name', Auth::user()->course_name)
        ->get();

        $student_id = Auth::user()->student_id;
        $mxPlace = DB::select(DB::raw("SELECT place_department, parent_course_type, place_course
            FROM tea_block_placement_chd WHERE student_id=$student_id ORDER BY id DESC LIMIT 0,1"));

        $activityUsers = [];
        $activityEvents = [];
        if(!empty($mxPlace[0]) && !empty($mxPlace[0]->place_department) && !empty($mxPlace[0]->place_course) && !empty($mxPlace[0]->parent_course_type)){
            $activityEvents = DB::table('set_assign_activity')
                ->leftJoin('set_activity_setup','set_assign_activity.activity_id' , '=', 'set_activity_setup.activity_id')
                ->where('set_assign_activity.course_type', $mxPlace[0]->parent_course_type)
                ->where('set_assign_activity.department', $mxPlace[0]->place_department)
                ->where('set_assign_activity.course_name', $mxPlace[0]->place_course)
                ->select('set_activity_setup.activity_id','set_activity_setup.activity_name')
                ->get();

            // activity teacher
            $activityUsers=User::where('USERGRP_ID', 1)
                ->where('course_type', $mxPlace[0]->parent_course_type)
                ->where('department_id', $mxPlace[0]->place_department)
                ->where('course_name', $mxPlace[0]->place_course)
                ->get();

        }

        // $activityUsers=User::where('USERGRP_ID', 1)
        // ->where('department_id', Auth::user()->department_id)
        // ->where('course_type', Auth::user()->course_type)
        // ->where('course_name', Auth::user()->course_name)
        // ->get();

       return view('student_portal.attendance.activity_attendance.create',compact('topics','activityEvents','activityUsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeActivityAttendance(Request $request)
    {

        $max_place_chd_id = $request->max_place_chd_id;
        $block_place_chd_id = null;
        $place_department = null;
        $place_course = null;
        $parent_course_type = null;

        if($max_place_chd_id){
          $plc = DB::table('tea_block_placement_chd')->where('id', $max_place_chd_id)->first();
          if($plc){
            $block_place_chd_id = $plc->id;
            $place_department = $plc->place_department;
            $place_course = $plc->place_course;
            $parent_course_type = $plc->parent_course_type;

          }
        }

      //  print_r(($request->duration_start_time));exit;
        $activityAttendance=new StudentsActivityAttendanceModel();
        $activityAttendance->activity=$request->activity;
        $activityAttendance->topic_name=$request->topic_name;
        $activityAttendance->activity_authorize=$request->activity_authorize;
        $activityAttendance->date=date("Y-m-d", strtotime($request->date));
        $activityAttendance->duration_start_time=$request->duration_start_time;
        $activityAttendance->duration_end_time=$request->duration_end_time;
        $activityAttendance->active_status=1;
        $activityAttendance->created_by=Auth::user()->id;
        $activityAttendance->student_id=Auth::user()->student_id;
        $activityAttendance->batch_id=Auth::user()->batch_id;
        $activityAttendance->department_id=Auth::user()->department_id;
        $activityAttendance->course_type_id=Auth::user()->course_type;
        $activityAttendance->course_id=Auth::user()->course_name;
        $activityAttendance->block_place_chd_id=$block_place_chd_id;
        $activityAttendance->place_department=$place_department;
        $activityAttendance->place_course=$place_course;
        $activityAttendance->course_type=$parent_course_type;
        $activityAttendance->save();
        Session::flash('success', "Data Save Successfully");
        return redirect()->route('activityAttendanceIndex');

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
    public function editActivityAttendance($id)
    {
        $activityInfo = [];
        $activityUsers = [];
        if($id){
            $activityInfo = DB::table('stu_activity_attendance')
            ->where('activity_attendance_id', $id)
            ->select('course_type','place_department','place_course')
            ->first();

            if($activityInfo){
                // activity events
                $activityEvents = DB::table('set_assign_activity')
                ->leftJoin('set_activity_setup','set_assign_activity.activity_id' , '=', 'set_activity_setup.activity_id')
                ->where('set_assign_activity.course_type', $activityInfo->course_type)
                ->where('set_assign_activity.department', $activityInfo->place_department)
                ->where('set_assign_activity.course_name', $activityInfo->place_course)
                ->select('set_activity_setup.activity_id','set_activity_setup.activity_name')
                ->get();

                // activity teacher
                $activityUsers=User::where('USERGRP_ID', 1)
                ->where('course_type', $activityInfo->course_type)
                ->where('department_id', $activityInfo->place_department)
                ->where('course_name', $activityInfo->place_course)
                ->get();
            }
        }

        $topics=DB::table('set_topic_chd')
            ->where('set_topic_chd.course_type', Auth::user()->course_type)
            ->where('set_topic_chd.department_id', Auth::user()->department_id)
            ->where('set_topic_chd.course_name', Auth::user()->course_name)
            ->get();


        //exit;
        //$topics=DB::table('set_topic_chd')->get();
        // $activityEvents=ActivityEventModel::all();
        //$activityUsers=User::where('USERGRP_ID', 1)->get();



        $activityAttendance=StudentsActivityAttendanceModel::where('activity_attendance_id',$id)->first();


        return view('student_portal.attendance.activity_attendance.edit',compact('activityAttendance','topics','activityEvents','activityUsers'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateActivityAttendance(Request $request, $id)
    {

        $activityAttendance= StudentsActivityAttendanceModel::find($id);
        $activityAttendance->activity=$request->activity;
        $activityAttendance->topic_name=$request->topic_name;
        $activityAttendance->activity_authorize=$request->activity_authorize;
        $activityAttendance->date=date("Y-m-d", strtotime($request->date));
        $activityAttendance->duration_start_time=$request->duration_start_time;
        $activityAttendance->duration_end_time=$request->duration_end_time;
        $activityAttendance->active_status=1;
        $activityAttendance->updated_by=Auth::user()->id;
        $activityAttendance->save();
        Session::flash('success', "Data Save Successfully");
        return redirect()->route('activityAttendanceIndex');
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
