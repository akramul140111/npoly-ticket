<?php

namespace App\Models\admin_portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class AssignActivityModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'assign_activity_id';
    protected $table = 'set_assign_activity';

    /**
     * This method use for save block information
     * @param Request $request
     *
     */
    public static function storeAssignActivity($request){

        if($request->department==''){
            echo 'Blank Info';
            exit;
        }

        DB::table('set_assign_activity')
            ->where('course_type', $request->course_type)
            ->where('department', $request->department)
            ->where('course_name',$request->course_name)->delete();

        $activityId = $request->activity_id;
        $activityCount = count($activityId);
        for($i =0; $i <$activityCount; $i++) {
            DB::table('set_assign_activity')->insert([
                'course_type' => $request->course_type,
                'department' => $request->department,
                'course_name' => $request->course_name,
                'activity_id' => $activityId[$i],
            ]);
        }
//        $post                   = new AssignActivityModel();
//        for($i =0; $i <$activityCount; $i++){
//            $post->department      = $request->department[$i];
//            $post->course_name      = $request->course_name[$i];
//            $post->activity_id      = $activityId[$i];
//            $post->save();
//        }

        // Save to Block
//        $post                   = new AssignActivityModel();
//        $post->department      = $request->department;
//        $post->course_name      = $request->course_name;
//        $post->morning_session      = $request->status1;
//        $post->evening_night_other_duty      = $request->status2;
//        $post->operation_room_duty      = $request->status3;
//        $post->practical_work      = $request->status4;
//        $post->departmental_meeting      = $request->status5;
//        $post->radiology_round      = $request->status6;
//        $post->clinical_pathological_meetings      = $request->status7;
//        $post->laboratory_serviceork      = $request->status8;
//        $post->journal_presentation      = $request->status9;
//        $post->morbidity_mortality_review_meetings      = $request->status10;
//        $post->slide_presentation      = $request->status11;
//        $post->journal_club      = $request->status12;
//        $post->literature_review_and_presentation      = $request->status13;
//        $post->slide_seminars      = $request->status14;
//        $post->surgical_audit_meeting      = $request->status15;
//        $post->case_presentation      = $request->status16;
//        $post->assignments      = $request->status17;
//        $post->research_meeting      = $request->status18;
//        $post->in_patient_duty      = $request->status19;
//        $post->ward_round      = $request->status20;
//        $post->trauma_audit_meeting      = $request->status21;
//        $post->out_patient_duty      = $request->status22;
//        $post->icu_round      = $request->status23;
//        $post->specialty_clinics      = $request->status24;
//        $post->conference_seminar      = $request->status25;
//        $post->pre_theater_and_theater_training      = $request->status26;
//        $post->active_status    = 1;
//        $post->save();
    }

    /**
     * This method use for update block information
     * @param Request $request
     *
     */
    public static function updateAssignActivity($request){

        if($request->department==''){
            echo 'Blank Info';
            exit;
        }
        $id = $request->assign_activity_id;
        if(!empty($id) && $post = AssignActivityModel::find($id)){
            $activityId = $request->activity_id;
            $activityCount = count($activityId);
            for($i = 0; $i<$activityCount; $i++){
                $post->department      = $request->department;
                $post->course_name      = $request->course_name;
                $post->activity_id      = $activityId[$i];
                $post->save();
            }
//            $post->department      = $request->department;
//            $post->course_name      = $request->course_name;
//            $post->morning_session      = $request->morning_session;
//            $post->evening_night_other_duty      = $request->evening_night_other_duty;
//            $post->operation_room_duty      = $request->operation_room_duty;
//            $post->practical_work      = $request->practical_work;
//            $post->departmental_meeting      = $request->departmental_meeting;
//            $post->radiology_round      = $request->radiology_round;
//            $post->clinical_pathological_meetings      = $request->clinical_pathological_meetings;
//            $post->laboratory_serviceork      = $request->laboratory_serviceork;
//            $post->journal_presentation      = $request->journal_presentation;
//            $post->morbidity_mortality_review_meetings      = $request->morbidity_mortality_review_meetings;
//            $post->slide_presentation      = $request->slide_presentation;
//            $post->journal_club      = $request->journal_club;
//            $post->literature_review_and_presentation      = $request->literature_review_and_presentation;
//            $post->slide_seminars      = $request->slide_seminars;
//            $post->surgical_audit_meeting      = $request->surgical_audit_meeting;
//            $post->case_presentation      = $request->case_presentation;
//            $post->assignments      = $request->assignments;
//            $post->research_meeting      = $request->research_meeting;
//            $post->in_patient_duty      = $request->in_patient_duty;
//            $post->ward_round      = $request->ward_round;
//            $post->trauma_audit_meeting      = $request->trauma_audit_meeting;
//            $post->out_patient_duty      = $request->out_patient_duty;
//            $post->icu_round      = $request->icu_round;
//            $post->specialty_clinics      = $request->specialty_clinics;
//            $post->conference_seminar      = $request->conference_seminar;
//            $post->pre_theater_and_theater_training      = $request->pre_theater_and_theater_training;
//            $post->active_status    = $request->active_status;
//            $post->save();

        }
    }


}
