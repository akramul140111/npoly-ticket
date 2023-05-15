<?php

namespace App\Http\Controllers\support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\EmployeeModel;
use  App\Models\lookup\LookupGroupDataModel;
use DB;
use Auth;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Employee List',
            'tableTitle' => ''
        );

        $results = DB::table('npoly_employees as emp')
            ->leftJoin('sa_lookup_data as lkp', 'lkp.LOOKUP_DATA_ID', '=', 'emp.department_id')
            ->leftJoin('sa_lookup_data as lkp1', 'lkp1.LOOKUP_DATA_ID', '=', 'emp.designation_id')
            ->select('emp.*','lkp.LOOKUP_DATA_NAME as department_name','lkp1.LOOKUP_DATA_NAME as designation_name')
            ->orderBy('emp.user_serial_no','asc')
            ->get();

        return view('employee.index',compact('header','results'));
    }

    /**
     * Create class routine form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle' => 'Emaployee',
            'tableTitle' => ''
        );
        $gender = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',2)
            ->get();
        $maritalStatus = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',11)
            ->get();
        $religion  = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',1)
            ->get();

        $department = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',5)
            ->get();
        $designation = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',34)
            ->get();

        return view('employee.create', compact('header','department','designation','gender','maritalStatus','religion'));
    }

    /* save class routine
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        EmployeeModel::createEmployee($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('allEmployeeIndex');
    }

    /* class routine update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle' => 'Employee List',
            'tableTitle' => ''
        );
        $gender = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',2)
            ->get();
        $maritalStatus = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',11)
            ->get();
        $religion  = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',1)
            ->get();

        $department = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',5)
            ->get();
        $designation = DB::table('sa_lookup_data')
            ->select('lookup_data_id','lookup_data_name')
            ->where('lookup_grp_id',34)
            ->get();
        $result = EmployeeModel::find($id);
        return view('employee.update', compact('header', 'result','gender','maritalStatus','religion','department','designation'));

    }

    /* class routine update action
     * @param $request
     *
     */
    public function update(Request $request)
    {
        EmployeeModel::updateEmployee($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('allEmployeeIndex');
    }

    /* get day of date
     * @param $date
     *
     */

}
