<?php

namespace App\Models\admin_portal;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityEventModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'activity_id';
    protected $table = 'set_activity_setup';

    /**
     * This method use for save block information
     * @param Request $request
     *
     */
    public static function createActivityEvent($request){

        if($request->activity_name==''){
            echo 'Blank Info';
            exit;
        }

        // Save to Block
        $post                   = new ActivityEventModel();
        $post->activity_name      = $request->activity_name;
        $post->descripton      = $request->descripton;
        $post->active_status    = $request->active_status;
        $post->save();
    }

    /**
     * This method use for update block information
     * @param Request $request
     *
     */
    public static function updateActivityEvent($request){

        if($request->activity_name==''){
            echo 'Blank Info';
            exit;
        }
        $id = $request->activity_id;

        if(!empty($id) && $post = ActivityEventModel::find($id)){
            $post->activity_name      = $request->activity_name;
            $post->descripton      = $request->descripton;
            $post->active_status    = $request->active_status;
            $post->save();

        }
    }


}
