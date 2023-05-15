<?php

namespace App\Models\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicCalendarSetupModel extends Model
{
    use HasFactory;

    protected $table = 'set_academic_calendar';
    
    /**
     * For creating academic calendar information
     * @param Request $request
     * 
     */
    public static function storeAcademicCalendarSetup($request){

        if($request->event_type==''){
            echo 'Blank Info';
            exit;
        }
        
        $post                   = new AcademicCalendarSetupModel();
        $post->event_type       = $request->event_type;
        $post->course_type      =$request->course_type;
        $post->topic            = $request->topic;
        $post->title            = $request->title;
        $post->department       = $request->department;
        $post->course_name      = $request->course_name;
        $post->batch            = $request->batch;
        $post->color            = $request->color;
        $post->start            = ($request->start)? date('Y-m-d', strtotime($request->start)):null;
       // $post->end              = ($request->end)? date('Y-m-d', strtotime($request->end)):null;
        $post->end              = ($request->end)? date('Y-m-d', strtotime("+1 day",strtotime($request->end))):null;
        $post->active_status    = $request->active_status;
        $post->save();
    }

    /**
     * For updating academic calendar information
     * @param Request $request
     * 
     */
    public static function updateAcademicCalendarSetup($request){

        if($request->event_type==''){
            echo 'Blank Info';
            exit;
        }
        $id = $request->id;
        if(!empty($id) && $post = AcademicCalendarSetupModel::find($id)){
            
            $post->event_type       = $request->event_type;
            $post->course_type      =$request->course_type;
            $post->topic            = $request->topic;
            $post->title            = $request->title;
            $post->department       = $request->department;
            $post->course_name      = $request->course_name;
            $post->batch            = $request->batch;
            $post->color            = $request->color;
            $post->start            = ($request->start)? date('Y-m-d', strtotime($request->start)):null;
            $post->end              = ($request->end)? date('Y-m-d', strtotime($request->end)):null;
            $post->active_status    = $request->active_status;            
            $post->save();

        }
        
    }
}
