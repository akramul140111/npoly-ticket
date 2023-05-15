<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\academic_officer\StudentRegisModel;
use App\Models\academic_officer\SessionModel;
use App\Models\academic_officer\BatchModel;
use App\Models\academic_officer\CourseTypeModel;
use App\Models\academic_officer\DepartmentModel;
use App\Models\academic_officer\CourseModel;
use App\Models\academic_officer\GenderModel;
use App\Models\academic_officer\StudentAcademicModel;
use App\Models\academic_officer\StudentTrainingModel;
use App\Models\academic_officer\StudentPublicationModel;
use App\Models\academic_officer\StudentSkillModel;
use App\Models\StudentInofModel;
use DB;
use Auth;


class StudentInfoController extends Controller
{

    /**
     * This method use for show admission students list
     * @param None
     *
     */
    public function index()
    {
        $header = array(
            'pageTitle'  => 'Student Information',
            'tableTitle' => 'Student Information'
        );

        $clients = DB::table('npoly_clients')
            ->select('*')
            ->where('active_status',1)
            ->orderBy('client_id','desc')
            ->get();



        $requestType = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 35)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();

        $priority = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 36)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();

        $requestMode = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 37)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();

        $problemList = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 39)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();

        $issueType = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 40)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();
        $supportModule = DB::table('npoly_support_modules')
            ->select('module_id','module_name')
            ->where('active_status',1)
            ->get();

        $businessImpact = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 41)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();

        $employees = DB::table('npoly_employees')->select('employee_id','employee_name')->get();

        return view('student_portal.student_info.index', compact('header','requestType','priority','requestMode','problemList','issueType','supportModule','employees','businessImpact'));
    }

    public function index2()
    {
        $header = array(
            'pageTitle'  => 'Student Information',
            'tableTitle' => 'Student Information'
        );

//        $sessions = DB::table('sa_lookup_data as s')
//            ->where('s.LOOKUP_GRP_ID', 60)
//            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
//            ->get();
//
//        $batches = DB::table('sa_lookup_data as s')
//            ->where('s.LOOKUP_GRP_ID', 59)
//            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
//            ->get();
//        $courseTypes = DB::table('sa_lookup_data as s')
//            ->where('s.LOOKUP_GRP_ID', 57)
//            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
//            ->get();
//
//        $departments = DB::table('sa_lookup_data as s')
//            ->where('s.LOOKUP_GRP_ID', 8)
//            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
//            ->get();
//
//        $courseNames = DB::table('sa_lookup_data as s')
//            ->where('s.LOOKUP_GRP_ID', 58)
//            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
//            ->get();
//
//        $genders = DB::table('sa_lookup_data as s')
//            ->where('s.LOOKUP_GRP_ID', 2)
//            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
//            ->get();
//
//
//        $results = DB::table('stu_students_information as dt1')
//            ->leftJoin('sa_lookup_data as dt2', 'dt1.gender', '=', 'dt2.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as dt3', 'dt1.department', '=', 'dt3.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as dt4', 'dt1.course_type', '=', 'dt4.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as dt5', 'dt1.course_name', '=', 'dt5.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as dt6', 'dt1.session_years', '=', 'dt6.LOOKUP_DATA_ID')
//            ->leftJoin('sa_lookup_data as dt7', 'dt1.batch_no', '=', 'dt7.LOOKUP_DATA_ID')
//            ->Where('dt1.active_status', '=',1)
//            ->select('dt1.student_id','dt1.students_name','dt1.stu_id','dt1.student_approved_status','dt1.session_years','dt2.LOOKUP_DATA_NAME AS GENDER','dt3.LOOKUP_DATA_NAME AS DEPARTMENT','dt4.LOOKUP_DATA_NAME AS COURSE_TYPE','dt5.LOOKUP_DATA_NAME AS COURSE_NAME','dt6.LOOKUP_DATA_NAME AS SESSION_YEAR','dt7.LOOKUP_DATA_NAME AS BATCH')
//            ->get();

        //$publicationInof = DB::table('stu_students_publication_information as pb')->select('pb.publication_name','pb.training_start_date as pub_start_date','pb.training_end_date as pub_end_date','pb.attachment as pub_attach')->where('student_id',Auth::user()->student_id)->where('active_status',1)->get();

        $studentID = Auth::user()->student_id;
        $studentInfo = DB::table('users as u')
            ->leftjoin('stu_students_information as st', 'u.student_id', '=', 'st.student_id')
            ->leftjoin('stu_students_academic_information as ac', 'ac.student_id', '=', 'st.student_id')
            ->leftjoin('stu_students_publication_information as pb', 'pb.student_id', '=', 'st.student_id')
            ->leftjoin('stu_students_skill_information as skl', 'skl.student_id', '=', 'st.student_id')
            ->leftjoin('stu_students_training_experiance as exp', 'exp.student_id', '=', 'st.student_id')
            ->select('st.*','ac.label_of_education','ac.degree','ac.institute_board','ac.passing_year','ac.result',
                'pb.publication_name','pb.training_start_date as pub_start_date','pb.training_end_date as pub_end_date','pb.attachment as pub_attach','skl.skill_name',
                'exp.trining_name','exp.institute_board as exp_institute_board','exp.training_start_date','exp.training_end_date','exp.passing_year as exp_passing_year',
                'exp.result as exp_result')
            ->where('u.student_id', '=', $studentID)
            ->first();
        $academicInof = DB::table('stu_students_academic_information as ac')->select('ac.label_of_education','ac.degree','ac.institute_board','ac.passing_year','ac.result')->where('student_id',$studentID)->where('active_status',1)->get();
        $trainingInof = DB::table('stu_students_training_experiance as texp')->select('texp.trining_name','texp.institute_board as exp_institute_board','texp.training_start_date','texp.training_end_date','texp.passing_year as exp_passing_year',
            'texp.result as exp_result')->where('student_id',$studentID)->where('active_status',1)->get();
        $publicationInof = DB::table('stu_students_publication_information as pb')->select('pb.publication_name','pb.training_start_date as pub_start_date','pb.training_end_date as pub_end_date','pb.attachment as pub_attach')->where('student_id',$studentID)->where('active_status',1)->get();
        $skillInof = DB::table('stu_students_skill_information as skl')->select('skl.skill_name')->where('student_id',$studentID)->where('active_status',1)->get();




        //dd($publicationInof);
        $sessions = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 6)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();

        $batches = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 7)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();
        $courseTypes = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 4)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();

        $departments = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 3)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();

        $courseNames = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 5)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();

        $genders = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 2)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();

        $bloodgroup = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 10)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();
        $religion = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 1)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();
        $leverOfEducation = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 20)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();
        $maritalStatus = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 11)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();
        $occupation = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 13)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();
        $relation = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 21)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();
        $degree = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 19)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();
        $nationality = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 12)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG',1)
            ->get();



        $results = DB::table('stu_students_information as dt1')
            ->leftJoin('sa_lookup_data as dt2', 'dt1.gender', '=', 'dt2.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt3', 'dt1.department', '=', 'dt3.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt4', 'dt1.course_type', '=', 'dt4.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt5', 'dt1.course_name', '=', 'dt5.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt6', 'dt1.session_years', '=', 'dt6.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt7', 'dt1.batch_no', '=', 'dt7.LOOKUP_DATA_ID')
            ->Where('dt1.active_status', '=',1)
            ->select('dt1.student_id','dt1.students_name','dt1.stu_id','dt1.student_approved_status','dt1.session_years','dt2.LOOKUP_DATA_NAME AS GENDER','dt3.LOOKUP_DATA_NAME AS DEPARTMENT','dt4.LOOKUP_DATA_NAME AS COURSE_TYPE','dt5.LOOKUP_DATA_NAME AS COURSE_NAME','dt6.LOOKUP_DATA_NAME AS SESSION_YEAR','dt7.LOOKUP_DATA_NAME AS BATCH')
            ->get();

        //return view('student_portal.student_info.index2', compact('header','results','sessions','batches','courseTypes','departments','courseNames','genders','publicationInof'));
        return view('student_portal.student_info.index2', compact('header','results','studentID','studentInfo','sessions','batches','courseTypes','departments','courseNames','genders',
            'bloodgroup','religion','leverOfEducation','maritalStatus','occupation','relation','degree','nationality','academicInof','trainingInof','publicationInof','skillInof'));
    }


    /**
     * This method use for create admission information form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle'  => 'Admission Management',
            'tableTitle' => 'Admission Management List'

        );

        $sessions = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 60)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();

        $batches = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 59)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();
        $courseTypes = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 57)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();

        $departments = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 8)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();

        $courseNames = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 58)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();

        $genders = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 2)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();

        return view('academic_officer.create', compact('header', 'sessions', 'batches', 'courseTypes', 'departments', 'courseNames', 'genders'));
    }
    /*save admission information
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        StudentRegisModel::createStudentRegistration($request);
        Session::flash('success', 'Data Saved successfully!');
        return response()->json(['success' => 'saved']);

    }

    public function storeStudentInfo(Request $request)
    {
        dd($_POST);exit();
        StudentInofModel::updateStudentInfo($request);
        Session::flash('success', 'Data Saved successfully!');
        //return response()->json(['success' => 'saved']);
        return redirect()->route('studentInfo');

    }
    /**
     * This method use for edit admission information
     * @param Request $request
     *
     */
    public function edit(Request $request, $id)
    {

    }

    /**
     * This method use for view admission information
     * @param Request $request
     *
     */
    public function view($id)
    {

    }

    /**
     * This method use for delete admission information
     * @param Request $request
     *
     */
    public function delete($id)
    {

    }

    /**
     * This method use for review  admission information
     * @param $id
     *
     */
    public function admissionReviewByAcademicOfficer($id)
    {

        if($id){
            $academy     = StudentAcademicModel::where('student_id', $id)->get();
            $training    = StudentTrainingModel::where('student_id', $id)->get();
            $publication = StudentPublicationModel::where('student_id', $id)->get();
            $skill       = StudentSkillModel::where('student_id', $id)->get();
            $student     = DB::table('stu_students_information as dt1')
                ->leftJoin('sa_lookup_data as dt2', 'dt1.gender', '=', 'dt2.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt3', 'dt1.department', '=', 'dt3.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt4', 'dt1.course_type', '=', 'dt4.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt5', 'dt1.course_name', '=', 'dt5.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt6', 'dt1.session_years', '=', 'dt6.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt7', 'dt1.batch_no', '=', 'dt7.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt8', 'dt1.blood_group', '=', 'dt8.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt9', 'dt1.religion', '=', 'dt9.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt10', 'dt1.marial_status', '=', 'dt10.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as dt11', 'dt1.nationality', '=', 'dt11.LOOKUP_DATA_ID')
                ->orWhere('dt1.active_status', '=',1)
                ->select('dt1.*','dt2.LOOKUP_DATA_NAME AS GENDER_NAME','dt3.LOOKUP_DATA_NAME AS DEPARTMENT','dt4.LOOKUP_DATA_NAME AS COURSE_TYPE','dt5.LOOKUP_DATA_NAME AS COURSE_NAME','dt5.LOOKUP_DATA_NAME AS SESSION_YEAR','dt7.LOOKUP_DATA_NAME AS BATCH','dt8.LOOKUP_DATA_NAME AS BLOOD_GROUP','dt9.LOOKUP_DATA_NAME AS RELIGION','dt10.LOOKUP_DATA_NAME AS MARIAL_STATUS','dt11.LOOKUP_DATA_NAME AS NATIONALITY')
                ->where('dt1.student_id', $id)
                ->first();
        }
        $students = StudentRegisModel::find($id);
        return view('academic_officer.admissionReviewByAcademicOfficer', compact('students','student', 'academy', 'training', 'publication', 'skill'));

    }

    /**
     * This method use for approving  admission information
     * @param $id
     *
     */
    public function admissionApprovedByAcademicOfficer($id=NULL, $status=NULL)
    {

        if($id){
            $student = StudentRegisModel::where('student_id', $id)->first();
            $student->student_approved_status = 1;

            if($student->save()){
                Session::flash('success', 'Data Approved Successful');
            }else{
                Session::flash('error', 'Data Not Saved, Please Try Again!');
            }
            return redirect()->route('admissionManagement');
        }

    }

    /**
     * This method use for check duplicate student id
     * @param $request
     *
     */
    public function checkDuplicateStuId(Request $request)
    {
        $id = $request->input('id');
        if($id){
            if(StudentRegisModel::select('stu_id')->where('stu_id', $id)->first()){
                return 2; // duplicate
            }else{
                return 1; //ok
            }
        }

    }

    public function getAssignedBlock($student_id=null)
    {

        $header = array(
            'pageTitle' => 'Block Placement',
            'tableTitle' => 'Block Placement Record'

        );

        $department = '';
        $infoStudent = DB::table('stu_students_information as dt1')
        ->leftJoin('sa_lookup_data as dt4', 'dt1.course_type', '=', 'dt4.LOOKUP_DATA_ID')
        ->leftJoin('sa_lookup_data as dt5', 'dt1.course_name', '=', 'dt5.LOOKUP_DATA_ID')
        ->leftJoin('sa_lookup_data as dt6', 'dt1.session_years', '=', 'dt6.LOOKUP_DATA_ID')
        ->leftJoin('sa_lookup_data as dt7', 'dt1.batch_no', '=', 'dt7.LOOKUP_DATA_ID')
        ->select('dt1.stu_id AS email', 'dt1.students_name','dt1.department AS DEPT','dt1.batch_no AS BATCH_NO','dt4.LOOKUP_DATA_NAME AS COURSE_TYPE',
        'dt5.LOOKUP_DATA_NAME AS COURSE_NAME','dt6.LOOKUP_DATA_NAME AS SESSION','dt7.LOOKUP_DATA_NAME AS BATCH')
        ->where('dt1.student_id', $student_id)
        ->first();

        if($infoStudent){
            $department = $infoStudent->DEPT;
            $batch = $infoStudent->BATCH_NO;
        }

            $blocks = DB::table('aca_create_block as dt1')
            ->leftJoin('sa_lookup_data as dt2', 'dt1.block_name', '=', 'dt2.LOOKUP_DATA_ID')
            //->leftJoin('aca_create_sub_block','dt1.block_id','=','aca_create_sub_block.block_id')
            ->Where('dt1.active_status', '=',1)
            //->Where('dt1.course_name', '=', Auth::user()->course_name)
            //->Where('dt1.department', '=',Auth::user()->department_id)
          //  ->Where('dt1.phase', '=',Auth::user()->phase)
            //->Where('dt1.block_id', '=',$id)
            ->select('dt1.*','dt2.LOOKUP_DATA_NAME AS BLOCK_NAME')
            ->orderBy('dt1.block_id','ASC')
            ->get();

        return view('student_portal.student_info.assigned_block', compact('header', 'blocks', 'student_id', 'department','batch', 'infoStudent'));



    }

}
