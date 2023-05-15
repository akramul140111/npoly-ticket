<?php

namespace App\Http\Controllers\support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\SupportTicketModel;
use  App\Models\lookup\LookupGroupDataModel;
use DB;
use Auth;
use DateTime;
use Illuminate\Support\Facades\Mail;

class SupportTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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

        $issueType = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 40)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->where('s.ACTIVE_FLAG', 1)
            ->get();
        $supportModule = DB::table('npoly_support_modules')
            ->select('module_id','module_name')
            ->where('active_status',1)
            ->get();

        $employees = DB::table('npoly_employees')->select('employee_id','employee_name')->get();




        //$batchItems=LookupGroupDataModel::where('LOOKUP_GRP_ID',7)->get();

        return view('support_user.create', compact('header',  'requestType', 'priority', 'requestMode','clients','problemList','issueType','supportModule','employees'));
    }

    public function supportTicketInfo(){
        $header = array(
            'pageTitle'  => 'Ticket Information',
            'tableTitle' => 'Ticket Information'
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
        return view('support_user.support_ticket_info', compact('header','requestType','priority','requestMode','problemList','issueType','supportModule','employees','businessImpact'));
    }

    /* save class routine
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        SupportTicketModel::createSupportTicket($request);

        Session::flash('success', 'Data Saved successfully!');
        //return redirect()->route('/home');
        return redirect('/home');
    }
    public function storeSupportTicketInfo(Request $request){
       $returnId =  SupportTicketModel::createSupportTicketInfo($request);

        $results = DB::table('npoly_tickets as tkt')
            //->leftJoin('npoly_clients as clnt','tkt.client_id','clnt.client_id')
            ->leftJoin('npoly_projects as pro','tkt.project_id','pro.project_id')
            ->leftJoin('npoly_support_modules as mod','tkt.module_id','mod.module_id')
            ->leftJoin('sa_lookup_data as lkp','tkt.priority_id','lkp.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkp1','tkt.ticket_status','lkp1.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkp2','tkt.issue_type_id','lkp2.LOOKUP_DATA_ID')
            ->select('tkt.*','pro.project_name','mod.module_name','lkp.LOOKUP_DATA_NAME as priority_name','lkp1.LOOKUP_DATA_NAME as ticket_status','lkp2.LOOKUP_DATA_NAME as issue_type')
            ->where('id',$returnId)
            ->first();
        // mail config start here
        $aFileName = $_FILES['ticket_attachment']['name'];
        $aFile=$aFileName[0];
        $data['results']= $results ;
        $data['ticket_id']= $returnId ;
        $data['title'] = 'Support Ticket';
        $data['form_email'] = 'ticket@nationalpolymer.net';
        $data['to_email'] = 'azam.ali@nationalpolymer.net';
        $data['form_name'] = 'Support User'.'('.$results->ticket_no.')';
        $data['to_name'] = 'Npoly Group';
        //$data['to_email'] = 'azam.ali@nationalpolymer.net';

        if($aFile== ''){
            $sent = Mail::send('mails.ticket_mail', $data, function ($m) use ($data) {
                $m->from($data['form_email'], $data['form_name']);
                $m->to($data['to_email'], $data['to_name']);
                $m->cc(['azamalibd808@gmail.com','ishtiaq.ahmed@nationalpolymer.net']);
                $m->subject($data['title']);
            });
        }else{

            $sent = Mail::send('mails.ticket_mail', $data, function ($m) use ($data) {
                $m->from($data['form_email'], $data['form_name']);
                $m->to($data['to_email'], $data['to_name']);
                //$m->cc($data['cc'], $data['to_name']);
                $m->cc(['azamalibd808@gmail.com','ishtiaq.ahmed@nationalpolymer.net']);
                $m->subject($data['title']);
                $size = sizeOf($_FILES['ticket_attachment']['name']);
                for ($i=0; $i < $size; $i++) {
                    //$m->attach("UPLOADS/ATTACHMENT/".$_FILES['ticket_attachment']['name'][$i]);
                    $m->attach("public/uploads/ticket_image/".$data['ticket_id'].'-'.$_FILES['ticket_attachment']['name'][$i]);
                }
            });

        }
        // mail config end  here

//        $details = [
//            'title' => 'Npoly Ticket',
//            'body' => 'This is for testing email using smtp'
//        ];
//        $ccEmails = ["azam.ahmed@nationalpolymer.net"];
//        $bccEmails = ["azam.ali@nationalpolymer.net"];
//
//        \Mail::to('azam.ali@nationalpolymer.net')
//            //\Mail::to('faysalahmedgiant@gmail.com')
//            ->cc($ccEmails)
//            ->bcc($bccEmails)
//            ->send(new \App\Mail\TicketMail($details));


        Session::flash('success', 'Data Saved successfully!');
        //return redirect()->route('/home');
        return redirect('/support_home');
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
        SupportTicketModel::updateTaskAssign($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('ticketIndex');
    }
    public function updateBasicInfo(Request $request)
    {
        SupportTicketModel::updateBasicInfo($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('ticketIndex');
    }
    public function updateStatusInfo(Request $request)
    {
        SupportTicketModel::updateStatusInfo($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('ticketIndex');
    }
    public function updateAssignInfo(Request $request)
    {
        SupportTicketModel::updateAssignInfo($request);
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

    public function getCloseTicket($id){
        if($id =='230'){
            $results = DB::table('npoly_tickets as tkt')
                ->leftJoin('sa_lookup_data as lkp', 'tkt.priority_id', '=', 'lkp.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkp1', 'tkt.ticket_status', '=', 'lkp1.LOOKUP_DATA_ID')
                ->leftJoin('npoly_clients as clnt', 'clnt.client_id', '=', 'tkt.client_id')
                ->leftJoin('npoly_projects as pro', 'pro.project_id', '=', 'tkt.project_id')
                ->leftJoin('npoly_task_report as tskr', 'tskr.ticket_id', '=', 'tkt.id')
                ->leftJoin('npoly_support_modules as stm', 'stm.module_id', '=', 'tkt.module_id')
                ->select('tkt.*','lkp.LOOKUP_DATA_NAME as priorityName','clnt.client_name','pro.project_name','tskr.employee_id','tskr.task_complete','lkp1.LOOKUP_DATA_NAME as ticketStatus','stm.module_name')
                ->where('support_user_id',Auth::user()->support_user_id)
                ->where('tkt.ticket_status','=',230)
                ->orderBy('tkt.id','desc')
                ->get();
        }else{
            $results = DB::table('npoly_tickets as tkt')
                ->leftJoin('sa_lookup_data as lkp', 'tkt.priority_id', '=', 'lkp.LOOKUP_DATA_ID')
                ->leftJoin('sa_lookup_data as lkp1', 'tkt.ticket_status', '=', 'lkp1.LOOKUP_DATA_ID')
                ->leftJoin('npoly_clients as clnt', 'clnt.client_id', '=', 'tkt.client_id')
                ->leftJoin('npoly_projects as pro', 'pro.project_id', '=', 'tkt.project_id')
                ->leftJoin('npoly_task_report as tskr', 'tskr.ticket_id', '=', 'tkt.id')
                ->leftJoin('npoly_support_modules as stm', 'stm.module_id', '=', 'tkt.module_id')
                ->select('tkt.*','lkp.LOOKUP_DATA_NAME as priorityName','clnt.client_name','pro.project_name','tskr.employee_id','tskr.task_complete','lkp1.LOOKUP_DATA_NAME as ticketStatus','stm.module_name')
                ->where('support_user_id',Auth::user()->support_user_id)
                ->where('tkt.ticket_status','!=',230)
                ->orderBy('tkt.id','desc')
                ->get();
        }

        return view('support_user.getCloseTicket',compact('results'));
    }

    public function getTicketDetailsInfo($id){

        $ticketDetails = DB::table('npoly_tickets')->select('*')->where('id',$id)->first();
        $maxUpdatedTime = DB::selectOne("select max(updated_at) as last_updated from npoly_tickets where active_status= 1");
        $lastUpdate = '';
        if(!empty($maxUpdatedTime)){
            $maxTime = date('h:i:s',strtotime($maxUpdatedTime->last_updated));
            $currnetTime = date('h:i:s');

            $time1 = new DateTime($maxTime);
            $time2 = new DateTime($currnetTime);
            $interval = $time1->diff($time2);
            $lastUpdate .= $interval->format('%h')." Hours ".$interval->format('%i')." Minutes";

        }
       return view('support_user.ticketDetailsInfo',compact('ticketDetails','lastUpdate'));
    }

    public function updateTicketDetails(Request $request,$id){

        if($_POST){
            SupportTicketModel::updateTicketDetails($request,$id);

            Session::flash('success', 'Data Update successfully!');
            return redirect('/getTicketDetailsInfo/'.$id);
        }else{
            $ticketDetailsInfo = DB::table('npoly_tickets')
                ->select('id','update_details')
                ->where('id',$id)
                ->first();
            $ticketStatus = DB::table('sa_lookup_data')
                ->select("lookup_data_id",'lookup_data_name')
                ->whereIn('lookup_data_id',[229,230])
                ->get();

            return view('support_user.updateTicketDetails',compact('ticketDetailsInfo','id','ticketStatus'));
        }


    }
    public function updateTicketAttachment(Request $request,$id){

        if($_POST){
            SupportTicketModel::updateAttachment($request,$id);

            Session::flash('success', 'Data Update successfully!');
            return redirect('/getTicketDetailsInfo/'.$id);
        }else{
            $closeTicketInfo = DB::table('npoly_tickets')
                ->select('id','attachment_note')
                ->where('id',$id)
                ->first();

            return view('support_user.updateTicketAttachment',compact('closeTicketInfo','id'));
        }


    }
    public function updateCloseTicket(Request $request,$id){

        if($_POST){
            SupportTicketModel::updateCloseReason($request);

            Session::flash('success', 'Data Update successfully!');
            //return redirect()->route('/home');
            return redirect('/getTicketDetailsInfo/'.$id);
        }else{
            $closeReason = DB::table('sa_lookup_data')
                ->select('LOOKUP_DATA_ID','LOOKUP_DATA_NAME')
                ->where('LOOKUP_GRP_ID',43)
                ->where('ACTIVE_FLAG',1)
                ->get();

            $closeTicketInfo = DB::table('npoly_tickets')
                ->select('id','close_update_details','close_reason')
                ->where('id',$id)
                ->first();


            return view('support_user.updateCloseTicket',compact('closeReason','id','closeTicketInfo'));
        }


    }

}
