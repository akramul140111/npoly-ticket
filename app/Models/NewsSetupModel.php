<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class NewsSetupModel extends Model
{
    use HasFactory;
    protected $table = 'npoly_support_news';
    protected $primaryKey = 'news_id';

    /**
     * This method use for save class routine
     * @param Request $request
     *
     */
    public static function createNews($request){

        if($request->file('image')){
            $file = $request->file('image');

            if($file->getClientOriginalExtension()==''){
                Session::flash('error', 'File is invalid');
                return redirect()->route('student_money_receipt');
            }else{

                $name = date('Ymd').mt_rand(1000,9999).'.'.$file->getClientOriginalExtension();
                $exten = $file->getClientOriginalExtension();
                if($exten == "docx" || $exten == "xlsx" || $exten == "doc" || $exten == "pdf" || $exten == "bmp" || $exten == "zip" ){
                    $file->move(public_path() . '/uploads/news_image/', $name);
                }else{
                    $file->move(public_path() . '/uploads/news_image/', $name);

                    // $resizedImage = Image::make(public_path() . '/uploads/' . $name)->resize(300, null, function ($constraint) {
                    //     $constraint->aspectRatio();
                    // });
                    // save file as jpg with medium quality
                    // $resizedImage->save(public_path() . '/uploads/' . $name, 60);

                }
            }

        }
        $newsData = array(
            "news_title"          => $request->news_title,
            "news_desc"        => $request->editor1,
            "news_image"    => !empty($name)?$name:"",
            "created_by"        => Auth::user()->id,
            "created_at"        => date('Y-m-d H:i:s'),
        );

        DB::beginTransaction();
        try {
            $data = DB::table('npoly_support_news')->insert($newsData);
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
    public static function updateNews($request){


        $id = $request->news_id;


        if($request->file('image')){
            $file = $request->file('image');

            if($file->getClientOriginalExtension()==''){
                Session::flash('error', 'File is invalid');
                return redirect()->route('student_money_receipt');
            }else{

                $name = date('Ymd').mt_rand(1000,9999).'.'.$file->getClientOriginalExtension();
                $exten = $file->getClientOriginalExtension();
                if($exten == "docx" || $exten == "xlsx" || $exten == "doc" || $exten == "pdf" || $exten == "bmp" || $exten == "zip" ){
                    $file->move(public_path() . '/uploads/news_image/', $name);
                }else{
                    $file->move(public_path() . '/uploads/news_image/', $name);
                }
            }

        }


        if($id){
            $previousInfo = DB::table('npoly_support_news')->where('news_id', $id)->first();
            $newsData = array(
                "news_title"        => $request->news_title,
                "news_desc"         => $request->news_desc,
                "active_status"         => $request->active_status,
                "news_image"        => !empty($name)?$name:$previousInfo->news_image,
                "updated_by"        => Auth::user()->id,
                "updated_at"        => date('Y-m-d H:i:s'),
            );

            DB::beginTransaction();
            try {
                DB::table('npoly_support_news')
                    ->where('news_id', $id)
                    ->update($newsData);

                DB::commit();
            } catch (\Throwable $e) {
                DB::rollback();
                throw $e;
            }

        }

    }

}
