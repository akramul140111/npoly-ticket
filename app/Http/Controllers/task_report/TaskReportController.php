<?php

namespace App\Http\Controllers\task_report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\TaskReportModel;
use  App\Models\lookup\LookupGroupDataModel;
use DB;
use Auth;
use Mail;
use Symfony\Component\Console\Input\Input;

class TaskReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Task Assign',
            'tableTitle' => ''
        );

        if(Auth::user()->is_admin ==1){
            $results = DB::table('npoly_task_report as tr')
                ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
                ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
                ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
                ->where('tr.active_status',1)
                ->orderBy('tr.task_id','desc')
                ->get();
        }else{

            $results = DB::table('npoly_task_report as tr')
                ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
                ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
                ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
                ->where('tr.active_status',1)
                ->where('tr.department_id',Auth::user()->department_id)
                ->orderBy('tr.task_id','desc')
                ->get();
        }

        return view('task_assign.index',compact('header','results'));
    }
    public function taskReportIndex()
    {
        $header = array(
            'pageTitle' => 'Task Report',
            'tableTitle' => ''
        );

        if(Auth::user()->is_admin ==1){
            $results = DB::table('npoly_task_report as tr')
                ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
                ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
                ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
                ->where('tr.active_status',1)
                ->orderBy('tr.task_id','desc')
                ->get();
        }else{
            $results = DB::table('npoly_task_report as tr')
                ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
                ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
                ->leftJoin('sa_lookup_data as lkp1','lkp1.LOOKUP_DATA_ID','=','tr.task_priority_id')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
                ->leftJoin('npoly_employees as emp1','emp1.employee_id','=','tr.assign_by')
                ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name','emp1.employee_name as assign_by_name','lkp1.LOOKUP_DATA_NAME as priority_name')
                ->where('tr.active_status',1)
                ->where('tr.employee_id',Auth::user()->employee_id)
                ->where('tr.department_id',Auth::user()->department_id)
                //->where('tr.task_complete','!=',100)
                ->where('tr.task_create_date',date('Y-m-d'))
                ->orWhere('tr.task_complete', '<',100)
                ->orderBy('tr.task_id','desc')
                ->get();
        }

        return view('task_report.index',compact('header','results'));
    }
    public function taskReportMailIndex()
    {
        $header = array(
            'pageTitle' => 'Task Report Mail',
            'tableTitle' => ''
        );

        if(Auth::user()->is_admin ==1){
            $results = DB::table('npoly_task_mail as tskm')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tskm.employee_id')
                ->leftJoin('npoly_employees as emp1','emp1.employee_id','=','tskm.report_to')
                ->select('tskm.task_mail_id','tskm.employee_id','tskm.report_to','emp1.employee_name as report_to','tskm.cc_to','tskm.bcc_to','emp.employee_name')
                ->where('tskm.active_status',1)
                ->get();
        }else{
            $emp_id = Auth::user()->employee_id;
            $results = DB::table('npoly_task_mail as tskm')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tskm.employee_id')
                ->leftJoin('npoly_employees as emp1','emp1.employee_id','=','tskm.report_to')
                ->select('tskm.task_mail_id','tskm.employee_id','tskm.report_to','emp1.employee_name as report_to','tskm.cc_to','tskm.bcc_to','emp.employee_name')
                ->where('tskm.active_status',1)
                ->where('tskm.employee_id',$emp_id)
                ->get();
        }

        return view('task_report_mail.index',compact('header','results'));
    }

    public function createTaskMail()
    {
        $header = array(
            'pageTitle' => 'Task Report Mail',
            'tableTitle' => ''
        );

        if(Auth::user()->is_admin=='1'){
            $employee = DB::table('npoly_employees')
                ->select('employee_id','employee_name')
                ->where('active_status',1)
                //->where('employee_id',)
                ->get();
        }else{
            $empId = Auth::user()->employee_id;
            $employee = DB::table('npoly_employees as emp')
                ->leftJoin('sa_lookup_data as lkp','emp.department_id','=','lkp.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkp1','emp.designation_id','=','lkp1.LOOKUP_DATA_ID')
                ->select('emp.employee_id','emp.employee_name','lkp.LOOKUP_DATA_NAME as department_name','lkp1.LOOKUP_DATA_NAME as designation_name')
                ->where('emp.active_status',1)
                ->where('emp.employee_id',$empId)
                ->get();
        }


        $employees = DB::table('npoly_employees')
            ->select('employee_id','employee_name')
            ->where('active_status',1)
            ->get();

        return view('task_report_mail.create', compact('header','employee','employees'));
    }

    public function storeTaskReportMail(Request $request)
    {
        TaskReportModel::createTaskMail($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('taskReportMailIndex');
    }
    public function editTaskMail($id)
    {
        $header = array(
            'pageTitle' => 'Task Report Mail',
            'tableTitle' => ''
        );

        if(Auth::user()->is_admin=='1'){
            $employee = DB::table('npoly_employees')
                ->select('employee_id','employee_name')
                ->where('active_status',1)
                //->where('employee_id',)
                ->get();
        }else{
            $empId = Auth::user()->employee_id;
            $employee = DB::table('npoly_employees as emp')
                ->leftJoin('sa_lookup_data as lkp','emp.department_id','=','lkp.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkp1','emp.designation_id','=','lkp1.LOOKUP_DATA_ID')
                ->select('emp.employee_id','emp.employee_name','lkp.LOOKUP_DATA_NAME as department_name','lkp1.LOOKUP_DATA_NAME as designation_name')
                ->where('emp.active_status',1)
                ->where('emp.employee_id',$empId)
                ->get();
        }


        $employees = DB::table('npoly_employees')
            ->select('employee_id','employee_name')
            ->where('active_status',1)
            ->get();

        $result = DB::table('npoly_task_mail as tskm')
            ->leftJoin('npoly_employees as emp','emp.employee_id','=','tskm.employee_id')
            ->leftJoin('sa_lookup_data as lkp','emp.department_id','=','lkp.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkp1','emp.designation_id','=','lkp1.LOOKUP_DATA_ID')
            ->select('tskm.*','lkp.LOOKUP_DATA_NAME as department_name','lkp1.LOOKUP_DATA_NAME as designation_name','emp.employee_name')
            ->where('task_mail_id',$id)
            ->first();


        return view('task_report_mail.update', compact('header', 'result','employee','employees'));

    }
    public function updateTaskMail(Request $request)
    {
        TaskReportModel::updateTaskMailInof($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('taskReportMailIndex');
    }

    public function deptWiseTaskReportIndex()
    {
        $header = array(
            'pageTitle' => 'Department Wise Task Report',
            'tableTitle' => ''
        );

        if(Auth::user()->is_admin ==1){
            $results = DB::table('npoly_task_report as tr')
                ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
                ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
                ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
                ->where('tr.active_status',1)
                ->get();
        }else{
            $results = DB::table('npoly_task_report as tr')
                ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
                ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
                ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
                ->where('tr.active_status',1)
                ->where('tr.employee_id',Auth::user()->employee_id)
                ->where('tr.department_id',Auth::user()->department_id)
                ->get();
        }

        if(Auth::user()->is_admin ==1) {
            $department = DB::table('sa_lookup_data')
                ->select('LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME')
                ->where('LOOKUP_GRP_ID', '5')
                ->get();
        }else{
            $deptId = Auth::user()->department_id;
            $department = DB::table('sa_lookup_data')
                ->select('LOOKUP_DATA_ID', 'LOOKUP_DATA_NAME')
                ->where('LOOKUP_GRP_ID', '5')
                ->where('LOOKUP_DATA_ID', $deptId)
                ->get();
        }

        if(Auth::user()->is_admin ==1) {
            $employees = DB::table('npoly_employees')
                ->select('employee_id', 'employee_name')
                ->get();
        }else{
            $deptId = Auth::user()->department_id;
            $employees = DB::table('npoly_employees')
                ->select('employee_id', 'employee_name')
                ->where('department_id', $deptId)
                ->get();
        }



        return view('dept_wise_task_report.index',compact('header','results','department','employees'));
    }

    public function deptWiseTaskReport(Request  $request){
        $formDate = $request->fromDate;
        dd($formDate);
    }

    /**
     * Create class routine form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle' => 'Task Assign',
            'tableTitle' => 'Task Assign List'
        );

        $projects = DB::select(DB::raw("SELECT pro.project_id, CONCAT(clnt.client_abbr,' :: ', pro.project_name) pro_name
                                            FROM npoly_projects as pro, npoly_clients as clnt
                                            WHERE clnt.client_id = pro.client_id"));

        $employee = DB::table('npoly_employees')->select('*')->get();

        $priority = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 36)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();


        return view('task_assign.create', compact('header','projects','employee','priority'));
    }
    public function createTask()
    {
        $header = array(
            'pageTitle' => 'Task Report',
            'tableTitle' => 'Task Report List'
        );

        $projects = DB::select(DB::raw("SELECT pro.project_id, CONCAT(clnt.client_abbr,' :: ', pro.project_name) pro_name
                                            FROM npoly_projects as pro, npoly_clients as clnt
                                            WHERE clnt.client_id = pro.client_id"));

        $employee = DB::table('npoly_employees')->select('*')->get();

        $priority = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 36)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();


        return view('task_report.create', compact('header','projects','employee','priority'));
    }
    public function createTaskMailSend(Request  $request)
    {
        if($_POST){
            $emil_to = $request->mail_to;
            $cc_to = $request->cc_to;
            $bcc_to = $request->bcc_to;
            $emil_to = $request->mail_to;
            $data['empId'] = Auth::user()->employee_id;
            $data['title'] = 'Daily Task Activity';
            $data['employee_id'] = Auth::user()->employee_id;
            $data['results'] = DB::table('npoly_task_report as tr')
                ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
                ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
                ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
                ->where('tr.active_status',1)
                ->where('tr.employee_id',Auth::user()->employee_id)
                ->where('tr.department_id',Auth::user()->department_id)
                ->where('tr.task_create_date',date('Y-m-d'))
                ->orderBy('tr.task_id','desc')
                ->get();

            $employeeMail = DB::select("select email from npoly_employees where employee_id in(1)");
            $array_values= [];
            foreach($employeeMail as $array)
            {
                $array_values[]=$array->email;
            }

            $ccToMail =  array_values($array_values);



            $sent = Mail::send('emails.work_report_email', $data, function ($email) use ($data, $emil_to,$ccToMail) {
                $email->subject($data['title']);
                $email->from('ticket@nationalpolymer.net');
                $email->to('azam.ali@nationalpolymer.net');
                $email->cc($ccToMail);
                $email->bcc('azam.ali@nationalpolymer.net');
            });
//            $data= DB::table('npoly_task_report as tr')
//                ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
//                ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
//                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
//                ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
//                ->where('tr.active_status',1)
//                ->where('tr.employee_id',Auth::user()->employee_id)
//                ->where('tr.department_id',Auth::user()->department_id)
//                ->where('tr.task_create_date',date('Y-m-d'))
//                ->orderBy('tr.task_id','desc')
//                ->get();
//            $details = [
//                'title' => 'Npoly Ticket',
//                'body' => 'This is for testing email using smtp',
//                'results' =>$data
//            ];
//            $ccEmails = ["azamalibd808@gmail.com","azam.ali@nationalpolymer.net"];
//            $bccEmails = ["azam.ali@nationalpolymer.net"];
//
//            \Mail::to('azam.ali@nationalpolymer.net')
//                //\Mail::to('faysalahmedgiant@gmail.com')
//                ->cc($ccEmails)
//                ->bcc($bccEmails)
//                ->send(new \App\Mail\TicketMail($details));
            Session::flash('success', 'Data Saved successfully!');
            return redirect()->route('taskReportIndex');
        }else{
            $header = array(
                'pageTitle' => 'Task Report',
                'tableTitle' => ''
            );

            $empId = Auth::user()->employee_id;
            $mailInfo = DB::table('npoly_task_mail as tskm')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tskm.report_to')
                ->select('tskm.email_to_name','tskm.report_to','tskm.cc_to_name','tskm.bcc_to_name','tskm.cc_to','tskm.bcc_to','emp.employee_name as report_to_name')
                ->where('tskm.employee_id',$empId)
                ->first();

            // Task Info
            $results = DB::table('npoly_task_report as tr')
                ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
                ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
                ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
                //->leftJoin('npoly_employees as emp1','emp.employee_id','=','tr.assign_by')
                ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
                ->where('tr.active_status',1)
                ->where('tr.employee_id',Auth::user()->employee_id)
                ->where('tr.department_id',Auth::user()->department_id)
                ->where('tr.task_create_date',date('Y-m-d'))
                ->orderBy('tr.task_id','desc')
                ->get();

            return view('task_report_mail_send.create', compact('header','mailInfo','results'));
        }

    }

    /* save class routine
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        TaskReportModel::createTaskAssign($request);
        // Mail Send
        $taskMaxId = DB::table('npoly_task_report')->max('task_id');

        $assingEmployeMail = DB::table('npoly_employees')->select('email')->where('employee_id',$request->assign_to)->first();

        $to_mail = $assingEmployeMail->email;


        $data['empId'] = $assingEmployeMail->email;
        $data['title'] = 'Task Assign Info';
        $data['employee_id'] = $request->assign_to;
        $data['results'] = DB::table('npoly_task_report as tr')
            ->leftJoin('npoly_projects as pro','pro.project_id','=','tr.project_id')
            ->leftJoin('sa_lookup_data as lkp','lkp.LOOKUP_DATA_ID','=','tr.department_id')
            ->leftJoin('npoly_employees as emp','emp.employee_id','=','tr.employee_id')
            ->select('tr.*','pro.project_name','lkp.LOOKUP_DATA_NAME as DEPT_NAME','emp.employee_name')
            ->where('tr.active_status',1)
            ->where('tr.task_id',$taskMaxId)
            ->get();


        $ccToMail =  array_values(['azam.ali@nationalpolymer.net']);

        // assign employee info
        $data['empInfo'] = DB::table('npoly_employees as emp')
            ->leftJoin('sa_lookup_data as lkp','emp.department_id','=','lkp.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkp1','emp.designation_id','=','lkp1.LOOKUP_DATA_ID')
            ->select('emp.employee_name','lkp.LOOKUP_DATA_NAME as department_name','lkp1.LOOKUP_DATA_NAME as designation_name')
            ->where('emp.employee_id',$request->assign_to)
            ->first();



        $sent = Mail::send('emails.task_assign_mail', $data, function ($email) use ($data,$ccToMail,$to_mail) {
            $email->subject($data['title']);
            $email->from('ticket@nationalpolymer.net','Task Assign');
            $email->to($to_mail);
            $email->cc($ccToMail);
            //$email->bcc('azam.ali@nationalpolymer.net');
        });

        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('taskAssignIndex');
    }

    public function storeTask(Request $request)
    {
        TaskReportModel::createTask($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('taskReportIndex');
    }

    /* class routine update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle' => 'Project',
            'tableTitle' => 'Project List'
        );
        $projects = DB::select(DB::raw("SELECT pro.project_id, CONCAT(clnt.client_abbr,' :: ', pro.project_name) pro_name
                                            FROM npoly_projects as pro, npoly_clients as clnt
                                            WHERE clnt.client_id = pro.client_id"));

        $employee = DB::table('npoly_employees')->select('*')->get();

        $priority = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 36)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();
        $result = TaskReportModel::find($id);

        return view('task_assign.update', compact('header', 'result','projects','employee','priority'));

    }
    public function editTask($id)
    {
        $header = array(
            'pageTitle' => 'Task Report',
            'tableTitle' => 'Task Report List'
        );

        $projects = DB::select(DB::raw("SELECT pro.project_id, CONCAT(clnt.client_abbr,' :: ', pro.project_name) pro_name
                                            FROM npoly_projects as pro, npoly_clients as clnt
                                            WHERE clnt.client_id = pro.client_id"));

        $employee = DB::table('npoly_employees')->select('*')->get();

        $priority = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 36)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();
        $result = TaskReportModel::find($id);

        return view('task_report.update', compact('header', 'result','projects','employee','priority'));

    }

    /* class routine update action
     * @param $request
     *
     */
    public function update(Request $request)
    {
        TaskReportModel::updateTaskAssign($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('taskAssignIndex');
    }
    public function updateTask(Request $request)
    {
        TaskReportModel::updateTask($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('taskReportIndex');
    }

    /* get day of date
     * @param $date
     *
     */
    public function checkStartStopStatus(Request $request){
        $taskId = $request->taskId;
        $empId = DB::table('npoly_task_report')->select('employee_id')->where('task_id',$taskId)->first();

        if(!empty($empId)){
            $today = date('d-m-Y');
            $taskStatus = DB::table('npoly_task_report')
                                    ->select('task_running')
                                    ->where('employee_id',$empId->employee_id)
                                    ->where('task_running',1)
                                    //->where('created_at',$today)
                                    ->count();
            return $taskStatus;
        }
    }

    public function updateTaskStatus(Request  $request){

        $taskId = $request->taskId;
        $empId = DB::table('npoly_task_report')->select('employee_id','ticket_id')->where('task_id',$taskId)->first();


//        $startedTask = DB::table('npoly_task_report')
//                                ->select('task_id')
//                                ->where('task_running',1)
//                                ->where('employee_id',$empId->employee_id)
//                                ->where('task_id','!=',$taskId)
//                                ->count();

        $startedTask = DB::table('npoly_task_report')
            ->select('task_id')
            ->where('task_running',1)
            ->where('employee_id',$empId->employee_id)
            ->where('task_id','!=',$taskId)
            ->get();

        $count = count($startedTask);

        if($count > 0){
            // stop started task
            $time = date('h:i:s A');
            $endTime = strtotime($time) - strtotime('today');
            foreach ($startedTask as $ptsk){
                $taskData = array(
                    "task_running"       => 0,
                    "end_time"           => $endTime,
                    "updated_by"        => Auth::user()->id,
                    "updated_at"        => date('Y-m-d H:i:s'),
                    "task_create_date"        => date('Y-m-d'),
                    "prof_task_perfome_dt"        => date('Y-m-d'),
                );
                DB::table('npoly_task_report')
                    ->where('task_id',$ptsk->task_id)
                    ->update($taskData);
                // if ticket id then update ticket table
                if(!empty($empId->ticket_id)){
                    $ticketData = array(
                        "ticket_status"       => 227,
                        "updated_by"        => Auth::user()->id,
                        "updated_at"        => date('Y-m-d H:i:s'),
                    );
                    DB::table('npoly_tickets')
                        ->where('id',$empId->ticket_id)
                        ->update($ticketData);
                }

                // set end time of log task

                $maxStartedLogId = DB::table('npoly_task_report_log')->where('task_id',$ptsk->task_id)->max('task_log_id');

                $updateLogData = array(
                    "end_time"            => $endTime,
                    "updated_by"        => Auth::user()->id,
                    "updated_at"        => date('Y-m-d H:i:s'),
                    "task_create_date"        => date('Y-m-d'),
                    "prof_task_perfome_dt"        => date('Y-m-d'),
                );
                DB::table('npoly_task_report_log')
                    ->where('task_log_id', $maxStartedLogId)
                    ->update($updateLogData);

            }



            $taskData = array(
                "task_running"       => 1,
                "start_time"            => $endTime,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
                "task_create_date"        => date('Y-m-d'),
                "prof_task_perfome_dt"        => date('Y-m-d'),
            );
            DB::table('npoly_task_report')
                ->where('task_id',$taskId)
                ->update($taskData);
            // insert task log data

            $taskInfo = DB::table('npoly_task_report')->select('*')->where('task_id',$taskId)->first();

            $taskMailData = array(
                "task_id"       => $taskInfo->task_id,
                "task_title"         => $taskInfo->task_title,
                "task_desc"             => $taskInfo->task_desc,
                //"departmtent_id"            => $taskInfo->departmtent_id,
                "project_id"            => $taskInfo->project_id,
                "employee_id"            => $taskInfo->employee_id,
                "assign_by"            => $taskInfo->assign_by,
                "assign_date"       => date('Y-m-d',strtotime($taskInfo->assign_date)),
                "forecast_date"       => date('Y-m-d',strtotime($taskInfo->forecast_date)),
                "task_priority_id"            => $taskInfo->task_priority_id,
                "ticket_id"            => $taskInfo->ticket_id,
                "start_time"            => $taskInfo->start_time,
                //"end_time"            => $taskInfo->end_time,
                "task_complete"            => $taskInfo->task_complete,
                "task_duration"            => $taskInfo->task_duration,
                //'active_status'     => 1,
                "created_by"        => Auth::user()->id,
                "created_at"        => date('Y-m-d H:i:s'),
                "task_create_date"        => date('Y-m-d'),
                "prof_task_perfome_dt"        => date('Y-m-d'),
            );

            DB::beginTransaction();
            try {
                $data = DB::table('npoly_task_report_log')->insert($taskMailData);
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
                exit;
            }

        }else{

            $tasStatus = $request->taskStatus;

            if($tasStatus =='1'){
                // stop task
                $time = date('h:i:s A');
                $endTime = strtotime($time) - strtotime('today');
                $taskData = array(
                    "task_running"       => '0',
                    "end_time"       => $endTime,
                    "updated_by"        => Auth::user()->id,
                    "updated_at"        => date('Y-m-d H:i:s'),
                    "task_create_date"        => date('Y-m-d'),
                    "prof_task_perfome_dt"        => date('Y-m-d'),
                );
                DB::table('npoly_task_report')
                    ->where('task_id',$taskId)
                    ->update($taskData);

                // update ticket status if id exist
                if(!empty($empId->ticket_id)){
                    $ticketData = array(
                        "ticket_status"       => 227,
                        "updated_by"        => Auth::user()->id,
                        "updated_at"        => date('Y-m-d H:i:s'),
                    );
                    DB::table('npoly_tickets')
                        ->where('id',$empId->ticket_id)
                        ->update($ticketData);
                }

                // insert log info

                $taskInfo = DB::table('npoly_task_report')->select('*')->where('task_id',$taskId)->first();

                $maxId = DB::table('npoly_task_report_log')->where('task_id',$taskId)->max('task_log_id');

                $updateLogData = array(
                    "end_time"            => $taskInfo->end_time,
                    "task_complete"            => $taskInfo->task_complete,
                    "updated_by"        => Auth::user()->id,
                    "updated_at"        => date('Y-m-d H:i:s'),
                    "task_create_date"        => date('Y-m-d'),
                    "prof_task_perfome_dt"        => date('Y-m-d'),
                );

                DB::beginTransaction();
                try {
                    DB::table('npoly_task_report_log')
                        ->where('task_log_id', $maxId)
                        ->update($updateLogData);
                    DB::commit();
                } catch (\Throwable $e) {
                    DB::rollback();
                    throw $e;
                    exit;
                }

            }else{
                // start task
                $time = date('h:i:s A');
                $seconds = strtotime($time) - strtotime('today');


                $taskData = array(
                    "task_running"       => '1',
                    "start_time"       => $seconds,
                    "updated_by"        => Auth::user()->id,
                    "updated_at"        => date('Y-m-d H:i:s'),
                    "prof_task_perfome_dt"        => date('Y-m-d'),
                    "task_create_date"        => date('Y-m-d'),
                );
                DB::table('npoly_task_report')
                    ->where('task_id',$taskId)
                    ->update($taskData);

                // update ticket status if id exist
                if(!empty($empId->ticket_id)){
                    $ticketData = array(
                        "ticket_status"       => 227,
                        "updated_by"        => Auth::user()->id,
                        "updated_at"        => date('Y-m-d H:i:s'),
                    );
                    DB::table('npoly_tickets')
                        ->where('id',$empId->ticket_id)
                        ->update($ticketData);
                }

                // insert log info
                $taskInfo = DB::table('npoly_task_report')->select('*')->where('task_id',$taskId)->first();

                $taskMailData = array(
                    "task_id"       => $taskInfo->task_id,
                    "task_title"         => $taskInfo->task_title,
                    "task_desc"             => $taskInfo->task_desc,
                    //"departmtent_id"            => $taskInfo->departmtent_id,
                    "project_id"            => $taskInfo->project_id,
                    "employee_id"            => $taskInfo->employee_id,
                    "assign_by"            => $taskInfo->assign_by,
                    "assign_date"       => date('Y-m-d',strtotime($taskInfo->assign_date)),
                    "forecast_date"       => date('Y-m-d',strtotime($taskInfo->forecast_date)),
                    "task_priority_id"            => $taskInfo->task_priority_id,
                    "ticket_id"            => $taskInfo->ticket_id,
                    "start_time"            => $taskInfo->start_time,
                    //"end_time"            => $taskInfo->end_time,
                    "task_complete"            => $taskInfo->task_complete,
                    "task_duration"            => $taskInfo->task_duration,
                    //'active_status'     => 1,
                    "created_by"        => Auth::user()->id,
                    "created_at"        => date('Y-m-d H:i:s'),
                    "task_create_date"        => date('Y-m-d'),
                    "prof_task_perfome_dt"        => date('Y-m-d'),
                );

                DB::beginTransaction();
                try {
                    $data = DB::table('npoly_task_report_log')->insert($taskMailData);
                    DB::commit();
                } catch (\Throwable $e) {
                    DB::rollback();
                    throw $e;
                    exit;
                }
            }
        }


        Session::flash('success', 'Data Updated successfully!');
        //return redirect()->route('taskReportIndex');
        //return redirect('/taskReportIndex');


    }

}
