<?php

namespace App\Http\Controllers\admin_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\admin_portal\ActivityEventModel;
use DB;
class ActivityEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle'  => 'Activity/Event Setup',
            'tableTitle' => 'Activity/Event List'
        );
        $results = DB::table('set_activity_setup')->select('*')->get();

        return view('admin_portal.activity_event_setup.index', compact('header','results'));
    }

    /**
     * This method use for create block form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle'  => 'Activity/Event Setup',
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
        ActivityEventModel::createActivityEvent($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('activity_event');
    }

    /* block view
     * @param $id
     *
     */
    public function show($id)
    {
        $header = array(
            'pageTitle'  => 'Activity/Event Setup',
            'tableTitle' => 'Activity/Event List'
        );

        $activityEventInfo = ActivityEventModel::find($id);

        return view('admin_portal.activity_event_setup.view', compact('header', 'activityEventInfo'));
    }
    public function viewActivity($id){
        $header = array(
            'pageTitle'  => 'Activity/Event Setup',
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
            'pageTitle'  => 'Block Management',
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
        ActivityEventModel::updateActivityEvent($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('activity_event');
    }

    /* delete sub block
     * @param $id
     *
     */
    public function deleteSubBlock($id)
    {
        if($id){
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
        if($id){
            $topics = BlockTopicsModel::find($id);
            $topics->delete();
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
}
