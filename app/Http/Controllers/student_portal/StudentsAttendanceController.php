<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\students_panel\StudentsAttendanceModel;
use App\Models\students_panel\InstituteAttendanceModel;
use App\Models\TeaClassRoutineModel;
use DB;
use Auth;
use Session;
class StudentsAttendanceController extends Controller
{

    public function index()
    {
        $header = array(
            'pageTitle' => 'Student Attendance',
            'tableTitle' => 'Student Attendance'
        );

        return view('student_portal.attendance.index',compact('header'));
    }

    public function instituteAttendanceIndex()
    {
        $header = array(
            'pageTitle' => 'Student Attendance',
            'tableTitle' => 'Student Attendance ',
            'back' => 'Back'
        );
        $instAttendances = InstituteAttendanceModel::orderBy('id', 'desc')->get();


        return view('student_portal.attendance.institute_attendance.index',compact('header','instAttendances'));
    }

    public function createInstituteAttendance()
    {
        $classSessions = DB::table('sa_lookup_grp')
                        ->leftJoin('sa_lookup_data','sa_lookup_data.LOOKUP_GRP_ID','=','sa_lookup_grp.LOOKUP_GRP_ID')
                        ->where('sa_lookup_data.LOOKUP_GRP_ID', 18)
                        ->get();

        return view('student_portal.attendance.institute_attendance.create', compact('classSessions'));
    }
    public function storeInstituteAttendance(Request $request)
    {
        $instAttendance =new InstituteAttendanceModel();
        $instAttendance->date=date("Y-m-d H:i:s", strtotime($request->date));
        $instAttendance->submission_time =date("Y-m-d H:i:s");
        $instAttendance->night_duty =$request->night_duty;
        $instAttendance->leave_type =$request->leave_type;
        $instAttendance->created_by=Auth::user()->id;
        $instAttendance->active_status =1;
        $instAttendance->save();
        Session::flash('success', "Data Save Successfully");
        return redirect()->route('instituteAttendanceIndex');

    }
    public function editInstituteAttendance($id)
    {
        $classSessions = DB::table('sa_lookup_grp')
                        ->leftJoin('sa_lookup_data','sa_lookup_data.LOOKUP_GRP_ID','=','sa_lookup_grp.LOOKUP_GRP_ID')
                        ->where('sa_lookup_data.LOOKUP_GRP_ID', 18)
                        ->get();
         $instAttendance = InstituteAttendanceModel::where('id',$id)->first();


       return view('student_portal.attendance.institute_attendance.edit', compact('classSessions','instAttendance'));
    }

    public function updateInstituteAttendance(Request $request, $id)
    {
        $instAttendance=InstituteAttendanceModel::find($id);
        $instAttendance->date=date("Y-m-d", strtotime($request->date));
        $instAttendance->submission_time =date("Y-m-d H:i:s");
        $instAttendance->night_duty =$request->night_duty;
        $instAttendance->leave_type =$request->leave_type;
        $instAttendance->created_by=Auth::user()->id;
        $instAttendance->active_status =1;
        $instAttendance->save();
        Session::flash('success', "Data Update Successfully");
        return redirect()->route('instituteAttendanceIndex');


    }

    public function classAttendanceIndex()
    {

        $header = array(
            'pageTitle' => 'Class Attendance',
            'tableTitle' => 'Class Attendance List',
            'back' => 'Back'
        );
        $teacherOldRoutines = [];
        $teacherRoutines = [];
        $teacherCoreRoutines = [];
        $date=date('Y-m-d');
        $studentId = Auth::user()->student_id;
        $batch_id = Auth::user()->batch_id;
        $departmentId = Auth::user()->department_id;
        $courseTypeId = Auth::user()->course_type;
        $course_name_id = Auth::user()->course_name;

        $mxPlace = DB::selectOne(DB::raw("SELECT MAX(id) AS MXID
            FROM tea_block_placement_chd WHERE student_id=$studentId"));

        $routineID = [];
        $stuPresents = [];
        $max_place_id = 0;
        if($mxPlace){
            $max_place_id = $mxPlace->MXID;

            $plc = DB::table('tea_block_placement_chd')
                ->where('id', $mxPlace->MXID)
                ->select('place_department', 'place_course', 'parent_course_type')->first();

                // echo $plc->place_department.'--85-';
                // echo $plc->place_course.'--86-';
                // echo $plc->parent_course_type.'--25-'; //Stu id = 37

            if(!empty($plc) && !empty($plc->place_department) && !empty($plc->place_course) && !empty($plc->parent_course_type)){

                $teacherCoreRoutines = DB::select(DB::raw("SELECT b.*, b.batch_id,b.class_start_date,
                    b.class_start_time, u.name AS teacherName, c.room_no AS classRoomNo,
                    e.LOOKUP_DATA_NAME AS classTypeName, t.topic AS topicName

                    FROM tea_class_routine b
                    LEFT JOIN users u ON b.teacher_id=u.id
                    LEFT JOIN set_class_room c ON b.class_room=c.id
                    LEFT JOIN sa_lookup_data e ON b.class_type=e.LOOKUP_DATA_ID
                    LEFT JOIN set_topic_chd t ON b.topic_id=t.id

                    WHERE b.batch_id=$batch_id
                    AND b.course_type = $plc->parent_course_type
                    AND b.department_id = $plc->place_department
                    AND b.course_name_id = $plc->place_course
                    AND b.class_start_date = CURDATE()"));

                $teacherCoreRoutines_lastOld = DB::select(DB::raw("SELECT b.*,b.batch_id,b.class_start_date,
                    b.class_start_time,
                    u.name AS teacherName,
                    c.room_no AS classRoomNo,
                    e.LOOKUP_DATA_NAME AS classTypeName,
                    t.topic AS topicName

                    FROM tea_block_placement_chd a
                    LEFT JOIN tea_class_routine b ON a.batch_no=b.batch_id
                    LEFT JOIN users u ON b.teacher_id=u.id
                    LEFT JOIN set_class_room c ON b.class_room=c.id
                    LEFT JOIN sa_lookup_data e ON b.class_type=e.LOOKUP_DATA_ID
                    LEFT JOIN set_topic_chd t ON b.topic_id=t.id

                    WHERE a.batch_no=$batch_id
                    AND a.parent_course_type = $plc->parent_course_type
                    AND a.place_department = $plc->place_department
                    AND a.place_course = $plc->place_course
                    AND b.class_start_date = CURDATE()
                    AND a.student_id = $studentId"));

                /*$teacherCoreRoutines = DB::select(DB::raw("SELECT b.batch_id,b.class_start_date,b.class_start_time,c.room_no, u.name
                    FROM tea_block_placement_chd a
                    LEFT JOIN tea_class_routine b ON a.batch_no=b.batch_id
                    LEFT JOIN users u ON b.teacher_id=u.id
                    LEFT JOIN set_class_room c ON b.class_room=c.id

                    WHERE a.batch_no=11
                    AND a.parent_course_type = 25
                    AND a.place_department = 85
                    AND a.place_course = 86
                    AND b.class_start_date = CURDATE()
                    AND a.student_id = 2"));*/


                $teacherCoreRoutines_p = DB::select(DB::raw("SELECT c.*, e.LOOKUP_DATA_NAME AS classTypeName,
                    u.name AS teacherName,
                    g.room_no AS classRoomNo,
                    t.topic AS topicName

                    FROM tea_class_routine c
                    LEFT JOIN tea_block_placement_chd a ON c.course_type=a.parent_course_type
                    LEFT JOIN sa_lookup_data e ON c.class_type=e.LOOKUP_DATA_ID
                    LEFT JOIN users u ON c.teacher_id=u.id
                    LEFT JOIN set_class_room g ON c.class_room=g.id
                    LEFT JOIN set_topic_chd t ON c.topic_id=t.id

                    WHERE a.batch_no = $batch_id
                    AND a.parent_course_type = $plc->parent_course_type
                    AND a.place_department = $plc->place_department
                    AND a.place_course = $plc->place_course
                    AND c.class_start_date = CURDATE()
                    AND a.student_id = $studentId
                    ORDER BY c.id DESC"));

                $teacherCoreRoutinesNEW_OLD = DB::select(DB::raw("SELECT e.LOOKUP_DATA_NAME AS classTypeName,
                    u.name AS teacherName,
                    g.room_no AS classRoomNo,
                    t.topic AS topicName,c.*

                    FROM tea_class_routine c
                    -- LEFT JOIN tea_block_placement_chd a ON c.course_type=a.parent_course_type
                    LEFT JOIN tea_block_placement_chd b ON c.department_id=b.place_department
                    LEFT JOIN tea_block_placement_chd d ON c.course_name_id=d.place_course
                    LEFT JOIN sa_lookup_data e ON c.class_type=e.LOOKUP_DATA_ID
                    LEFT JOIN users u ON c.teacher_id=u.id
                    LEFT JOIN set_class_room g ON c.class_room=g.id
                    LEFT JOIN set_topic_chd t ON c.topic_id=t.id

                    WHERE b.place_department=$plc->place_department
                    AND c.course_type=$plc->parent_course_type
                    AND c.course_name_id=$plc->place_course
                    AND c.class_start_date = CURDATE()
                    AND b.student_id=$studentId
                    AND b.batch_no= $batch_id
                    ORDER BY id DESC"));

                foreach($teacherCoreRoutines as $t){
                    $routineID[] = $t->id;
                }


                $z = 1;
                $wh1 = '';
                // routine id list for hit to attendance table
                if(sizeof($routineID) > 0){
                    $wh1.=" AND ";
                    $wh1.=" ( ";
                    foreach($routineID as $s){
                        $ST[] = $s;
                        if($z==1){
                            $wh1.=" `a`.`class_routine_id` = $s ";
                        }else{
                            $wh1.=" OR `a`.`class_routine_id` = $s ";
                        }
                        $z++;
                    }
                    $wh1.=" ) ";

                }

                $stuPresents = DB::select(DB::raw("SELECT * FROM stu_class_attendance a
                WHERE a.student_id=$studentId
                $wh1
                "));

                // $attendanceID = [];
                // if(size($stuPresents)>0){
                //     foreach($stuPresents as $ $ss){
                //         $attendanceID[] = $ss->id;
                //     }
                // }

                $teacherCoreRoutines44555 = DB::select(DB::raw("SELECT e.LOOKUP_DATA_NAME as classTypeName,
                f.attendance_status,
                u.name as teacherName,
                f.student_id,
                g.room_no as classRoomNo,
                t.topic as topicName,c.* FROM tea_class_routine c
                LEFT JOIN tea_block_placement_chd b ON c.department_id=b.place_department
                LEFT JOIN tea_block_placement_chd d ON c.course_name_id=d.place_course
                LEFT JOIN sa_lookup_data e ON c.class_type=e.LOOKUP_DATA_ID
                LEFT JOIN stu_class_attendance f on c.id=f.class_routine_id
                LEFT JOIN users u ON c.teacher_id=u.id
                LEFT JOIN set_class_room g on c.class_room=g.id
                LEFT JOIN set_topic_chd t ON c.topic_id=t.id
                WHERE b.place_department=$plc->place_department
                AND c.course_type=$plc->parent_course_type
                AND c.course_name_id=$plc->place_course
                AND c.class_start_date = CURDATE()
                AND b.student_id=$studentId
                AND b.batch_no= $batch_id
                ORDER BY id DESC"));

                // echo '<pre>';
                // echo count($teacherCoreRoutines);

                // foreach($teacherCoreRoutines as $ff){
                //     echo date('d-m-Y', strtotime($ff->class_start_date)).'<br>';
                // }
                // exit;





                $teacherRoutines = DB::select(DB::raw("SELECT e.LOOKUP_DATA_NAME as classTypeName,f.attendance_status,
                u.name as teacherName,f.student_id,g.room_no as classRoomNo,
                t.topic as topicName,c.* FROM tea_class_routine c
                LEFT JOIN tea_block_placement_chd b ON c.department_id=b.place_department
                LEFT JOIN tea_block_placement_chd d ON c.course_name_id=d.place_course
                LEFT JOIN sa_lookup_data e ON c.class_type=e.LOOKUP_DATA_ID
                LEFT JOIN stu_class_attendance f on c.id=f.class_routine_id
                LEFT JOIN users u ON c.teacher_id=u.id
                LEFT JOIN set_class_room g on c.class_room=g.id
                LEFT JOIN set_topic_chd t ON c.topic_id=t.id
                WHERE b.place_department=$plc->place_department
                AND c.course_type=$plc->parent_course_type
                AND c.course_name_id=$plc->place_course
                AND c.class_start_date = CURDATE()
                AND b.student_id=$studentId
                AND b.batch_no= $batch_id ORDER BY id DESC"));

                $teacherOldRoutines = DB::select(DB::raw("SELECT e.LOOKUP_DATA_NAME as classTypeName,f.attendance_status,
                u.name as teacherName,f.student_id,g.room_no as classRoomNo,
                t.topic as topicName,c.* FROM tea_class_routine c
                LEFT JOIN tea_block_placement_chd b ON c.department_id=b.place_department
                LEFT JOIN tea_block_placement_chd d ON c.course_name_id=d.place_course
                LEFT JOIN sa_lookup_data e ON c.class_type=e.LOOKUP_DATA_ID
                LEFT JOIN stu_class_attendance f on c.id=f.class_routine_id
                LEFT JOIN users u ON c.teacher_id=u.id
                LEFT JOIN set_class_room g on c.class_room=g.id
                LEFT JOIN set_topic_chd t ON c.topic_id=t.id
                WHERE b.place_department=$plc->place_department
                AND c.course_type=$plc->parent_course_type
                AND c.course_name_id=$plc->place_course
                AND c.class_start_date < CURDATE()
                AND b.student_id=$studentId
                AND b.batch_no= $batch_id ORDER BY id DESC"));
            }

        }

        return view('student_portal.attendance.class_attendance.index',compact('header','teacherRoutines','studentId','teacherOldRoutines','teacherCoreRoutines','stuPresents','max_place_id'));
    }

    public function updateClassAttendance(Request $request, $id)
    {

        $student_id = Auth::user()->student_id;
        $mxID = '';
        if($student_id){

            $mxPlace = DB::select(DB::raw("SELECT id, place_department, parent_course_type, place_course
            FROM tea_block_placement_chd WHERE student_id=$student_id ORDER BY id DESC LIMIT 0,1"));

            $block_place_chd_id = null;
            $place_department = null;
            $parent_course_type = null;
            $place_course = null;

            if($mxPlace){
                $block_place_chd_id = $mxPlace[0]->id;
                $place_department = $mxPlace[0]->place_department;
                $parent_course_type = $mxPlace[0]->parent_course_type;
                $place_course = $mxPlace[0]->place_course;

                $routineData=TeaClassRoutineModel::where('id',$id)->first();
                $classAttendanceData=new StudentsAttendanceModel();
                $classAttendanceData->class_date=date("Y-m-d", strtotime($routineData->class_start_date));
                $classAttendanceData->student_id=Auth::user()->student_id;
                $classAttendanceData->department_id=$routineData->department_id;
                $classAttendanceData->class_start_time=date("Y-m-d H:i:s",strtotime($routineData->class_start_time));
                $classAttendanceData->class_end_time=date("Y-m-d H:i:s",strtotime($routineData->class_end_time));
                $classAttendanceData->attendance_status=1;
                $classAttendanceData->day_name=$routineData->day_name;
                $classAttendanceData->class_type=$routineData->class_type;
                $classAttendanceData->teacher_id=$routineData->teacher_id;
                $classAttendanceData->class_room=$routineData->class_room;
                $classAttendanceData->topic_id=$routineData->topic_id;
                $classAttendanceData->batch_id=$routineData->batch_id;
                $classAttendanceData->block_id=$routineData->block_id;
                $classAttendanceData->class_routine_id=$routineData->id;
                $classAttendanceData->active_status=1;
                $classAttendanceData->created_by=Auth::user()->id;
                $classAttendanceData->course_type= $routineData->course_type;

                $classAttendanceData->block_place_chd_id= $block_place_chd_id;
                $classAttendanceData->place_department= $place_department;
                $classAttendanceData->place_course= $place_course;
                $classAttendanceData->parent_course_type= $parent_course_type;
                $classAttendanceData->save();

            }

        }

        Session::flash('success', "Successfully");
        return redirect()->route('classAttendanceIndex');


    }

    public function activityAttendanceIndex()
    {


        $header = array(
            'pageTitle' => 'Activity Attendance',
            'tableTitle' => 'Activity Attendance',
            'back' => 'Back'
        );

        $instAttendances = InstituteAttendanceModel::all();
        return view('student_portal.attendance.activity_attendance.index',compact('header','instAttendances'));

    }

    public function createActivityAttendance()
    {
        $classSessions = DB::table('sa_lookup_grp')
        ->leftJoin('sa_lookup_data','sa_lookup_data.LOOKUP_GRP_ID','=','sa_lookup_grp.LOOKUP_GRP_ID')
        ->where('sa_lookup_data.LOOKUP_GRP_ID', 18)
        ->get();
       return view('student_portal.attendance.activity_attendance.create', compact('classSessions'));

    }


}
