<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class ProjectSetupModel extends Model
{
    use HasFactory;
    protected $table = 'npoly_projects';
    protected $primaryKey = 'project_id';

    /**
     * This method use for save class routine
     * @param Request $request
     *
     */
    public static function createProject($request){
        $clientData = array(
            "client_id"          => $request->client_id,
            "project_name"        => $request->project_name,
            "project_abbr"    => $request->project_abbr,
            "project_status"        => $request->project_status,
            "project_start_dt"          => date('d-m-y'),
            'active_status'          => 1,
            "created_by"        => Auth::user()->id,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('npoly_projects')->insert($clientData);
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
    public static function updateProject($request){


        $id = $request->project_id;


        if($id && DB::table('npoly_projects')->where('project_id', $id)->first()){
            $projectData = array(
                "client_id"          => $request->client_id,
                "project_name"        => $request->project_name,
                "project_abbr"    => $request->project_abbr,
                "project_status"        => $request->project_status,
                "project_start_dt"          => date('d-m-y'),
                "active_status"          => $request->active_status,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_projects')
                    ->where('project_id', $id)
                    ->update($projectData);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }

}
