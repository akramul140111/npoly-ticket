<?php

namespace App\Models\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class ClassRoomSetupModel extends Model
{
    use HasFactory;
    protected $table = 'set_class_room';
    
    /**
     * This method use for save topic setup information
     * @param Request $request
     * 
     */
    public static function createClassRoomSetup($request){

        if($request->course_type==''){
            echo 'Blank Info';
            exit;
        }
        
        $classData = array(
            "course_type"       => $request->course_type,
            "course_name"       => $request->course_name,
            "department"        => $request->department,
            "room_no"           => $request->room_no,
            "description"       => $request->description,
            "active_status"     => $request->active_status,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('set_class_room')->insert($classData);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollback();
            //throw $e;
        }

    }    

    /**
     * This method use for update topic setup information
     * @param Request $request
     * 
     */
    public static function updateClassRoomSetup($request){

        if($request->course_type==''){
            echo 'Blank Info';
            exit;
        }
        $id = $request->class_room_id;

        if($id && DB::table('set_class_room')->where('id', $id)->first()){            
            $classData = array(
                "course_type"       => $request->course_type,
                "course_name"       => $request->course_name,
                "department"        => $request->department,
                "room_no"           => $request->room_no,
                "description"       => $request->description,
                "active_status"     => $request->active_status,
                "updated_at"        => date('Y-m-d H:i:s'),
            );
            
            DB::beginTransaction();
            try {
                DB::table('set_class_room')
                    ->where('id', $id)
                    ->update($classData);
                                
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                //throw $e;
            }            

        }
        
    }

}
