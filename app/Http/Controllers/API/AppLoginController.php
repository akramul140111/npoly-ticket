<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\User;
use App\Models\StudentInofModel;
use DB;

class AppLoginController extends BaseController
{

    public function signin(Request $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $authUser = Auth::user();

            $fcm_id = request('fcm_reg_id');
            $app_id = request('app_id');
            $osVersion = request('os_version');
            $os_type = request('os_type');
            $app_version = request('app_version');
            $deviceModel = request('mobile_manufacture');
            $pkg_name = request('pkg_name');
            $FCM_REG_ID = Auth::user()->fcm_reg_id;

            $mobileAppsInfo = DB::table('sa_mobiapps')->select('maver_code')->where('mobiaps_id',$app_id)->where('mapps_name',$pkg_name)->first();


            if (!empty($fcm_id)) {
                if (!empty($FCM_REG_ID)) {
                    if ($fcm_id != $FCM_REG_ID) {
                        DB::table('users')->where('id', '=', Auth::user()->id)->update([
                            'fcm_reg_id' => $fcm_id,
                            //'maver_code' => $appVersionCode,
                            'os_version' => $osVersion,
                            'os_type'    => $os_type,
                            'mobile_manufacture' => $deviceModel,
                            'app_version' => $app_version,
                            'last_login' => date('d-M-Y h:i:s A')
                        ]);
                    }else{
                        DB::table('users')->where('id', '=', Auth::user()->id)->update([
                            'fcm_reg_id' => $fcm_id,
                            //'maver_code' => $appVersionCode,
                            'os_version' => $osVersion,
                            'os_type'    => $os_type,
                            'mobile_manufacture' => $deviceModel,
                            'app_version' => $app_version,
                            'last_login' => date('d-M-Y h:i:s A')
                        ]);
                    }
                }
            }

            $success['token'] =  $authUser->createToken('MyAuthApp')->plainTextToken;
            $success['name'] =  $authUser->name;
            $success['maver_code'] =  $mobileAppsInfo->maver_code;

            $success['user_info'] = DB::table('stu_students_information as dt1')
                ->leftJoin('sa_lookup_data as dt2', 'dt1.gender', '=', 'dt2.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt3', 'dt1.department', '=', 'dt3.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt4', 'dt1.course_type', '=', 'dt4.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt5', 'dt1.course_name', '=', 'dt5.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt6', 'dt1.session_years', '=', 'dt6.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt7', 'dt1.batch_no', '=', 'dt7.LOOKUP_DATA_ID')
                ->Where('dt1.active_status', '=',1)
                ->where('dt1.student_id',$authUser->student_id)
                ->select('dt1.student_id','dt1.students_name','dt1.stu_id','dt1.date_of_birth','dt1.students_image','dt1.students_signature','dt1.department','dt1.course_type','dt1.course_name','dt2.LOOKUP_DATA_NAME AS GENDER','dt3.LOOKUP_DATA_NAME AS DEPARTMENT','dt4.LOOKUP_DATA_NAME AS COURSE_TYPE','dt5.LOOKUP_DATA_NAME AS COURSE_NAME','dt6.LOOKUP_DATA_NAME AS SESSION_YEAR','dt7.LOOKUP_DATA_NAME AS BATCH')
                ->first();

            $success['student_image'] = DB::selectOne(DB::raw("select CONCAT('uploads/student_information/', students_image) AS image_location from stu_students_information where student_id = $authUser->student_id"));
            $success['students_signature'] = DB::selectOne(DB::raw("select CONCAT('uploads/student_information/signature/', students_signature) AS signature_location from stu_students_information where student_id = $authUser->student_id"));


           // return $this->sendResponse($success, 'User signed in');

            return response()->json([
                "success" => true,
                "message" => "User signed in successfully.",
                "data" => $success
            ]);
        }
        else{
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        }
    }

    public function signups(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyAuthApp')->plainTextToken;
        $success['name'] =  $user->name;

        return $this->sendResponse($success, 'User created successfully.');
    }
    public function class_routine(Request $request){
        $input = $request->all();
        $department_id = $input['department_id'];
        $course_type = $input['course_type'];
        $course_name_id = $input['course_name_id'];
        $stuClassRoutineInfo =  DB::table('tea_class_routine as cr')
            ->leftJoin('sa_lookup_data as lkp','cr.batch_id','=','lkp.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lk','cr.department_id','=','lk.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt4', 'cr.course_type', '=', 'dt4.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt5', 'cr.course_name_id', '=', 'dt5.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt6', 'cr.class_type', '=', 'dt6.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt7', 'cr.block_id', '=', 'dt7.LOOKUP_DATA_ID')
            ->leftJoin('set_topic_chd as tpchd', 'cr.topic_id', '=', 'tpchd.id')
            ->leftJoin('users as u', 'cr.teacher_id', '=', 'u.id')
            ->leftJoin('set_class_room as rm', 'cr.class_room', '=', 'rm.id')
            ->select('cr.*','lkp.LOOKUP_DATA_NAME as BATCH_NO','lk.LOOKUP_DATA_NAME as DEPT_NAME','dt4.LOOKUP_DATA_NAME AS COURSE_TYPE','dt5.LOOKUP_DATA_NAME AS COURSE_NAME',
                'u.name as TEACHER_NAME','dt6.LOOKUP_DATA_NAME as CLASS_NAME','tpchd.topic as TOPIC_NAME',
                'dt7.LOOKUP_DATA_NAME as BLOCK_NAME','rm.room_no')
            ->where('cr.department_id',$department_id)
            ->where('cr.course_type',$course_type)
            ->where('cr.course_name_id',$course_name_id)
            ->where('cr.active_status',1)
            ->orderBy('cr.class_start_date','desc')
            ->get();
        return response()->json([
            "success" => true,
            "message" => "Data get successfully.",
            "data" => $stuClassRoutineInfo
        ]);
    }

    public function get_events(Request $request){
        $input = $request->all();
        $department_id = $input['department_id'];
        $course_type = $input['course_type'];
        $course_name_id = $input['course_name_id'];
        $data['event_info'] =  DB::table('set_academic_calendar as ac')
            ->leftJoin('stu_activity_attendance as sact','ac.id','=','sact.activity_attendance_id')
            ->leftJoin('sa_lookup_data as lkp','ac.batch','=','lkp.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lk','ac.department','=','lk.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkct','ac.course_type','=','lkct.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkcn','ac.course_name','=','lkcn.LOOKUP_DATA_ID')
            ->leftJoin('set_activity_setup as act','ac.event_type','=','act.activity_id')
            ->leftJoin('set_topic_chd as tpchd', 'ac.topic', '=', 'tpchd.id')
            ->leftJoin('users as u', 'sact.activity_authorize', '=', 'u.id')
            ->select('ac.*','lkp.LOOKUP_DATA_NAME as BATCH_NO','lk.LOOKUP_DATA_NAME as DEPT_NAME',
                'lkct.LOOKUP_DATA_NAME as COURSE_TYPE', 'lkcn.LOOKUP_DATA_NAME as COURSE_NAME', 'tpchd.topic as TOPIC_NAME','act.activity_name','u.name as activity_authorize')
            ->where('ac.department',$department_id)
            ->where('ac.course_type',$course_type)
            ->where('ac.course_name',$course_name_id)
            ->where('ac.active_status',1)
            ->get();


            $data['teacher_list'] = DB::table('users')
                ->where('department_id', '=',$department_id)
                ->where('course_type', '=',$course_type)
                ->where('course_name', '=', $course_name_id)
                ->where('USERGRP_ID', 1)
                ->where('active_status', '=',1)
                ->select('id','name')
                ->orderBy('name','ASC')
                ->get();

        return response()->json([
            "success" => true,
            "message" => "Data get successfully.",
            "data" => $data
        ]);
    }

    public function getGeoData(Request $request){
        $input = $request->all();
        $Geo_GROUP_ID = $input['Geo_GROUP_ID'];
        $geoInof = DB::table("geo_data")->select('GeoId','Geo_GROUP_ID','lat','lng','isActive')->where('Geo_GROUP_ID',$Geo_GROUP_ID)->get();

        return response()->json([
            "success" => true,
            "message" => "Data get successfully.",
            "data" => $geoInof
        ]);

    }
    public function checkStudentCheckAttendance(Request $request){
        $input = $request->all();
        $student_id = $input['student_id'];
        $class_routint_id = $input['class_routint_id'];
        $class_start_date = date('Y-m-d',strtotime($input['class_start_date']));
        $studentInfo = DB::table('stu_students_information')->select('department','course_type','course_name','batch_no')->where('student_id',$student_id)->first();

        $success['calss_atten_status'] = DB::table("stu_class_attendance")
                                    ->select("id")
                                    ->where('class_routine_id',$class_routint_id)
                                    ->where('department_id',$studentInfo->department)
                                    ->where('batch_id',$studentInfo->batch_no)
                                    ->where('course_type',$studentInfo->course_type)
                                    ->where('class_date',$class_start_date)
                                    ->where('student_id',$student_id)
                                    ->count();
        $success['status'] =  'true';
        return response()->json([
            "success" => true,
            "message" => "Get Attendance Status successfully.",
            "data" => $success
        ]);
    }
    public function checkStudentActivityAttendance(Request $request){
        $input = $request->all();
        $student_id = $input['student_id'];
        $activity = $input['activity'];
        $activity_date = date('Y-m-d',strtotime($input['activity_date']));
        $studentInfo = DB::table('stu_students_information')->select('department','course_type','course_name','batch_no')->where('student_id',$student_id)->first();



        $success['activity_atten_status'] = DB::table("stu_activity_attendance")
            ->select("id")
            ->where('activity',$activity)
            ->where('department_id',!empty($studentInfo->department)?$studentInfo->department:'')
            ->where('batch_id',!empty($studentInfo->batch_no)?$studentInfo->batch_no:'')
            ->where('course_id',!empty($studentInfo->course_type)?$studentInfo->course_type:'')
            ->where('course_name_id',!empty($studentInfo->course_name)?$studentInfo->course_name:'')
            ->where('date',$activity_date)
            ->where('student_id',$student_id)
            ->count();
        $success['status'] =  'true';
        return response()->json([
            "success" => true,
            "message" => "Get Attendance Status successfully.",
            "data" => $success
        ]);
    }
    public function checkStudentBlock(Request $request){
        $input = $request->all();
        $student_id = $input['student_id'];
        if($student_id){

            $mxPlace = DB::select(DB::raw("SELECT id, place_department, parent_course_type, place_course
            FROM tea_block_placement_chd WHERE student_id=$student_id ORDER BY id DESC LIMIT 0,1"));

           $success['block_status'] = count($mxPlace);
            $success['status'] =  'true';
            return response()->json([
                "success" => true,
                "message" => "Block Status Status successfully.",
                "data" => $success
            ]);

        }
    }
    public function attenStudentCheckAttendance(Request $request){
        $input = $request->all();
        $student_id = $input['student_id'];
        $studentInfo = DB::table('stu_students_information')->select('department','course_type','course_name','batch_no')->where('student_id',$student_id)->first();
        $class_date = date('Y-m-d',strtotime($input['class_date']));
        $day_name = $input['day_name'];
        $class_routine_id = $input['class_routine_id'];
        $block_id = $input['block_id'];
        $class_start_time = date('Y-m-d h:i:s',strtotime($input['class_start_time']));
        $class_end_time = date('Y-m-d h:i:s',strtotime($input['class_end_time']));
        //$class_end_time = $input['class_end_time'];
        $attendance_status = $input['attendance_status'];
        $class_type = $input['class_type'];
        $class_room = $input['class_room'];
        $teacher_id = $input['teacher_id'];
        $topic_id = $input['topic_id'];
        $lat = $input['lat'];
        $lng = $input['lng'];

        DB::table('stu_class_attendance')->insert([
            'student_id' =>$student_id,
            'department_id' =>$studentInfo->department,
            'batch_id' =>$studentInfo->batch_no,
            'course_type' =>$studentInfo->course_type,
            'class_date' =>$class_date,
            'day_name' =>$day_name,
            'class_routine_id' =>$class_routine_id,
            'block_id' =>$block_id,
            'class_start_time' =>$class_start_time,
            'class_end_time' =>$class_end_time,
            'class_type' =>$class_type,
            'class_room' =>$class_room,
            'teacher_id' =>$teacher_id,
            'topic_id' =>$topic_id,
            'attendance_status' =>$attendance_status,
            'active_status' =>1,
            'lat' =>$lat,
            'lng' =>$lng
        ]);

        $success['status'] =  'true';
        return response()->json([
            "success" => true,
            "message" => "Attendance successfully.",
            "data" => $success
        ]);


    }
    public function StudentAttendanceOld(Request $request){


//        $validator = Validator::make($request->all(), [
//            'department' => 'required',
//            'course_type' => 'required',
//            'course_name' => 'required',
//            'attendance_type' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError('Error validation', $validator->errors());
//        }

        $input = $request->all();
        $student_id = $input['student_id'];
        //$date = $input['date'];
        $date = date('Y-m-d',strtotime($input['date']));;
        //$submission_time = date('Y-m-d h:i',strtotime($input['submission_time']));;
        $submission_time = $input['submission_time'];
        $submission_end_time = $input['submission_end_time'];
        $duty_session = $input['duty_session'];
        $inistitute = $input['inistitute'];
        $attendance_type = $input['attendance_type'];
        $class_routine_id = $input['class_routine_id'];
        $attendance_status = $input['attendance_status'];
        $activity_authorize = $input['activity_authorize'];
        $lat = $input['lat'];
        $lng = $input['lng'];
        $activity = $input['activity'];
        if($attendance_type=="C"){

            DB::table('stu_class_attendance')->where('class_routine_id', '=', $class_routine_id)->update([
                'attendance_status' =>$attendance_status,
                'lat' =>$lat,
                'lng' =>$lng
            ]);
        }else if($attendance_type=="A"){
            DB::table('stu_activity_attendance')->where('activity', '=', $activity)->update([
                'present_absent_status' =>$attendance_status,
                'activity_authorize' =>$activity_authorize,
                'lat' =>$lat,
                'lng' =>$lng
            ]);
        }else{
            $maxId = DB::selectOne(DB::raw("select max(id) as MAX_ID from stu_institute_attendance where student_id =$student_id"));
            $date = DB::table('stu_institute_attendance')->select('date')->where('id',$maxId->MAX_ID)->first();
            $dateFromat = date('Y-m-d',strtotime($date->date));
            $dateFromat2 = date('Y-m-d',strtotime($input['date']));
           if($dateFromat == $dateFromat2){
               DB::table('stu_institute_attendance')->where('id', '=', $maxId->MAX_ID)->update([
                   'submission_end_time' =>$submission_end_time
               ]);
           }else{
               DB::table('stu_institute_attendance')->insert([
                   'student_id' =>$student_id,
                   'date' =>$dateFromat2,
                   'submission_time' =>$submission_time,
                   'duty_session' =>$duty_session,
                   'inistitute' =>$inistitute,
                   'attendance_status' =>$attendance_status,
                   'active_status' =>1,
                   'lat' =>$lat,
                   'lng' =>$lng
               ]);
           }

        }

        $success['status'] =  'true';
        return response()->json([
            "success" => true,
            "message" => "Attendance successfully.",
            "data" => $success
        ]);
        //return $this->sendResponse($success, 'Attendance successfully.');
    }

    public function StudentAttendance(Request $request){
//        $validator = Validator::make($request->all(), [
//            'department' => 'required',
//            'course_type' => 'required',
//            'course_name' => 'required',
//            'attendance_type' => 'required',
//        ]);
//
//        if($validator->fails()){
//            return $this->sendError('Error validation', $validator->errors());
//        }

        $input = $request->all();
        $student_id = $input['student_id'];
        $attendance_type = $input['attendance_type'];
        $attendance_status = $input['attendance_status'];
        $lat = $input['lat'];
        $lng = $input['lng'];
        //$activity = $input['activity'];
        if($attendance_type=="C"){
//            DB::table('stu_class_attendance')->where('class_routine_id', '=', $class_routine_id)->update([
//                'attendance_status' =>$attendance_status,
//                'lat' =>$lat,
//                'lng' =>$lng
//            ]);
            $mxPlace = DB::select(DB::raw("SELECT id, place_department, parent_course_type, place_course
            FROM tea_block_placement_chd WHERE student_id=$student_id ORDER BY id DESC LIMIT 0,1"));

            $block_place_chd_id = null;
            $place_department = null;
            $parent_course_type = null;
            $place_course = null;

            $studentInfo = DB::table('stu_students_information')->select('department','course_type','course_name','batch_no')->where('student_id',$student_id)->first();
            $class_date = date('Y-m-d',strtotime($input['class_date']));
            $day_name = $input['day_name'];
            $class_routine_id = $input['class_routine_id'];
            $block_id = $input['block_id'];
            $class_start_time = date('Y-m-d h:i:s',strtotime($input['class_start_time']));
            $class_end_time = date('Y-m-d h:i:s',strtotime($input['class_end_time']));

            //$class_end_time = $input['class_end_time'];
            $attendance_status = $input['attendance_status'];
            $class_type = $input['class_type'];
            $class_room = $input['class_room'];
            $teacher_id = $input['teacher_id'];
            $topic_id = $input['topic_id'];
            $lat = $input['lat'];
            $lng = $input['lng'];
            if($mxPlace){
                $block_place_chd_id = $mxPlace[0]->id;
                $place_department = $mxPlace[0]->place_department;
                $parent_course_type = $mxPlace[0]->parent_course_type;
                $place_course = $mxPlace[0]->place_course;

                DB::table('stu_class_attendance')->insert([
                    'student_id' =>$student_id,
                    'department_id' =>$studentInfo->department,
                    'batch_id' =>$studentInfo->batch_no,
                    'course_type' =>$studentInfo->course_type,
                    'class_date' =>$class_date,
                    'day_name' =>$day_name,
                    'class_routine_id' =>$class_routine_id,
                    'block_id' =>$block_id,
                    'class_start_time' =>$class_start_time,
                    'class_end_time' =>$class_end_time,
                    'class_type' =>$class_type,
                    'class_room' =>$class_room,
                    'teacher_id' =>$teacher_id,
                    'topic_id' =>$topic_id,
                    'attendance_status' =>$attendance_status,
                    'active_status' =>1,
                    'lat' =>$lat,
                    'lng' =>$lng,
                    'block_place_chd_id'=>$block_place_chd_id,
                    'place_department'=>$place_department,
                    'place_course'=>$place_course,
                    'parent_course_type'=>$parent_course_type,
                ]);
            }


        }else if($attendance_type=="A"){
            $activity_authorize = $input['activity_authorize'];
            DB::table('stu_activity_attendance')->where('activity', '=', $activity)->update([
                'present_absent_status' =>$attendance_status,
                'activity_authorize' =>$activity_authorize,
                'lat' =>$lat,
                'lng' =>$lng
            ]);
        }else{
            $date = date('Y-m-d',strtotime($input['date']));;
            $submission_time = $input['submission_time'];
            $duty_session = $input['duty_session'];
            $inistitute = $input['inistitute'];
            $submission_end_time = $input['submission_end_time'];
            $maxId = DB::selectOne(DB::raw("select max(id) as MAX_ID from stu_institute_attendance where student_id =$student_id"));
            $date = DB::table('stu_institute_attendance')->select('date')->where('id',$maxId->MAX_ID)->first();
            $dateFromat = date('Y-m-d',strtotime($date->date));
            $dateFromat2 = date('Y-m-d',strtotime($input['date']));
            if($dateFromat == $dateFromat2){
                DB::table('stu_institute_attendance')->where('id', '=', $maxId->MAX_ID)->update([
                    'submission_end_time' =>$submission_end_time
                ]);
            }else{
                DB::table('stu_institute_attendance')->insert([
                    'student_id' =>$student_id,
                    'date' =>$dateFromat2,
                    'submission_time' =>$submission_time,
                    'duty_session' =>$duty_session,
                    'inistitute' =>$inistitute,
                    'attendance_status' =>$attendance_status,
                    'active_status' =>1,
                    'lat' =>$lat,
                    'lng' =>$lng
                ]);
            }

        }

        $success['status'] =  'true';
        return response()->json([
            "success" => true,
            "message" => "Attendance successfully.",
            "data" => $success
        ]);
        //return $this->sendResponse($success, 'Attendance successfully.');
    }

    public function getStudentAttendance(Request $request){
        $input = $request->all();
        $attendance_type = $input['attendance_type'];
        $student_id = $input['student_id'];
        $fromDate =date('Y-m-d',strtotime($input['from_date']));
        $toDate = date('Y-m-d',strtotime($input['to_date']));
        //$startDate = '2021-10-19';
        //$endDate = '2021-10-19';

        if($attendance_type =="I"){
           //$studentInfo = DB::table('stu_students_information')->select('department','course_name','session_years')->where('student_id',19)->first();
          $data = DB::table('stu_institute_attendance as ina')
                         ->leftJoin('stu_students_information as stinfo','ina.student_id','=','stinfo.student_id')
                         ->leftJoin('sa_lookup_data as lk','stinfo.department','=','lk.LOOKUP_DATA_ID')
                         ->leftJoin('sa_lookup_data as dt4', 'stinfo.course_name', '=', 'dt4.LOOKUP_DATA_ID')
                         ->leftJoin('sa_lookup_data as dt6', 'stinfo.session_years', '=', 'dt6.LOOKUP_DATA_ID')
                         ->select('ina.inistitute','ina.attendance_status','ina.date','ina.submission_time','ina.submission_end_time','lk.LOOKUP_DATA_NAME as DEPT_NAME,','dt4.LOOKUP_DATA_NAME AS COURSE_NAME','dt6.LOOKUP_DATA_NAME AS SESSION')
                          ->where('ina.student_id',$student_id)
                          ->where('ina.active_status',1)
                          ->whereBetween('date', [$fromDate, $toDate])
                        ->get();
            return response()->json([
                "success" => true,
                "message" => "Data get successfully.",
                "data" => $data
            ]);

        }else if($attendance_type =="C"){
            //$data =DB::select(DB::raw("SELECT * FROM tea_class_routine WHERE DATE(class_start_date) BETWEEN '$fromDate' AND '$toDate';"));

//            $data = DB::table('tea_class_routine')
//                ->select('*')
//                ->where('active_status',1)
//                //->where()
//                ->whereBetween('class_start_date', [$fromDate, $toDate])
//                ->get();

            $data =  DB::table('tea_class_routine as cr')
                ->leftJoin('stu_class_attendance as cla','cr.id','=','cla.class_routine_id')
                ->leftJoin('sa_lookup_data as lkp','cr.batch_id','=','lkp.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lk','cr.department_id','=','lk.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt4', 'cr.course_type', '=', 'dt4.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt5', 'cr.course_name_id', '=', 'dt5.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt6', 'cr.class_type', '=', 'dt6.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt7', 'cr.block_id', '=', 'dt7.LOOKUP_DATA_ID')
                ->leftJoin('set_topic_chd as tpchd', 'cr.topic_id', '=', 'tpchd.id')
                ->leftJoin('users as u', 'cr.teacher_id', '=', 'u.id')
                ->leftJoin('set_class_room as rm', 'cr.class_room', '=', 'rm.id')
                ->select('cr.*','lkp.LOOKUP_DATA_NAME as BATCH_NO','lk.LOOKUP_DATA_NAME as DEPT_NAME','dt4.LOOKUP_DATA_NAME AS COURSE_TYPE','dt5.LOOKUP_DATA_NAME AS COURSE_NAME',
                    'u.name as TEACHER_NAME','dt6.LOOKUP_DATA_NAME as CLASS_NAME','tpchd.topic as TOPIC_NAME',
                    'dt7.LOOKUP_DATA_NAME as BLOCK_NAME','rm.room_no','cla.attendance_status')
                ->where('cr.active_status',1)
                ->where('cla.student_id',$student_id)
                ->whereBetween('class_start_date', [$fromDate, $toDate])
                ->get();

            return response()->json([
                "success" => true,
                "message" => "Data get successfully.",
                "data" => $data
            ]);
        }else{
            //$data =DB::select(DB::raw("SELECT * FROM set_academic_calendar WHERE DATE(start) BETWEEN '$fromDate' AND '$toDate';"));

            $data =  DB::table('set_academic_calendar as ac')
                ->leftJoin('stu_activity_attendance as sact','ac.id','=','sact.activity_attendance_id')
                ->leftJoin('sa_lookup_data as lkp','ac.batch','=','lkp.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lk','ac.department','=','lk.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkct','ac.course_type','=','lkct.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkcn','ac.course_name','=','lkcn.LOOKUP_DATA_ID')
                ->leftJoin('set_activity_setup as act','ac.event_type','=','act.activity_id')
                ->leftJoin('set_topic_chd as tpchd', 'ac.topic', '=', 'tpchd.id')
                ->leftJoin('users as u', 'sact.activity_authorize', '=', 'u.id')
                ->select('ac.*','lkp.LOOKUP_DATA_NAME as BATCH_NO','lk.LOOKUP_DATA_NAME as DEPT_NAME',
                    'lkct.LOOKUP_DATA_NAME as COURSE_TYPE', 'lkcn.LOOKUP_DATA_NAME as COURSE_NAME', 'tpchd.topic as TOPIC_NAME','act.activity_name','sact.present_absent_status as attendance_status','u.name as activity_authorize')
                ->whereBetween('start', [$fromDate, $toDate])
                ->where('sact.student_id',$student_id)
                ->where('ac.active_status',1)
                ->get();





            return response()->json([
                "success" => true,
                "message" => "Data get successfully.",
                "data" => $data
            ]);
        }
    }
    public function getStudentActivityAttendance(Request $request){
        $input = $request->all();
        $student_id = $input['student_id'];

//        $data = DB::table('stu_institute_attendance as ina')
//            ->leftJoin('stu_students_information as stinfo','ina.student_id','=','stinfo.student_id')
//            ->leftJoin('sa_lookup_data as lk','stinfo.department','=','lk.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as dt4', 'stinfo.course_name', '=', 'dt4.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as dt6', 'stinfo.session_years', '=', 'dt6.LOOKUP_DATA_ID')
//            ->select('ina.inistitute','ina.attendance_status','ina.date','ina.submission_time','ina.submission_end_time','lk.LOOKUP_DATA_NAME as DEPT_NAME,','dt4.LOOKUP_DATA_NAME AS COURSE_NAME','dt6.LOOKUP_DATA_NAME AS SESSION')
//            ->where('ina.student_id',$student_id)
//            ->where('ina.active_status',1)
//            //->whereBetween('date', [$fromDate, $toDate])
//            ->get();

//        $data =  DB::table('set_academic_calendar as ac')
//            ->leftJoin('stu_activity_attendance as sact','ac.id','=','sact.activity_attendance_id')
//            ->leftJoin('sa_lookup_data as lkp','ac.batch','=','lkp.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as lk','ac.department','=','lk.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as lkct','ac.course_type','=','lkct.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as lkcn','ac.course_name','=','lkcn.LOOKUP_DATA_ID')
//            ->leftJoin('set_activity_setup as act','ac.event_type','=','act.activity_id')
//            ->leftJoin('set_topic_chd as tpchd', 'ac.topic', '=', 'tpchd.id')
//            ->leftJoin('users as u', 'sact.activity_authorize', '=', 'u.id')
//            ->select('ac.*','lkp.LOOKUP_DATA_NAME as BATCH_NO','lk.LOOKUP_DATA_NAME as DEPT_NAME',
//                'lkct.LOOKUP_DATA_NAME as COURSE_TYPE', 'lkcn.LOOKUP_DATA_NAME as COURSE_NAME', 'tpchd.topic as TOPIC_NAME','act.activity_name','sact.present_absent_status as attendance_status','u.name as activity_authorize','sact.feedback_comments')
//            //->whereBetween('start', [$fromDate, $toDate])
//            ->where('sact.student_id',$student_id)
//            ->where('ac.active_status',1)
//            ->get();
        $data = DB::table('stu_activity_attendance as sact')
            ->leftJoin('sa_lookup_data as lkp','sact.batch_id','=','lkp.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lk','sact.department_id','=','lk.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkct','sact.course_id','=','lkct.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkcn','sact.course_type_id','=','lkcn.LOOKUP_DATA_ID')
            ->leftJoin('set_topic_chd as tpchd', 'sact.topic_name', '=', 'tpchd.id')
            ->leftJoin('set_activity_setup as act','sact.activity','=','act.activity_id')
            ->leftJoin('users as u', 'sact.activity_authorize', '=', 'u.id')
                ->select('sact.*','lkp.LOOKUP_DATA_NAME as BATCH_NO','lk.LOOKUP_DATA_NAME as DEPT_NAME','lkct.LOOKUP_DATA_NAME as COURSE_TYPE', 'lkcn.LOOKUP_DATA_NAME as COURSE_NAME', 'tpchd.topic as TOPIC_NAME','u.name as activity_authorize','act.activity_name','sact.present_absent_status as attendance_status')
            ->where('sact.student_id',$student_id)
            ->where('sact.active_status',1)
            ->orderBy('sact.date','desc')
            ->get();
        return response()->json([
            "success" => true,
            "message" => "Data get successfully.",
            "data" => $data
        ]);

    }

    public function getStudentInfo(Request $request){
        $input = $request->all();
        $student_id = $input['student_id'];

        $success['student_info'] =  DB::table('stu_students_information as stinfo')
           ->select('stinfo.students_name','stinfo.students_image','stinfo.students_signature')
            ->where('stinfo.active_status',1)
            ->where('stinfo.student_id',$student_id)
            ->first();

        $success['student_image'] = DB::selectOne(DB::raw("select CONCAT('uploads/student_information/', students_image) AS students_image from stu_students_information where student_id = $student_id and active_status =1"));
        $success['students_signature'] = DB::selectOne(DB::raw("select CONCAT('uploads/student_information/signature', students_signature) AS students_signature from stu_students_information where student_id = $student_id and active_status =1"));

        return response()->json([
            "success" => true,
            "message" => "Data get successfully.",
            "data" => $success
        ]);
    }

    public function updateStudentInfo(Request $request){
        $input = $request->all();
        $student_id = $input['student_id'];

        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            if(!empty($request->file('file'))){
                $file = $request->file('file');
                $fileWithExt = $file->getClientOriginalName();
                $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);
                // get file extension
                $extension = $file->getClientOriginalExtension();
                // create unique file name
                $image = $filename . '_'.$student_id.'_' . time() . '.' . $extension;
                // move to destination
                $destination = base_path() . '/public/uploads/student_information';
                $file->move($destination, $image);
                $post = StudentInofModel::find($student_id);
                $post->students_image = $image;
                $post->save();
            }
        }

        if(!empty($request->file('signature'))){
            $file = $request->file('signature');
            $fileWithExt = $file->getClientOriginalName();
            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);
            // get file extension
            $extension = $file->getClientOriginalExtension();
            // create unique file name
            $signature = $filename . '_'.$student_id.'_' . time() . '.' . $extension;
            // move to destination
            $destination = base_path() . '/public/uploads/student_information/signature';
            $file->move($destination, $signature);
            $post = StudentInofModel::find($student_id);
            $post->students_signature = $signature;
            $post->save();
        }
//        else{
//            $data = [
//                'students_name' => $request->students_name
//            ];
//
//            $studentInfo = StudentInofModel::find($student_id);
//            $studentInfo->update($data);
//            return response()->json([
//                "success" => true,
//                "message" => "Data updated successfully.",
//                "data" => $studentInfo
//            ]);
//        }


       $studentInfo =  DB::table('stu_students_information')->where('student_id', '=', $student_id)->update([
            'students_name' =>$request->students_name
        ]);

        $success['studentInfo'] = StudentInofModel::find($student_id);
        $success['student_image'] = DB::selectOne(DB::raw("select CONCAT('uploads/student_information/', students_image) AS students_image from stu_students_information where student_id = $student_id and active_status =1"));
        $success['students_signature'] = DB::selectOne(DB::raw("select CONCAT('uploads/student_information/signature/', students_signature) AS students_signature from stu_students_information where student_id = $student_id and active_status =1"));
        //$studentInfo->update($data);
        return response()->json([
            "success" => true,
            "message" => "Data updated successfully.",
            "data" => $success
        ]);


    }
    public function activityAttendanceInfo(Request $request){
        $input = $request->all();
        $student_id = $input['student_id'];
        $studentInfo = DB::table('stu_students_information')->select('department','course_type','course_name')->where('student_id',$student_id)->first();

        $data['topic']=DB::table('set_topic_chd')
            ->select('id','topic')
            ->where('set_topic_chd.department_id',$studentInfo->department)
            ->where('set_topic_chd.course_type',$studentInfo->course_type)
            ->where('set_topic_chd.course_name', $studentInfo->course_name)
            ->get();



        $data['activity_info'] = [];
        $mxPlace = DB::select(DB::raw("SELECT place_department, parent_course_type, place_course
            FROM tea_block_placement_chd WHERE student_id=$student_id ORDER BY id DESC LIMIT 0,1"));

        if(!empty($mxPlace[0]) && !empty($mxPlace[0]->place_department) && !empty($mxPlace[0]->place_course)){
            $data['activity_info'] = DB::table('set_assign_activity')
                ->leftJoin('set_activity_setup','set_assign_activity.activity_id' , '=', 'set_activity_setup.activity_id')
                ->where('set_assign_activity.department', $mxPlace[0]->place_department)
                ->where('set_assign_activity.course_name', $mxPlace[0]->place_course)
                ->select('set_activity_setup.activity_id','set_activity_setup.activity_name')
                ->get();
        }


        $data['teacher_list'] = DB::table('users')
            ->where('department_id', '=',$studentInfo->department)
            ->where('course_type', '=',$studentInfo->course_type)
            ->where('course_name', '=', $studentInfo->course_name)
            ->where('USERGRP_ID', 1)
            ->where('active_status', '=',1)
            ->select('id','name')
            ->orderBy('name','ASC')
            ->get();

        return response()->json([
            "success" => true,
            "message" => "Data get successfully.",
            "data" => $data
        ]);
    }

    public function createActivityAttendance(Request $request){
        $input = $request->all();
        $student_id = $input['student_id'];
        $activity = $input['activity'];
        $topic_name = $input['topic_name'];
        $activity_authorize = $input['activity_authorize'];
        $attendance_status = 0;
        $date = date('Y-m-d',strtotime($input['date']));
        $submission_time = $input['submission_time'];
        $submission_end_time = $input['submission_end_time'];
        $created_by = $input['created_by'];

        $mxPlace = DB::select(DB::raw("SELECT id, place_department, parent_course_type, place_course
            FROM tea_block_placement_chd WHERE student_id=$student_id ORDER BY id DESC LIMIT 0,1"));

        $block_place_chd_id = null;
        $place_department = null;
        $parent_course_type = null;
        $place_course = null;

        $studentInfo = DB::table('stu_students_information')->select('department','course_type','course_name','batch_no')->where('student_id',$student_id)->first();
//        DB::table('stu_activity_attendance')->insert([
//            'student_id' =>$student_id,
//            'activity' =>$activity,
//            'topic_name' =>$topic_name,
//            'department_id' =>$studentInfo->department,
//            'course_id' =>$studentInfo->course_type,
//            'course_type_id' =>$studentInfo->course_name,
//            'course_name_id' =>$studentInfo->course_name,
//            'batch_id' =>$studentInfo->batch_no,
//            'activity_authorize' =>$activity_authorize,
//            'present_absent_status' =>$attendance_status,
//            'date' =>$date,
//            'duration_start_time' =>$submission_time,
//            'duration_end_time' =>$submission_end_time,
//            'active_status' =>1,
//            'created_by' =>$created_by
//        ]);

        if($mxPlace){
            $block_place_chd_id = $mxPlace[0]->id;
            $place_department = $mxPlace[0]->place_department;
            $parent_course_type = $mxPlace[0]->parent_course_type;
            $place_course = $mxPlace[0]->place_course;

            DB::table('stu_activity_attendance')->insert([
                'student_id' =>$student_id,
                'activity' =>$activity,
                'topic_name' =>$topic_name,
                'department_id' =>$studentInfo->department,
                'course_id' =>$studentInfo->course_type,
                'course_type_id' =>$studentInfo->course_name,
                'course_name_id' =>$studentInfo->course_name,
                'batch_id' =>$studentInfo->batch_no,
                'activity_authorize' =>$activity_authorize,
                'present_absent_status' =>$attendance_status,
                'date' =>$date,
                'duration_start_time' =>$submission_time,
                'duration_end_time' =>$submission_end_time,
                'block_place_chd_id' =>$block_place_chd_id,
                'place_department' =>$place_department,
                'place_course' =>$place_course,
                'course_type' =>$parent_course_type,
                'active_status' =>1,
                'created_by' =>$created_by
            ]);
        }

        return response()->json([
            "success" => true,
            "message" => "Data Create successfully."
        ]);

    }
}