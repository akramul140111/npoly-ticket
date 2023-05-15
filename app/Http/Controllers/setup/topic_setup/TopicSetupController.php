<?php

namespace App\Http\Controllers\setup\topic_setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\setup\TopicSetupModel;
use DB;

class TopicSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Topic Setup',
            'tableTitle' => 'Topic Setup List'

        );

        $results = DB::table('set_topic_mst as dt1')
            ->leftJoin('sa_lookup_data as dt2', 'dt1.course_type', '=', 'dt2.LOOKUP_DATA_ID') 
            ->leftJoin('sa_lookup_data as dt3', 'dt1.course_name', '=', 'dt3.LOOKUP_DATA_ID') 
            ->leftJoin('sa_lookup_data as dt4', 'dt1.department', '=', 'dt4.LOOKUP_DATA_ID') 
            ->leftJoin('sa_lookup_data as dt5', 'dt1.phase', '=', 'dt5.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt6', 'dt1.topic_type', '=', 'dt6.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as dt7', 'dt1.year', '=', 'dt7.LOOKUP_DATA_ID')
            ->select('dt1.*','dt2.LOOKUP_DATA_NAME AS COURSE_TYPE','dt3.LOOKUP_DATA_NAME AS COURSE_NAME','dt4.LOOKUP_DATA_NAME AS DEPARTMENT','dt5.LOOKUP_DATA_NAME AS PHASE','dt6.LOOKUP_DATA_NAME AS TOPIC_TYPE','dt7.LOOKUP_DATA_NAME AS YEARS')
            ->orderBy('dt1.id','desc')
            ->get();

        return view('setup.topic.index',compact('header','results'));
    }

    /**
     * Create topic setup form
     * @param None
     * 
     */  
    public function create()
    {       
        $header = array(
            'pageTitle' => 'Topic Setup',
            'tableTitle' => 'Topic Setup List'

        );

        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $courseNames = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 5)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $departments = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 3)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();
        
        $phases = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 8)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $topicTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 24)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $years = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 25)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();
        
        return view('setup.topic.create', compact('header', 'courseTypes', 'courseNames', 'departments', 'phases', 'topicTypes', 'years'));
    }

    /* save topic setup information
     * @param Request $request
     * 
     */ 
    public function store(Request $request)
    {
        TopicSetupModel::createTopicSetup($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('topicSetup');    
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

    /* topic setup update page
     * @param $id
     * 
     */ 
    public function edit($id)
    { 
        $header = array(
            'pageTitle' => 'Topic Setup',
            'tableTitle' => 'Topic Setup List'

        );

        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $courseNames = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 5)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $departments = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 3)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();
        
        $phases = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 8)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $topicTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 24)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $years = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 25)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->where('s.ACTIVE_FLAG', 1)
        ->get();

        $result = TopicSetupModel::find($id);
        return view('setup.topic.update', compact('header', 'result', 'courseTypes', 'courseNames', 'departments', 'phases', 'topicTypes', 'years'));

    }

    /* topic setup update action
     * @param $request
     * 
     */ 
    public function update(Request $request)
    {
        TopicSetupModel::updateTopicSetup($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('topicSetup');
    }

    /* delete topic setup
     * @param $id
     * 
     */ 
    public function deleteTopics($id)
    {
        if($id){
            DB::table('set_topic_chd')->delete($id);
            echo 1;
        }
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

    /* check duplicate topic
     * @param $type, $name, $dept, $phase
     * 
     */ 
    public function checkDuplicateTopic($type=null, $name=null, $phase=null, $year=null, $topic_type=null)
    {
        $data = 0;
        if(!empty($type) && !empty($name) && !empty($phase) && !empty($year) && !empty($topic_type)){

            $results = DB::table('set_topic_mst as dt1')
            ->where('dt1.course_type', '=',$type)
            ->where('dt1.course_name', '=',$name)
            ->where('dt1.phase', '=',$phase)
            ->where('dt1.year', '=',$year)
            ->where('dt1.topic_type', '=',$topic_type)
            ->get();
            if(count($results) > 0){
                $data = count($results);
            }
            
        }
        return $data;

    }
}
