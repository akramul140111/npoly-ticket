<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\StuLeaveModel;
use DB;
use Auth;
use DatePeriod;
use DateTime;
use DateInterval;

class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle'  => 'Student Leave Setup',
            'tableTitle' => 'Student Leave List'
        );
        $results = DB::table('stu_leave as lv')
                    ->leftJoin('sa_lookup_data as lk','lv.leave_type','=','lk.LOOKUP_DATA_ID')
                    ->select('lv.*','lk.LOOKUP_DATA_NAME as leave_type_name')
                    ->where('lv.student_id',Auth::user()->student_id)
                    ->get();

        return view('student_portal.leave_info.index', compact('header','results'));
    }

    /**
     * This method use for create  form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle'  => 'Student Leave Setup',
            'tableTitle' => 'Student Leave List'
        );

        $studentId = Auth::user()->student_id;
        $totalLeave = DB::table('set_leave as tlv')
            ->leftJoin('sa_lookup_data as lkp', 'tlv.leave_type_id', '=', 'lkp.LOOKUP_DATA_ID')
            ->select('tlv.number_of_days','tlv.leave_type_id','lkp.LOOKUP_DATA_NAME as leave_type')->get();
        $leaveTypes = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 18)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();



        return view('student_portal.leave_info.create', compact('header','totalLeave','leaveTypes','studentId'));
    }

    /* save information
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        StuLeaveModel::createStudentLeave($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('student-leave');
    }

    /*  view
     * @param $id
     *
     */
    public function show($id)
    {
        $header = array(
            'pageTitle'  => 'Activity/Event Setup',
            'tableTitle' => 'Activity/Event List'
        );

        $activityEventInfo = ActivityEventModel::find($id);

        return view('admin_portal.activity_event_setup.view', compact('header', 'activityEventInfo'));
    }

    /*  update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle'  => 'Student Leave Setup',
            'tableTitle' => 'Student Leave List'
        );
        $studentId = Auth::user()->student_id;
        $totalLeave = DB::table('set_leave as tlv')
            ->leftJoin('sa_lookup_data as lkp', 'tlv.leave_type_id', '=', 'lkp.LOOKUP_DATA_ID')
            ->select('tlv.number_of_days','tlv.leave_type_id','lkp.LOOKUP_DATA_NAME as leave_type')->get();
        $leaveTypes = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 18)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();

        $leaveInfo = StuLeaveModel::find($id);
        return view('student_portal.leave_info.update', compact('header', 'leaveInfo','studentId','totalLeave','leaveTypes'));
    }

    /*update action
     * @param $request
     *
     */
    public function update(Request $request)
    {

        StuLeaveModel::updateLeave($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('student-leave');
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
    public function checkStuLeaveInfo(Request $request){
        $leave_form_date = date('Y-m-d',strtotime($request->Input('lvformDate')));
        $leave_to_date = date('Y-m-d',strtotime($request->Input('lvtoDate')));


        $stuId = Auth::user()->student_id;

        $leaveInfo = DB::table('stu_leave_chd')->select('*')->whereBetween('leave_date', [$leave_form_date, $leave_to_date])
            ->where('student_id',$stuId)
            ->get();


        $countLeave = count($leaveInfo);
       if($countLeave>0){
           $leaveID =  DB::table('stu_leave')->select('*')->where('student_id',$stuId)->max('leave_id');
           $lastLeaveInfo = DB::table('stu_leave')->select('leave_from_date','leave_to_date')->where('leave_id',$leaveID)->first();

           return $lastLeaveInfo;
       }

    }
}
