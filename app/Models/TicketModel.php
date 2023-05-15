<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class TicketModel extends Model
{
    use HasFactory;
    protected $table = 'npoly_tickets';
    protected $primaryKey = 'id';

    /**
     * This method use for save class routine
     * @param Request $request
     *
     */
    public static function createTicket($request){
        if($request->file('ticket_attachment')){
            $files = $request->file('ticket_attachment');

            foreach ($files as $file) {
                $name = date('Ymd').mt_rand(1000,9999).'.'.$file->getClientOriginalExtension();
                $exten = $file->getClientOriginalExtension();
                if($exten == "docx" || $exten == "xlsx" || $exten == "doc" || $exten == "pdf" || $exten == "bmp" || $exten == "zip" ){
                    $file->move(public_path() . '/uploads/ticket_image/', $name);
                }else{
                    $file->move(public_path() . '/uploads/ticket_image/', $name);

                    // $resizedImage = Image::make(public_path() . '/uploads/' . $name)->resize(300, null, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    // save file as jpg with medium quality
                    // $resizedImage->save(public_path() . '/uploads/' . $name, 60);

                }

                // Save the filename to the database

            }

        }
        $maxTicketNo = DB::table('npoly_tickets')->max('id')+1;

        $ticketData = array(
            "client_id"          => $request->client_id,
            "project_id"        => $request->project_id,
            "ticket_no"        => date('ymd').'#'.$maxTicketNo,
            //"course_type"       => Auth::user()->course_type,
            //"department_id"     => Auth::user()->department_id,
            "problem_id"    => $request->problem_id,
            "ticket_title"    => $request->ticket_title,
            "ticket_desc"        => $request->ticket_desc,
            "request_type_id"          => $request->request_type_id,
            'priority_id'          => $request->priority_id,
            'request_mode_id'          => $request->request_mode_id,
            "created_by"        => Auth::user()->id,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('npoly_tickets')->insert($ticketData);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
            exit;
        }

    }

    /**
     * This method use for update class routine
     * @param Request $request
     *
     */
    public static function updateTaskAssign($request){


        $id = $request->ticket_id;




        if($id && DB::table('npoly_tickets')->where('id', $id)->first()){
            $ticketData = array(
                "department_id"          => $request->department_id,
                "employee_id"        => $request->employee_id,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            // insert task info
            $ticktInfo = DB::table('npoly_tickets')->where('id', $id)->first();

            $taskData = array(
                "task_title"          => $ticktInfo->ticket_title,
                "task_desc"           => $ticktInfo->ticket_desc,
                "department_id"       => $request->department_id,
                "employee_id"         => $request->employee_id,
                "work_station"         => $request->work_station,
                "assign_date"         => date('Y-m-d',strtotime($request->assign_date)),
                'forecast_date'       => date('Y-m-d',strtotime($request->forecast_date)),
                'client_id'           => $ticktInfo->client_id,
                'project_id'          => $ticktInfo->project_id,
                'task_priority_id'    => $ticktInfo->priority_id,
                'ticket_id'           => $id,
                'active_status'       => 1,
                "created_by"          => Auth::user()->id,
                "created_at"          => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_tickets')
                    ->where('id', $id)
                    ->update($ticketData);

                $data = DB::table('npoly_task_report')->insert($taskData);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }
    public static function updateBasicInfo($request){
        $id = $request->ticket_id;

        if($id && DB::table('npoly_tickets')->where('id', $id)->first()){
            $ticketData = array(
                "client_id"          => $request->client_id,
                "project_id"          => $request->project_id,
                "ticket_title"        => $request->ticket_title,
                "ticket_desc"        => $request->ticket_desc,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );



            DB::beginTransaction();
            try {
                DB::table('npoly_tickets')
                    ->where('id', $id)
                    ->update($ticketData);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }
    public static function updateStatusInfo($request){
        $id = $request->ticket_id;

        if($id && DB::table('npoly_tickets')->where('id', $id)->first()){
            $ticketData = array(
                "ticket_status"          => $request->ticket_status,
                "request_type_id"          => $request->request_type_id,
                "priority_id"        => $request->priority_id,
                "request_mode_id"        => $request->request_mode_id,
                "resolution"        => $request->resolution,
                "remarks"        => $request->remarks,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );



            DB::beginTransaction();
            try {
                DB::table('npoly_tickets')
                    ->where('id', $id)
                    ->update($ticketData);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }
    public static function updateAssignInfo($request){
        $id = $request->ticket_id;

        if($id && DB::table('npoly_tickets')->where('id', $id)->first()){
            $ticketData = array(
                "department_id"          => $request->department_id,
                "employee_id"          => $request->employee_id,
                "ticket_status"          => '234',
                //"assign_date"        => $request->assign_date,
                //"forecast_date"        => $request->forecast_date,
                //"work_station"        => $request->work_station,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_tickets')
                    ->where('id', $id)
                    ->update($ticketData);

                $checkAssingInfo = DB::table('npoly_task_report')->select('*')->where('ticket_id',$id)->first();
                if(empty($checkAssingInfo)){
                    $ticktInfo = DB::table('npoly_tickets')->where('id', $id)->first();
                    $taskData = array(
                        "task_title"          => $ticktInfo->ticket_title,
                        "task_desc"           => $ticktInfo->ticket_desc,
                        "department_id"       => $request->department_id,
                        "employee_id"         => $request->employee_id,
                        "work_station"         => $request->work_station,
                        "assign_date"         => date('Y-m-d',strtotime($request->assign_date)),
                        'forecast_date'       => date('Y-m-d',strtotime($request->forecast_date)),
                        'client_id'           => $ticktInfo->client_id,
                        'project_id'          => $ticktInfo->project_id,
                        'task_priority_id'    => $ticktInfo->priority_id,
                        'ticket_id'           => $id,
                        'active_status'       => 1,
                        "created_by"          => Auth::user()->id,
                        "created_at"          => date('Y-m-d H:i:s'),
                    );
                    $data = DB::table('npoly_task_report')->insert($taskData);
                }

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }
    public static function updateReAssignInfo($request){
        $id = $request->ticket_id;

        if($id && DB::table('npoly_tickets')->where('id', $id)->first()){
            $ticketData = array(
                "department_id"          => $request->department_id,
                "employee_id"          => $request->employee_id,
                "ticket_status"          => '234',
                "previous_emp_id"        => $request->previoue_emp_id,
                "previous_task_id"        => $request->previoue_task_id,
                "reassign_reason"        => $request->reassign_reason,
                "reassign_fg"        => 1,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_tickets')
                    ->where('id', $id)
                    ->update($ticketData);

                $checkAssingInfo = DB::table('npoly_task_report')->select('*')->where('ticket_id',$id)->first();
                if(empty($checkAssingInfo)){
                    $ticktInfo = DB::table('npoly_tickets')->where('id', $id)->first();
                    $taskData = array(
                        "task_title"          => $ticktInfo->ticket_title,
                        "task_desc"           => $ticktInfo->ticket_desc,
                        "department_id"       => $request->department_id,
                        "employee_id"         => $request->employee_id,
                        "previous_ticket_id"         => $id,
                        "reassing_task_fg"         => 1,
                        "work_station"         => $request->work_station,
                        "assign_date"         => date('Y-m-d',strtotime($request->assign_date)),
                        'forecast_date'       => date('Y-m-d',strtotime($request->forecast_date)),
                        'client_id'           => $ticktInfo->client_id,
                        'project_id'          => $ticktInfo->project_id,
                        'task_priority_id'    => $ticktInfo->priority_id,
                        'ticket_id'           => $id,
                        'active_status'       => 1,
                        "created_by"          => Auth::user()->id,
                        "created_at"          => date('Y-m-d H:i:s'),
                    );
                    $data = DB::table('npoly_task_report')->insert($taskData);
                }

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }

}
