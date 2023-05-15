<?php

namespace App\Http\Controllers\support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\SupportModuleSetupModel;
use  App\Models\lookup\LookupGroupDataModel;
use DB;
use Auth;

class SupportModuleSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Module',
            'tableTitle' => 'Module List'
        );

        $results = DB::table('npoly_support_modules as mod')
            ->leftJoin('sa_lookup_data as lkp', 'lkp.LOOKUP_DATA_ID', '=', 'mod.department_id')
            ->select('mod.*','lkp.LOOKUP_DATA_NAME as deptName')
            ->orderBy('module_id','desc')
            ->get();

        return view('setup/support_module.index',compact('header','results'));
    }

    /**
     * Create class routine form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle' => 'Project',
            'tableTitle' => 'Project List'
        );

        $department = DB::table('sa_lookup_data')
            ->select('LOOKUP_DATA_ID','LOOKUP_DATA_NAME')
            ->where('LOOKUP_GRP_ID',5)
            ->where('ACTIVE_FLAG',1)
            ->get();

        return view('setup/support_module.create', compact('header','department'));
    }

    /* save class routine
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        SupportModuleSetupModel::createModule($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('supportModuleIndex');
    }

    /* class routine update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle' => 'Module',
            'tableTitle' => 'Module List'
        );
        $department = DB::table('sa_lookup_data')
            ->select('LOOKUP_DATA_ID','LOOKUP_DATA_NAME')
            ->where('LOOKUP_GRP_ID',5)
            ->where('ACTIVE_FLAG',1)
            ->get();
        $result = SupportModuleSetupModel::find($id);
        return view('setup/support_module.update', compact('header', 'result','department'));

    }

    /* class routine update action
     * @param $request
     *
     */
    public function update(Request $request)
    {
        SupportModuleSetupModel::updateModule($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('supportModuleIndex');
    }

    /* get day of date
     * @param $date
     *
     */
    public function getDay($date=null)
    {
        if($date)
            return date('l', strtotime($date));
        else
            return '';

    }

}
