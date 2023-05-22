<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\OrganizationInfo;
use DB;
use Session;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('prevent-back-history');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTicketStatusInfo($status)
    {
        $header = array(
            'pageTitle' => 'Ticket',
            'tableTitle' => ''
        );

        if($status==1){
            $results = DB::table('npoly_tickets as tkt')
                ->leftJoin('sa_lookup_data as lkp', 'tkt.priority_id', '=', 'lkp.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkp1', 'tkt.ticket_status', '=', 'lkp1.LOOKUP_DATA_ID')
                ->leftJoin('npoly_clients as clnt', 'clnt.client_id', '=', 'tkt.client_id')
                ->leftJoin('npoly_projects as pro', 'pro.project_id', '=', 'tkt.project_id')
                ->leftJoin('npoly_task_report as tskr', 'tskr.ticket_id', '=', 'tkt.id')
                ->leftJoin('npoly_support_modules as tm', 'tm.module_id', '=', 'tkt.module_id')
                ->select('tkt.*','lkp.LOOKUP_DATA_NAME as priorityName','clnt.client_name','pro.project_name','tskr.employee_id','tskr.task_complete','lkp1.LOOKUP_DATA_NAME as ticketStatus','tm.module_name')
                ->where('reassign_fg',1)
                ->orderBy('tkt.id','desc')
                ->get();
        }else{
            $results = DB::table('npoly_tickets as tkt')
                ->leftJoin('sa_lookup_data as lkp', 'tkt.priority_id', '=', 'lkp.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkp1', 'tkt.ticket_status', '=', 'lkp1.LOOKUP_DATA_ID')
                ->leftJoin('npoly_clients as clnt', 'clnt.client_id', '=', 'tkt.client_id')
                ->leftJoin('npoly_projects as pro', 'pro.project_id', '=', 'tkt.project_id')
                ->leftJoin('npoly_task_report as tskr', 'tskr.ticket_id', '=', 'tkt.id')
                ->leftJoin('npoly_support_modules as tm', 'tm.module_id', '=', 'tkt.module_id')
                ->select('tkt.*','lkp.LOOKUP_DATA_NAME as priorityName','clnt.client_name','pro.project_name','tskr.employee_id','tskr.task_complete','lkp1.LOOKUP_DATA_NAME as ticketStatus','tm.module_name')
                ->where('ticket_status',$status)
                ->orderBy('tkt.id','desc')
                ->get();
        }

        return view('dashboard.ticket_dashboard',compact('header','results'));
    }

    public function totalPresentEmployee(Request $request){
        $header = array(
            'pageTitle' => 'Present',
            'tableTitle' => ''
        );
        $results = DB::table('hr_attendance as atn')
                            ->leftJoin('npoly_employees as emp','emp.employee_id','=','atn.employee_id')
                            ->leftJoin('sa_lookup_data as lkp','lkp.lookup_data_id','=','emp.department_id')
                            ->leftJoin('sa_lookup_data as lkp1','lkp1.lookup_data_id','=','emp.designation_id')
                            ->select('emp.employee_name','lkp.lookup_data_name as department_name','lkp1.lookup_data_name as designation_name','emp.email','emp.card_no','atn.attendance_date','atn.login_time','emp.mobile_no')
                            ->where('atn.present_status',1)
                            ->where('atn.attendance_date',date('Y-m-d'))
                            ->orderBy('emp.user_serial_no')
                            ->get();

        return view('dashboard.total_present',compact('header','results'));
    }

    public function totalAbsentEmployee(Request $request){
        $header = array(
            'pageTitle' => 'Absent',
            'tableTitle' => ''
        );
        $results = DB::table('hr_attendance as atn')
            ->leftJoin('npoly_employees as emp','emp.employee_id','=','atn.employee_id')
            ->leftJoin('sa_lookup_data as lkp','lkp.lookup_data_id','=','emp.department_id')
            ->leftJoin('sa_lookup_data as lkp1','lkp1.lookup_data_id','=','emp.designation_id')
            ->select('emp.employee_name','lkp.lookup_data_name as department_name','lkp1.lookup_data_name as designation_name','emp.email','emp.card_no','atn.attendance_date','atn.login_time','emp.mobile_no')
            ->where('atn.present_status',0)
            ->where('atn.attendance_date',date('Y-m-d'))
            ->orderBy('emp.user_serial_no')
            ->get();
        return view('dashboard.total_absent',compact('header','results'));
    }

    public function totalWorkingHour(Request $request){
        $header = array(
            'pageTitle' => 'Task',
            'tableTitle' => ''
        );
        $date = date('Y-m-d');
        $taskInfo = DB::select("select distinct employee_id from npoly_task_report where task_create_date = '$date'");
        $empIds = [];
        foreach ($taskInfo as $emp){
            $empIds [] =  $emp->employee_id;
        }
        $empIdIn = implode(',',$empIds);

        if(!empty($empIdIn)){
            $results = DB::select("select emp.employee_id,emp.employee_name,emp.card_no,emp.mobile_no,lkp.lookup_data_name as department_name,lkp1.LOOKUP_DATA_NAME as designation_name from npoly_employees as emp,sa_lookup_data as lkp, sa_lookup_data as lkp1
                                        WHERE emp.department_id = lkp.lookup_data_id
                                        and emp.designation_id = lkp1.lookup_data_id
                                        and emp.employee_id in($empIdIn)");

            return view('dashboard.total_working_horus',compact('results','header'));

        }else{
            $results = [];
            return view('dashboard.total_working_horus',compact('results','header'));
        }
    }

    public function taskDetailsSpecificEmp(Request $request,$empId){
        $header = array(
            'pageTitle' => 'Task',
            'tableTitle' => ''
        );

        $results = DB::table('npoly_task_report as tr')
            ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
            ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
            ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
            ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
            ->where('tr.active_status',1)
            ->where('tr.employee_id',$empId)
            ->where('tr.task_create_date',date('Y-m-d'))
            ->orderBy('tr.task_id','desc')
            ->get();

         return view('dashboard.specficEmpTaskDetails',compact('results','header'));

    }

    public function getLastSevenDaysTask(Request  $request){
        $header = array(
            'pageTitle' => 'Task',
            'tableTitle' => ''
        );

        $today = date('Y-m-d');
        $lastSevendDays = date('Y-m-d', strtotime('-7 days'));

        $results = DB::table('npoly_task_report as tr')
            ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
            ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
            ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
            ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
            ->where('tr.active_status',1)
            ->whereBetween('tr.task_create_date', [ $lastSevendDays,$today])
            ->orderBy('tr.task_id','desc')
            ->get();

        $results = DB::select("SELECT DISTINCT tr.employee_id,emp.employee_name,emp.card_no,emp.mobile_no,lkp.LOOKUP_DATA_NAME as department_name,lkp1.LOOKUP_DATA_NAME as designation_name FROM npoly_task_report as tr, npoly_employees as emp,sa_lookup_data as lkp,sa_lookup_data as lkp1
                                WHERE tr.employee_id = emp.employee_id
                                AND tr.department_id = lkp.LOOKUP_DATA_ID
                                AND emp.designation_id = lkp1.LOOKUP_DATA_ID
                                AND tr.task_create_date BETWEEN '$lastSevendDays' AND '$today'
                                and tr.active_status = 1
                                ORDER BY tr.task_id DESC");


        return view('dashboard.totalWrkLst7Days',compact('results','header','today','lastSevendDays'));

    }

    public function taskDetailsLast7Days(Request $request, $empId){
        $header = array(
            'pageTitle' => 'Task',
            'tableTitle' => ''
        );

        $today = date('Y-m-d');
        $lastSevendDays = date('Y-m-d', strtotime('-7 days'));

        $results = DB::table('npoly_task_report as tr')
            ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
            ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
            ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
            ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
            ->where('tr.active_status',1)
            ->where('tr.employee_id',$empId)
            ->whereBetween('task_create_date', [ $lastSevendDays,$today])
            ->orderBy('tr.task_id','desc')
            ->get();

        return view('dashboard.last7DaysTaskDetails',compact('results','header','today','lastSevendDays'));
    }

}
