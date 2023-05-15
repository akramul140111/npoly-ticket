<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class SupportModuleSetupModel extends Model
{
    use HasFactory;
    protected $table = 'npoly_support_modules';
    protected $primaryKey = 'module_id';

    /**
     * This method use for save class routine
     * @param Request $request
     *
     */
    public static function createModule($request){
        $clientData = array(
            "department_id"          => $request->department_id,
            "module_name"        => $request->module_name,
            'active_status'          => 1,
            "created_by"        => Auth::user()->id,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('npoly_support_modules')->insert($clientData);
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
    public static function updateModule($request){


        $id = $request->module_id;


        if($id && DB::table('npoly_support_modules')->where('module_id', $id)->first()){
            $moduleData = array(
                "department_id"          => $request->department_id,
                "module_name"        => $request->module_name,
                "active_status"          => $request->active_status,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_support_modules')
                    ->where('module_id', $id)
                    ->update($moduleData);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }

}
