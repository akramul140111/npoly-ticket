<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;
use Auth;

class CommonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmployeeInfo(Request $request){
        $empId = $request->empId;
        $employee = DB::table('npoly_employees as emp')
            ->leftJoin('sa_lookup_data as lkp','emp.department_id','=','lkp.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as lkp1','emp.designation_id','=','lkp1.LOOKUP_DATA_ID')
            ->select('emp.employee_id','emp.employee_name','emp.department_id','emp.designation_id','lkp.LOOKUP_DATA_NAME as department_name','lkp1.LOOKUP_DATA_NAME as designation_name')
            ->where('emp.active_status',1)
            ->where('emp.employee_id',$empId)
            ->first();
        return $employee;
    }

}
