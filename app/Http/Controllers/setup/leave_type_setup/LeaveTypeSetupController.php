<?php

namespace App\Http\Controllers\setup\leave_type_setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\setup\LeaveTypeSetupModel;
use App\Models\lookup\LookupGroupDataModel;
use Session;
use DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LeaveTypeSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $header=array(

            'pageTitle' => 'Setup Type',
            'tableTitle' => 'Leave Type List'
            );
            $leaveTypes=LeaveTypeSetupModel::leftJoin('sa_lookup_data','set_leave.leave_type_id','sa_lookup_data.LOOKUP_DATA_ID',)
            ->select('sa_lookup_data.LOOKUP_DATA_NAME as leaveTypeName','set_leave.*')->orderBy('id', 'DESC')->get();

            return view('setup.leave_type.index', compact('header','leaveTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $leaveTypes=LookupGroupDataModel::where('LOOKUP_GRP_ID',18)->get();
        return view('setup.leave_type.create',compact('leaveTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leaveTypeSetup=new LeaveTypeSetupModel();
        $leaveTypeSetup->number_of_days=$request->number_of_days;
        $leaveTypeSetup->leave_type_id=$request->leaveType;
        $leaveTypeSetup->description=$request->description;
        $leaveTypeSetup->org_id=1;
        $leaveTypeSetup->active_status=$request->active_status;
        $leaveTypeSetup->created_by=Auth::user()->id;
        $leaveTypeSetup->save();
       Session::flash('success', "Data Save Successfully");
       return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $leaveTypes=LookupGroupDataModel::where('LOOKUP_GRP_ID',18)->get();

        $leaveTypeSetup=LeaveTypeSetupModel::where('id',$id)->first();

       return view('setup.leave_type.edit',compact('leaveTypes','leaveTypeSetup'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $leaveTypeSetup=LeaveTypeSetupModel::find($id);
        $leaveTypeSetup->number_of_days=$request->number_of_days;
        $leaveTypeSetup->leave_type_id=$request->leaveType;
        $leaveTypeSetup->description=$request->description;
        $leaveTypeSetup->org_id=1;
        $leaveTypeSetup->active_status=$request->active_status;
        $leaveTypeSetup->updated_by=Auth::user()->id;

        $leaveTypeSetup->save();
       Session::flash('success', "Data Update Successfully");
       return redirect()->route('leaveTypeSetup');
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
