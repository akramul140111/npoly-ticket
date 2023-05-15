<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class SupportTicketModel extends Model
{
    use HasFactory;
    protected $table = 'npoly_tickets';
    protected $primaryKey = 'id';

    /**
     * This method use for save class routine
     * @param Request $request
     *
     */
    public static function createSupportTicket($request){
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
            //"client_id"          => $request->client_id,
            //"project_id"        => $request->project_id,
            "ticket_no"        => date('ymd').'#'.$maxTicketNo,
            //"course_type"       => Auth::user()->course_type,
            //"department_id"     => Auth::user()->department_id,
            "problem_id"    => $request->problem_id,
            "ticket_title"    => $request->ticket_title,
            "ticket_desc"        => $request->ticket_desc,
            "issue_type_id"          => $request->issue_type_id,
            'priority_id'          => $request->priority_id,
            'module_id'          => $request->module_id,
            'contact_person'          => $request->contact_person,
            'ticket_status'          => '238',
            "support_user_id"        => Auth::user()->id,
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
    public static function createSupportTicketInfo($request){
//        if($request->file('ticket_attachment')){
//            $files = $request->file('ticket_attachment');
//            foreach ($files as $file) {
//
//                //$name = date('Ymd').mt_rand(1000,9999).'.'.$file->getClientOriginalExtension();
//                $name = $file->getClientOriginalName();
//                $exten = $file->getClientOriginalExtension();
//                if($exten == "docx" || $exten == "xlsx" || $exten == "doc" || $exten == "pdf" || $exten == "bmp" || $exten == "zip" ){
//                    $file->move(public_path() . '/uploads/ticket_image/', $name);
//                }else{
//                    $file->move(public_path() . '/uploads/ticket_image/', $name);
//                }
//
//                // Save the filename to the database
//
//            }
//
//        }
        $maxTicketNo = DB::table('npoly_tickets')->max('id')+1;

        $ticketData = array(
            //"client_id"          => $request->client_id,
            //"project_id"        => $request->project_id,
            "ticket_no"        => date('ymd').'#'.$maxTicketNo,
            //"course_type"       => Auth::user()->course_type,
            //"department_id"     => Auth::user()->department_id,
            //"problem_id"    => $request->problem_id,
            "ticket_title"    => $request->ticket_title,
            "ticket_desc"        => $request->ticket_desc,
            "issue_type_id"          => $request->issue_type,
            //'priority_id'          => $request->priority_id,
            'priority_id'          => '218',
            'module_id'          => $request->module_id,
            //'system_lifecycle'          => $request->system_lifecycle,
            'contact_person'          => $request->contact_person,
            'ticket_status'          => '238',
            "support_user_id"        => Auth::user()->id,
            "created_by"        => Auth::user()->id,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            //$data = DB::table('npoly_tickets')->insert($ticketData);
            $ticketId = DB::table('npoly_tickets')->insertGetId($ticketData);
            DB::commit();

            // ticket attachment store
            if($request->file('ticket_attachment')){
                $files = $request->file('ticket_attachment');
                foreach ($files as $file) {

                    //$name = $Userid.'-'.date('Ymd').mt_rand(1000,9999).'.'.$file->getClientOriginalExtension();
                    $name = $ticketId.'-'.$file->getClientOriginalName();
                    $exten = $file->getClientOriginalExtension();
                    if($exten == "docx" || $exten == "xlsx" || $exten == "doc" || $exten == "pdf" || $exten == "bmp" || $exten == "zip" ){
                        $file->move(public_path() . '/uploads/ticket_image/', $name);
                    }else{
                        $file->move(public_path() . '/uploads/ticket_image/', $name);
                    }

                    // Save the filename to the database

                    $ticketAttachData = array(
                        "ticket_id"    => $ticketId,
                        "ticket_attachment"      => '/uploads/ticket_image/'.$name,
                        "created_by"        => Auth::user()->id,
                        "created_at"        => date('Y-m-d H:i:s'),
                    );
                    $data = DB::table('npoly_ticket_attachment')->insert($ticketAttachData);

                }

            }


            return $ticketId;
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
    public static function updateCloseReason($request){
        $id = $request->ticket_id;

        if($id && DB::table('npoly_tickets')->where('id', $id)->first()){
            $ticketData = array(
                "close_update_details"  => $request->close_update_details,
                "close_reason"          => $request->close_reason,
                "updated_by"            => Auth::user()->id,
                "updated_at"            => date('Y-m-d H:i:s'),
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
    public static function updateTicketDetails($request,$id){

        if($id && DB::table('npoly_tickets')->where('id', $id)->first()){
            $ticketStatus = DB::table('npoly_tickets')->where('id', $id)->first();
            $ticketData = array(
                "update_details"  => $request->update_details,
                "ticket_status"  => !empty($request->ticket_status)?$request->ticket_status:$ticketStatus->ticket_status,
                "updated_by"            => Auth::user()->id,
                "updated_at"            => date('Y-m-d H:i:s'),
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
    public static function updateAttachment($request,$id){
        //$id = $request->ticket_id;

        if($request->file('ticket_attachment')){
            $files = $request->file('ticket_attachment');

            foreach ($files as $file) {
                $name = date('Ymd').mt_rand(1000,9999).'.'.$file->getClientOriginalExtension();
                $exten = $file->getClientOriginalExtension();
                if($exten == "docx" || $exten == "xlsx" || $exten == "doc" || $exten == "pdf" || $exten == "bmp" || $exten == "zip" ){
                    $file->move(public_path() . '/uploads/ticket_image/', $name);
                }else{
                    $file->move(public_path() . '/uploads/ticket_image/', $name);
                }
                // Save the filename to the database

                $ticketAttachData = array(
                    "ticket_id"    => $id,
                    "ticket_attachment"      => '/uploads/ticket_image/'.$name,
                    "created_by"        => Auth::user()->id,
                    "created_at"        => date('Y-m-d H:i:s'),
                );

                DB::beginTransaction();
                try {
                    $data = DB::table('npoly_ticket_attachment')->insert($ticketAttachData);
                    DB::commit();
                } catch (\Throwable $e) {
                    DB::rollback();
                    throw $e;
                }

            }


        }


        if($id && DB::table('npoly_tickets')->where('id', $id)->first()){
            $ticketData = array(
                "attachment_note"    => $request->attachment_note,
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

}
