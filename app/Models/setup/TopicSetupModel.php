<?php

namespace App\Models\setup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class TopicSetupModel extends Model
{
    use HasFactory;
    protected $table = 'set_topic_mst';

    /**
     * This method use for save topic setup information
     * @param Request $request
     *
     */
    public static function createTopicSetup($request){

        if($request->course_type==''){
            echo 'Blank Info';
            exit;
        }

        $topicSetup = array(
            "block_id"          => $request->block_id,
            "course_type"       => $request->course_type,
            "course_name"       => $request->course_name,
            "department"        => $request->department,
            "phase"             => $request->phase,
            "year"              => $request->year,
            "topic_type"        => $request->topic_type,
            "active_status"     => $request->active_status,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('set_topic_mst')->insertGetId($topicSetup);

            $item = $request->topics;
            if(sizeof($item) > 0){
                for ($i=0; $i < sizeof($item); $i++) {
                    $topicChd = array(
                        "topic_id"       => $data,
                        "course_type"       => $request->course_type,
                        "course_name"       => $request->course_name,
                        "department_id"        => $request->department,
                        "topic"          => $item[$i],
                        "active_status"     => 1,
                        "created_at"        => date('Y-m-d H:i:s'),
                    );
                    DB::table('set_topic_chd')->insert($topicChd);
                }
            }
            DB::commit();
            return true;
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
    public static function updateTopicSetup($request){

        if($request->course_type==''){
            echo 'Blank Info';
            exit;
        }
        $id = $request->topic_id;

        if($id && DB::table('set_topic_mst')->where('id', $id)->first()){
            $topicSetup = array(
                "course_type"       => $request->course_type,
                "course_name"       => $request->course_name,
                "department"        => $request->department,
                "phase"             => $request->phase,
                "year"              => $request->year,
                "topic_type"        => $request->topic_type,
                "active_status"     => $request->active_status,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('set_topic_mst')
                    ->where('id', $id)
                    ->update($topicSetup);

                // Save Topics Chd
                $item = $request->topics;
                if(sizeof($item) > 0){
                    $TOPIC_CHD_ID = $request->topic_chd_id;
                    for($re=0; $re < sizeof($item); $re++){
                        if($TOPIC_CHD_ID[$re] > 0){
                            // Update topics
                            $data_param = array(
                                'topic'         => $item[$re],
                                "course_type"       => $request->course_type,
                                "course_name"       => $request->course_name,
                                "department_id"        => $request->department,
                                'updated_at'    => date('Y-m-d H:i:s')
                            );
                            DB::table('set_topic_chd')
                              ->where('id', $TOPIC_CHD_ID[$re])
                              ->update($data_param);

                        }else{
                            // Insert to topics
                            $data_param2 = array(
                                "topic_id"          => $id,
                                "course_type"       => $request->course_type,
                                "course_name"       => $request->course_name,
                                "department_id"        => $request->department,
                                "topic"             => $item[$re],
                                "active_status"     => 1,
                                "created_at"        => date('Y-m-d H:i:s'),
                            );
                            DB::table('set_topic_chd')->insert($data_param2);
                        }


                    }
                }
                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                //throw $e;
            }

        }

    }

}
