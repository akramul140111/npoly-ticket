<?php

namespace App\Http\Controllers\admin_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\admin_portal\AssignActivityModel;
use App\Models\admin_portal\ActivityEventModelModel;
use DB;

class AssignActivityController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Assign Activity Setup',
            'tableTitle' => 'Assign Activity List'
        );

        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->where('s.ACTIVE_FLAG', 1)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->get();

        $courseNames = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 5)
            ->where('s.ACTIVE_FLAG', 1)
            ->select('s.LOOKUP_DATA_ID', 's.LOOKUP_DATA_NAME')
            ->get();

        $departments = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 3)
            ->where('s.ACTIVE_FLAG', 1)
            ->select('s.LOOKUP_DATA_ID', 's.LOOKUP_DATA_NAME')
            ->get();

        $activityInof = DB::table('set_activity_setup')->select('*')->get();


        return view('admin_portal.assign_activity.index', compact('header', 'courseTypes', 'courseNames', 'departments', 'activityInof'));
    }

    /**
     * This method use for create block form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle' => 'Activity/Event Setup',
            'tableTitle' => 'Activity/Event List'
        );
        return view('admin_portal.activity_event_setup.create', compact('header'));
    }

    /* save block information
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        //dd($_POST);exit();
        AssignActivityModel::storeAssignActivity($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('assign_activity');
    }

    /* block view
     * @param $id
     *
     */
    public function show($id)
    {
        $header = array(
            'pageTitle' => 'Activity/Event Setup',
            'tableTitle' => 'Activity/Event List'
        );

        $activityEventInfo = ActivityEventModel::find($id);

        return view('admin_portal.activity_event_setup.view', compact('header', 'activityEventInfo'));
    }

    /* block update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle' => 'Block Management',
            'tableTitle' => 'Block Management List'
        );

        $activityEventInfo = ActivityEventModel::find($id);
        return view('admin_portal.activity_event_setup.update', compact('header', 'activityEventInfo'));
    }

    /* block update action
     * @param $request
     *
     */
    public function update(Request $request)
    {
        //dd($_POST);
        AssignActivityModel::updateAssignActivity($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('assign_activity');
    }

    /* delete sub block
     * @param $id
     *
     */
    public function deleteSubBlock($id)
    {
        if ($id) {
            $subBlock = SubBlockModel::find($id);
            $subBlock->delete();
            echo 1;
        }
    }

    /* delete block topics
     * @param $id
     *
     */
    public function deleteTopics($id)
    {
        if ($id) {
            $topics = BlockTopicsModel::find($id);
            $topics->delete();
            echo 1;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getAssignActivity()
    {
        $type = $_POST['type'];
        $dept = $_POST['dept'];
        $course = $_POST['course'];
        $assignActivityInfo = DB::table("set_assign_activity")
            ->select("*")
            ->where('course_type', $type)
            ->where('department', $dept)
            ->where('course_name', $course)
            ->get();
        $activityInof = DB::table('set_activity_setup')->select('*')->get();

        return view("admin_portal.assign_activity.set_assign_activity", compact('type','dept', 'course', 'activityInof', 'assignActivityInfo'));


    }

    public function asignActivitiesStatus(Request $request)
    {
        $activeStatus = $request->input('activeStatus');
        $department = $request->input('department');
        $courseName = $request->input('courseName');

        DB::table('set_assign_activity')->insert([
            'department' => $department,
            'course_name' => $courseName,
            'activity_id' => $activeStatus,
            'active_status'=> 1,
        ]);

    }

}
