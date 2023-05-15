<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class ClientSetupModel extends Model
{
    use HasFactory;
    protected $table = 'npoly_clients';
    protected $primaryKey = 'client_id';

    /**
     * This method use for save class routine
     * @param Request $request
     *
     */
    public static function createClient($request){
        $clientData = array(
            "client_id"          => $request->client_id,
            "client_name"        => $request->client_name,
            "client_abbr"    => $request->client_abbr,
            "client_addr"        => $request->client_addr,
            "client_phone"          => $request->client_phone,
            'client_email'          => $request->client_email,
            "created_by"        => Auth::user()->id,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('npoly_clients')->insert($clientData);
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
    public static function updateClient($request){


        $id = $request->client_id;


        if($id && DB::table('npoly_clients')->where('client_id', $id)->first()){
            $clientData = array(
                "client_id"          => $request->client_id,
                "client_name"        => $request->client_name,
                "client_abbr"    => $request->client_abbr,
                "client_addr"        => $request->client_addr,
                "client_phone"          => $request->client_phone,
                'client_email'          => $request->client_email,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_clients')
                    ->where('client_id', $id)
                    ->update($clientData);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }

}
