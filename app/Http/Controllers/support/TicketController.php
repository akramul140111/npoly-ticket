<?php

namespace App\Http\Controllers\support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\TicketModel;
use  App\Models\lookup\LookupGroupDataModel;
use DB;
use Auth;
use Illuminate\Support\Facades\Mail;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Ticket',
            'tableTitle' => ''

        );

        $results = DB::table('npoly_tickets as tkt')
            ->leftJoin('sa_lookup_data as lkp', 'tkt.priority_id', '=', 'lkp.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkp1', 'tkt.ticket_status', '=', 'lkp1.LOOKUP_DATA_ID')
            ->leftJoin('npoly_clients as clnt', 'clnt.client_id', '=', 'tkt.client_id')
            ->leftJoin('npoly_projects as pro', 'pro.project_id', '=', 'tkt.project_id')
            ->leftJoin('npoly_task_report as tskr', 'tskr.ticket_id', '=', 'tkt.id')
            ->leftJoin('npoly_support_modules as tm', 'tm.module_id', '=', 'tkt.module_id')
            ->select('tkt.*','lkp.LOOKUP_DATA_NAME as priorityName','clnt.client_name','pro.project_name','tskr.employee_id','tskr.task_complete','lkp1.LOOKUP_DATA_NAME as ticketStatus','tm.module_name')
            ->where('tkt.ticket_status','!=',230)
            ->orderBy('tkt.id','desc')
            ->get();

        return view('support.index',compact('header','results'));
    }

    /**
     * Create class routine form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle' => 'Ticket',
            'tableTitle' => 'Ticket List'

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



        //$batchItems=LookupGroupDataModel::where('LOOKUP_GRP_ID',7)->get();

        return view('support.create', compact('header',  'requestType', 'priority', 'requestMode','clients','problemList'));
    }

    /* save class routine
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        TicketModel::createTicket($request);
        // Mail Generate Start
        //$data = array('0'=>"Md. Azam Ali",'1'=>'djkj');
        //$data['name']= 'Md. Azam Ali';

//        Mail::send(['mails.ticket_mail'], $data, function($message) {
//            $message->to('azam.ali@nationalpolymer.net', 'Test Mail')->subject
//            ('Laravel Basic Testing Mail');
//            $message->from('ticket@nationalpolymer.net','Npoly Ticket');
//            $message->cc('azamalibd808@gmail.com');
//            $message->bcc('ishtiaq.ahmed@nationalpolyemr.net');
//
//        });
//        echo "Basic Email Sent. Check your inbox.";

        $details = [
            'title' => 'Npoly Ticket',
            'body' => 'This is for testing email using smtp'
        ];
        $ccEmails = ["azamalibd808@gmail.com"];
        $bccEmails = ["azam.ali@nationalpolymer.net"];

        \Mail::to('azam.ali@nationalpolymer.net')
        //\Mail::to('faysalahmedgiant@gmail.com')
            ->cc($ccEmails)
            ->bcc($bccEmails)
            ->send(new \App\Mail\TicketMail($details));

//        $mailData = [
//            'title' => 'Npoly Ticket',
//            'body' => 'This is for testing email using smtp.'
//        ];
//
//        $ccEmails = ["ishtiaq.ahmed@nationalpolyemr.net"];
//        $bccEmails = ["azamalibd808@gmail.com"];
//        Mail::to('azam.ali@nationalpolyemr.net')
//            ->cc($ccEmails)
//            ->bcc($bccEmails)
//            ->send(new \App\Mail\TicketMail($mailData));

        //dd("Email is sent successfully.");
        // Mail Generate End
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('ticketIndex');
    }

    /* class routine update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle' => 'Ticket',
            'tableTitle' => 'Ticket List'

        );

        $department = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 5)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();

        $employee = DB::table('npoly_employees')
            ->select('employee_id','employee_name')
            ->where('active_status',1)
            ->get();


        //$result = TicketModel::find($id);
        $result = DB::table('npoly_tickets as tkt')
            ->leftJoin('npoly_clients as clnt','tkt.client_id','clnt.client_id')
            ->leftJoin('npoly_projects as pro','tkt.project_id','pro.project_id')
            ->select('tkt.*','clnt.client_name','pro.project_name')
            ->where('id',$id)
            ->first();
        return view('support.update', compact('header', 'result','department','employee'));

    }

    public function ticketInfo(Request $request){
        $ticketId = $request->ticketId;

        if(!empty($ticketId)){
            $result = DB::table('npoly_tickets as tkt')
                ->leftJoin('npoly_clients as clnt','tkt.client_id','clnt.client_id')
                ->leftJoin('npoly_projects as pro','tkt.project_id','pro.project_id')
                ->select('tkt.*','clnt.client_name','pro.project_name')
                ->where('id',$ticketId)
                ->first();

            return view('support.ticket_basic_info', compact('result'));
        }
    }
    public function getTicketAssignInfo(Request $request){
        $ticketId = $request->ticketId;

        if(!empty($ticketId)){
            $result = DB::table('npoly_tickets as tkt')
                ->leftJoin('npoly_clients as clnt','tkt.client_id','clnt.client_id')
                ->leftJoin('npoly_task_report as tr','tkt.id','tr.ticket_id')
                ->leftJoin('npoly_projects as pro','tkt.project_id','pro.project_id')
                ->select('tkt.*','clnt.client_name','pro.project_name','tr.employee_id','tr.assign_date','tr.forecast_date','tr.work_station')
                ->where('id',$ticketId)
                ->first();

            return view('support.ticket_assign_info', compact('result'));
        }
    }
    public function getTicketStatus(Request $request){
        $ticketId = $request->ticketId;

        if(!empty($ticketId)){
            $result = DB::table('npoly_tickets as tkt')
                ->leftJoin('sa_lookup_data as lkp', 'tkt.priority_id', '=', 'lkp.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkp1', 'tkt.request_type_id', '=', 'lkp1.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkp2', 'tkt.request_mode_id', '=', 'lkp2.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkp3', 'tkt.ticket_status', '=', 'lkp3.LOOKUP_DATA_ID')
                ->select('tkt.*','lkp.LOOKUP_DATA_NAME as priorityName','lkp1.LOOKUP_DATA_NAME as requestType','lkp2.LOOKUP_DATA_NAME as requestMode','lkp3.LOOKUP_DATA_NAME as ticketStatus')
                ->orderBy('tkt.id','desc')
                ->where('id',$ticketId)
                ->first();


            return view('support.ticket_status_info', compact('result'));
        }
    }

    /* class routine update action
     * @param $request
     *
     */
    public function update(Request $request)
    {
        TicketModel::updateTaskAssign($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('ticketIndex');
    }
    public function updateBasicInfo(Request $request)
    {
        TicketModel::updateBasicInfo($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('ticketIndex');
    }
    public function updateStatusInfo(Request $request)
    {
        TicketModel::updateStatusInfo($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('ticketIndex');
    }
    public function updateAssignInfo(Request $request)
    {
        TicketModel::updateAssignInfo($request);
        // mail send after assign ticket
        $results = DB::table('npoly_tickets as tkt')
            //->leftJoin('npoly_clients as clnt','tkt.client_id','clnt.client_id')
            ->leftJoin('npoly_projects as pro','tkt.project_id','pro.project_id')
            ->leftJoin('npoly_support_modules as mod','tkt.module_id','mod.module_id')
            ->leftJoin('sa_lookup_data as lkp','tkt.priority_id','lkp.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkp1','tkt.ticket_status','lkp1.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkp2','tkt.issue_type_id','lkp2.LOOKUP_DATA_ID')
            ->select('tkt.*','pro.project_name','mod.module_name','lkp.LOOKUP_DATA_NAME as priority_name','lkp1.LOOKUP_DATA_NAME as ticket_status','lkp2.LOOKUP_DATA_NAME as issue_type')
            ->where('id',$request->ticket_id)
            ->first();

        $data['results']= $results ;
        $data['ticket_id']= $request->ticket_id;
        $data['title'] = 'Pending Ticket';
        $data['form_email'] = 'ticket@nationalpolymer.net';
        $data['to_email'] = 'azam.ali@nationalpolymer.net';
        $data['form_name'] = 'Support User'.'('.$results->ticket_no.')';
        $data['to_name'] = 'Npoly Group';

        $sent = Mail::send('emails.ticket_mail', $data, function ($email) use ($data) {
            $email->subject($data['title']);
            $email->from('ticket@nationalpolymer.net','Npoly Ticket');
            $email->to(['azam.ali@nationalpolymer.net']);
            $email->cc(['azam.ali@nationalpolymer.net']);
            //$email->bcc('azam.ali@nationalpolymer.net');
        });
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('ticketIndex');
    }

    /* get day of date
     * @param $date
     *
     */


    public function getPorject($clientId){
      if(!empty($clientId)){
          $projectInfo = DB::table('npoly_projects')
              ->select('project_id','project_name')
              ->where('client_id',$clientId)
              ->where('active_status',1)
              ->get();

          if($projectInfo){
              $pro = '<option value="">--select--</option>';
              foreach($projectInfo as $p){
                  $pro.='<option value="'.$p->project_id.'">'.$p->project_name.'</option>';
              }
              return $pro;
          }

      }
    }
    public function getEmployee($depId){
        if(!empty($depId)){
            $empInfo = DB::table('npoly_employees')
                ->select('employee_id','employee_name')
                ->where('department_id',$depId)
                ->where('active_status',1)
                ->get();

            if($empInfo){
                $emps = '<option value="">--select--</option>';
                foreach($empInfo as $emp){
                    $emps.='<option value="'.$emp->employee_id.'">'.$emp->employee_name.'</option>';
                }
                return $emps;
            }

        }
    }

    // Modify Ticket Info
    public  function editTicketInfo(Request $request){
        $ticketId = $request->ticketId;

        if(!empty($ticketId)){
            $ticketInfo = DB::table('npoly_tickets')
                ->select('*')
                ->where('id',$ticketId)
                ->first();

            $clinets = DB::table('npoly_clients')
                ->select('client_id','client_name')
                ->where('active_status',1)
                ->get();

            $projects = DB::table('npoly_projects')
                ->select('project_id','project_name')
                ->where('active_status',1)
                ->where('client_id',$ticketInfo->client_id)
                ->get();

            return view('support.edit_ticket_basic_info', compact('ticketInfo','clinets','projects'));


        }
    }
    public  function editStatusInfo(Request $request){
        $ticketId = $request->ticketId;

        if(!empty($ticketId)){
            $ticketInfo = DB::table('npoly_tickets')
                ->select('*')
                ->where('id',$ticketId)
                ->first();

            $ticketStatus = DB::table('sa_lookup_data as s')
                ->where('s.LOOKUP_GRP_ID', 38)
                ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
                ->where('s.ACTIVE_FLAG', 1)
                ->where('s.LOOKUP_DATA_ID', '!=','234')
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

            return view('support.edit_ticket_status_info', compact('ticketInfo','ticketStatus','requestType','priority','requestMode'));


        }
    }
    public  function editAssignInfo(Request $request){
        $ticketId = $request->ticketId;

        if(!empty($ticketId)){
            $department = DB::table('sa_lookup_data as s')
                ->where('s.LOOKUP_GRP_ID', 5)
                ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
                ->where('s.ACTIVE_FLAG', 1)
                ->get();

            $employee = DB::table('npoly_employees')
                ->select('employee_id','employee_name')
                ->where('active_status',1)
                ->get();


            //$result = TicketModel::find($id);
            $result = DB::table('npoly_tickets as tkt')
                ->leftJoin('npoly_clients as clnt','tkt.client_id','clnt.client_id')
                ->leftJoin('npoly_task_report as tr','tkt.id','tr.ticket_id')
                ->leftJoin('npoly_projects as pro','tkt.project_id','pro.project_id')
                ->select('tkt.*','clnt.client_name','pro.project_name','tr.employee_id','tr.assign_date','tr.forecast_date','tr.work_station')
                ->where('id',$ticketId)
                ->first();

            return view('support.edit_ticket_assign_info', compact('department','employee','result'));


        }
    }

}
