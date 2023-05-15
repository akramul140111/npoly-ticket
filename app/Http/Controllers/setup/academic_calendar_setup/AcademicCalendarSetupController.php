<?php

namespace App\Http\Controllers\setup\academic_calendar_setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\setup\AcademicCalendarSetupModel;
use DB;

class AcademicCalendarSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Academic Calendar Setup',
            'tableTitle' => 'Academic Calendar List'

        );
        $results = DB::table('set_academic_calendar')
                    ->select('set_academic_calendar.id as calenderId','set_academic_calendar.title as calendarTitile','set_academic_calendar.start','set_academic_calendar.end','set_activity_setup.*','set_topic_chd.*','sa_lookup_data.*')
                    ->leftJoin('set_activity_setup','set_academic_calendar.event_type','=', 'set_activity_setup.activity_id')
                    ->leftJoin('set_topic_chd','set_academic_calendar.topic','=','set_topic_chd.id')
                    ->leftJoin('sa_lookup_data','set_academic_calendar.department','=','sa_lookup_data.LOOKUP_DATA_ID')
                    ->orderBy('set_academic_calendar.id', 'desc')->get();
                    //  print_r($results);exit;
        return view('setup.academic_calendar.index',compact('header','results'));
    }
    /**
     * Create academic calendar setup form
     * @param None
     * 
     */  
    public function create()
    {       
        $header = array(
            'pageTitle'  => 'Academic Calendar Management',
            'tableTitle' => 'Academic Calendar Management List'

        );

        $departments = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 3)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $courseNames = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 5)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $batches = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 7)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $activitys = DB::table('set_activity_setup')
                ->where('set_activity_setup.active_status', 1)
                ->get();  
        $topics = DB::table('set_topic_chd')
        ->where('set_topic_chd.active_status', 1)
        ->get();  

        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get(); 
        
        return view('setup.academic_calendar.create', compact('header', 'departments', 'courseNames', 'batches','activitys','topics','courseTypes'));
    }

    /* save academic calendar information
     * @param Request $request
     * 
     */ 
    public function store(Request $request)
    {
        AcademicCalendarSetupModel::storeAcademicCalendarSetup($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('academicCalendarSetup');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /* academic calendar information update page
     * @param $id
     * 
     */ 
    public function edit($id)
    { 
        $header = array(
            'pageTitle'  => 'Academic Calendar Management',
            'tableTitle' => 'Academic Calendar Management List'

        );

        $departments = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 3)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $courseNames = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 5)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $batches = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 7)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $activitys = DB::table('set_activity_setup')
                ->where('set_activity_setup.active_status', 1)
                ->get();  
        $topics = DB::table('set_topic_chd')
        ->where('set_topic_chd.active_status', 1)
        ->get();  
        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get(); 

        $result = DB::table('set_academic_calendar')->where('id', $id)->first();  
        return view('setup.academic_calendar.update', compact('header', 'result', 'departments', 'courseNames', 'batches','activitys','topics','courseTypes'));

    }
    /* academic calendar information update action
     * @param $request
     * 
     */ 
    public function update(Request $request)
    {
        AcademicCalendarSetupModel::updateAcademicCalendarSetup($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('academicCalendarSetup');
    }

    /* inactive/inactive academic calendar activity
     * @param $id, $status
     * 
     */ 
    public function activeInactiveEvent($id=null,$status=null)
    {
        $calendar = AcademicCalendarSetupModel::find($id);
        if($status){
            $calendar->active_status = 1;
            $calendar->save();
            Session::flash('success', 'Event activated successfully!');
        }else{
            $calendar->active_status = 0;
            $calendar->save();
            Session::flash('success', 'Event inactivated successfully!');
        }
        return redirect()->route('academicCalendarSetup');
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


    public function checkDuplicate($event_type=null, $event_topic=null, $name=null, $dept=null,$batch=null,$course_type=null)
    {
        $data = 0;
        if(!empty($event_type) && !empty($event_topic) && !empty($name) && !empty($dept) && !empty($batch) && !empty($course_type)){

            $results = DB::table('set_academic_calendar as acd')
                ->where('acd.event_type', '=',$event_type)
                ->where('acd.topic', '=',$event_topic)
                ->where('acd.course_name', '=',$name)
                ->where('acd.department', '=',$dept)
                ->where('acd.batch', '=',$batch)
                ->where('acd.batch', '=',$course_type)
                ->get();
            if(count($results) > 0){
                $data = count($results);
            }

        }
        return $data;

    }
}
