<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class EmployeeModel extends Model
{
    use HasFactory;
    protected $table = 'npoly_employees';
    protected $primaryKey = 'employee_id';

    /**
     * This method use for save class routine
     * @param Request $request
     *
     */
    public static function createEmployee($request){
        $employeeData = array(
            "employee_name"     => $request->employee_name,
            "email"             => $request->office_email,
            "department_id"     => $request->department_id,
            "designation_id"    => $request->designation_id,
            "card_no"           => $request->card_no,
            'gender'            => $request->gender,
            'religion'          => $request->religion,
            'marital_status'    => $request->marital_status,
            'office_email'      => $request->office_email,
            'mobile_no'         => $request->mobile_no,
            'national_id'       => $request->national_id,
            'date_of_birth'     => !empty($request->date_of_birth)?date('Y-m-d',strtotime($request->date_of_birth)):'',
            'hire_date'         => !empty($request->hire_date)?date('Y-m-d',strtotime($request->hire_date)):'',
            "created_by"        => Auth::user()->id,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('npoly_employees')->insert($employeeData);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
            exit;
        }

    }

    /**
     * This method use for update class routine
     * @param Request $request
     *
     */
    public static function updateEmployee($request){


        $id = $request->employee_id;


        if($id && DB::table('npoly_employees')->where('employee_id', $id)->first()){
            $employeeData = array(
                "employee_name"     => $request->employee_name,
                "email"             => $request->office_email,
                "department_id"     => $request->department_id,
                "designation_id"    => $request->designation_id,
                "card_no"           => $request->card_no,
                'gender'            => $request->gender,
                'religion'          => $request->religion,
                'marital_status'    => $request->marital_status,
                'office_email'      => $request->office_email,
                'mobile_no'         => $request->mobile_no,
                'national_id'       => $request->national_id,
                'date_of_birth'     => !empty($request->date_of_birth)?date('Y-m-d',strtotime($request->date_of_birth)):'',
                'hire_date'         => !empty($request->hire_date)?date('Y-m-d',strtotime($request->hire_date)):'',
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_employees')
                    ->where('employee_id', $id)
                    ->update($employeeData);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }

}
