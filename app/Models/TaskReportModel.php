<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
use Mail;

class TaskReportModel extends Model
{
    use HasFactory;
    protected $table = 'npoly_task_report';
    protected $primaryKey = 'task_id';

    /**
     * This method use for save class routine
     * @param Request $request
     *
     */
    public static function createTaskAssign($request){
        $taskAssignData = array(
            "project_id"          => $request->project_id,
            "client_id"          => DB::selectOne("select client_id from npoly_projects where project_id = $request->project_id")->client_id,
            "task_title"          => $request->task_title,
            "task_desc"        => $request->task_desc,
            "assign_by"    => $request->assign_by,
            "employee_id"    => $request->assign_to,
            "assign_date"    => date('Y-m-d',strtotime($request->assign_date)),
            "forecast_date"    => date('Y-m-d',strtotime($request->forecast_date)),
            "task_priority_id"    => $request->task_priority,
            "task_duration"    => $request->task_duration,
            "department_id"    => Auth::user()->department_id,
            'active_status'          => 1,
            "created_by"        => Auth::user()->id,
            "created_at"        => date('Y-m-d H:i:s'),
            "task_create_date"        => date('Y-m-d'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('npoly_task_report')->insert($taskAssignData);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
            exit;
        }

    }
    public static function createTask($request){
        $time = date('h:i:s A');
        $startTime = strtotime($time) - strtotime('today');
        $taskData = array(
            "project_id"          => $request->project_id,
            "client_id"          => DB::selectOne("select client_id from npoly_projects where project_id = $request->project_id")->client_id,
            "task_title"          => $request->task_title,
            "task_desc"        => $request->task_desc,
            "assign_by"    => $request->assign_by,
            "work_station"    => $request->work_station,
            "employee_id"    => Auth::user()->employee_id,
            "assign_date"    => date('Y-m-d',strtotime($request->assign_date)),
            "forecast_date"    => date('Y-m-d',strtotime($request->forecast_date)),
            //"task_duration"    => $request->task_duration,
            "department_id"    => Auth::user()->department_id,
            'active_status'          => 1,
            'task_priority_id'          => 218,
            'task_running'          => $request->start_status =='1' ? 1:0,
            'start_time'          => $request->start_status =='1' ? $startTime:0,
            "created_by"        => Auth::user()->id,
            "task_create_date"        => date('Y-m-d'),
            "prof_task_perfome_dt"        => date('Y-m-d'),
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('npoly_task_report')->insert($taskData);
            DB::commit();
            if($request->start_status==1){
                $maxStartedLogId = DB::table('npoly_task_report')->max('task_id');
                $taskInfo = DB::table('npoly_task_report')->select('*')->where('task_id',$maxStartedLogId)->first();

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
                $data = DB::table('npoly_task_report_log')->insert($taskMailData);
            }


        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
            exit;
        }

    }
    public static function createTaskMail($request){
        $ccTo = implode(',',$request->cc_person);
        $bccTo = implode(',',$request->bcc_person);

        $cc_toMail = DB::select("select email from npoly_employees where employee_id in($ccTo)");
        //$ccMailId = '';
        if(!empty($cc_toMail)){
            $ccMail =[];
            foreach ($cc_toMail as $cc){
                $ccMail [] = "'".$cc->email."'";
            }
            $ccMailId = implode(',',$ccMail);
            $ccToName = str_replace('"','',$ccMailId);
        }
        $taskMailData = array(
            "employee_id"       => $request->employee_id,
            "report_to"         => $request->report_to,
            "cc_to"             => $ccTo,
            //"cc_to_name"             => $ccToName,
            "bcc_to"            => $bccTo,
            "assign_date"       => date('Y-m-d',strtotime($request->assign_date)),
            'active_status'     => 1,
            "created_by"        => Auth::user()->id,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('npoly_task_mail')->insert($taskMailData);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
            exit;
        }

    }

    public static function updateTaskMailInof($request){


        $id = $request->task_mail_id;


        if($id && DB::table('npoly_task_mail')->where('task_mail_id', $id)->first()){
            $ccTo = implode(',',$request->cc_person);
            $bccTo = implode(',',$request->bcc_person);
            $taskData = array(
                "employee_id"       => $request->employee_id,
                "report_to"         => $request->report_to,
                "cc_to"             => $ccTo,
                "bcc_to"            => $bccTo,
                "assign_date"       => date('Y-m-d',strtotime($request->assign_date)),
                "active_status"          => $request->active_status,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_task_mail')
                    ->where('task_mail_id', $id)
                    ->update($taskData);


                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }

    /**
     * This method use for update class routine
     * @param Request $request
     *
     */
    public static function updateTaskAssign($request){


        $id = $request->task_id;


        if($id && DB::table('npoly_task_report')->where('task_id', $id)->first()){
            $taskData = array(
                "project_id"          => $request->project_id,
                "client_id"          => DB::selectOne("select client_id from npoly_projects where project_id = $request->project_id")->client_id,
                "task_title"          => $request->task_title,
                "task_desc"        => $request->task_desc,
                "assign_by"    => $request->assign_by,
                "employee_id"    => $request->assign_to,
                "assign_date"    => date('Y-m-d',strtotime($request->assign_date)),
                "forecast_date"    => date('Y-m-d',strtotime($request->forecast_date)),
                "task_priority_id"    => $request->task_priority,
                "task_duration"    => $request->task_duration,
                "department_id"    => Auth::user()->department_id,
                "active_status"          => $request->active_status,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_task_report')
                    ->where('task_id', $id)
                    ->update($taskData);

                $ticketId = DB::table('npoly_task_report')->select('ticket_id')->where('task_id',$id)->first();
                if(!empty($ticketId)){
                    $updateTicketStatus = array(
                        'ticket_status'=>'234'
                    );
                    DB::table('npoly_tickets')
                        ->where('id', $ticketId->ticket_id)
                        ->update($updateTicketStatus);
                }

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }
    public static function updateTask($request){


        $id = $request->task_id;


        if($id && DB::table('npoly_task_report')->where('task_id', $id)->first()){
            $taskData = array(
                //"project_id"          => $request->project_id,
                //"client_id"          => DB::selectOne("select client_id from npoly_projects where project_id = $request->project_id")->client_id,
                "task_title"          => $request->task_title,
                "task_desc"        => $request->task_desc,
                "work_station"        => $request->work_station,
                "task_complete"        => $request->task_complete,
                //"assign_by"    => $request->assign_by,
                //"employee_id"    => $request->assign_to,
                "assign_date"    => date('Y-m-d',strtotime($request->assign_date)),
                "forecast_date"    => date('Y-m-d',strtotime($request->forecast_date)),
                //"task_priority_id"    => $request->task_priority,
                //"task_duration"    => $request->task_duration,
                //"department_id"    => Auth::user()->department_id,
                "active_status"          => $request->active_status,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_task_report')
                    ->where('task_id', $id)
                    ->update($taskData);

                // get max task log id
                $maxStartedLogId = DB::table('npoly_task_report_log')->where('task_id',$id)->max('task_log_id');
                $updateLogData = array(
                    "task_complete"     => $request->task_complete,
                    "updated_by"        => Auth::user()->id,
                    "updated_at"        => date('Y-m-d H:i:s'),
                );
                DB::table('npoly_task_report_log')
                    ->where('task_log_id', $maxStartedLogId)
                    ->update($updateLogData);


                if($request->task_complete =='100'){
                    $ticketId = DB::table('npoly_task_report')->select('ticket_id')->where('task_id',$id)->first();
                    if(!empty($ticketId->ticket_id)){
                        $updateTicketStatus = array(
                            'ticket_status'=>'228'
                        );
                        DB::table('npoly_tickets')
                            ->where('id', $ticketId->ticket_id)
                            ->update($updateTicketStatus);

                        // ticket resolved mail form here
                        $results = DB::table('npoly_tickets as tkt')
                            //->leftJoin('npoly_clients as clnt','tkt.client_id','clnt.client_id')
                            ->leftJoin('npoly_projects as pro','tkt.project_id','pro.project_id')
                            ->leftJoin('npoly_support_modules as mod','tkt.module_id','mod.module_id')
                            ->leftJoin('sa_lookup_data as lkp','tkt.priority_id','lkp.LOOKUP_DATA_ID')
                            ->leftJoin('sa_lookup_data as lkp1','tkt.ticket_status','lkp1.LOOKUP_DATA_ID')
                            ->leftJoin('sa_lookup_data as lkp2','tkt.issue_type_id','lkp2.LOOKUP_DATA_ID')
                            ->select('tkt.*','pro.project_name','mod.module_name','lkp.LOOKUP_DATA_NAME as priority_name','lkp1.LOOKUP_DATA_NAME as ticket_status','lkp2.LOOKUP_DATA_NAME as issue_type')
                            ->where('id',$ticketId->ticket_id)
                            ->first();

                        $data['results']= $results ;
                        $data['ticket_id']= $ticketId->ticket_id ;
                        $data['title'] = 'Resolved Ticket';
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
                    }
                }


                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }

}
