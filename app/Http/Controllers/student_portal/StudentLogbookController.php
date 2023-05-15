<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\students_panel\StudentLogbookModel;
use DB;
use Auth;
use Validator,Redirect,Response,File;

use Image;
class StudentLogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle'  => 'Logbook Attachment',
            'tableTitle' => 'Logbook Attachment List'
        );
        $results = DB::table('stu_log_book')->select('*')
            ->where('stu_log_book.student_id',Auth::user()->student_id)
            ->orderBy('log_book_id', 'desc')->get();

        // $results = DB::table('stu_log_book as s')
        //     //->select('*')
        //     ->leftJoin('tea_block_placement_chd as b','b.id','=','s.block_place_chd_id')
        //     ->where('s.student_id',Auth::user()->student_id)
        //     ->select('s.*', 'b.eob_status')
        //     ->orderBy('s.log_book_id', 'desc')
        //     ->get();

        return view('student_portal.log_book.index', compact('header','results'));
    }

    /**
     * This method use for create block form
     * @param None
     *
     */
    public function create()
    {

        $header = array(
            'pageTitle'  => 'Logbook Attachment',
            'tableTitle' => 'Logbook Attachment List'
        );
        return view('student_portal.log_book.create', compact('header'));
    }

    /* save block information
     * @param Request $request
     *
    */

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'attachment' => 'mimes:png,jpg,jpeg,csv,gif,txt,xlx,xls,pdf,docx,doc|max:6048',
           ]);
        StudentLogbookModel::storeStuLogbook($request);

        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('student_logbook_attachment');
    }

    /* block view
     * @param $id
     *
     */
    public function show($id)
    {

    }

    /* block update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle'  => 'Logbook Attachment',
            'tableTitle' => 'Logbook Attachment List'
        );

        $logBookInfo = StudentLogbookModel::find($id);
        return view('student_portal.log_book.update', compact('header', 'logBookInfo'));
    }

    /* update action
     * @param $request
     *
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'attachment' => 'mimes:png,jpg,jpeg,csv,gif,txt,xlx,xls,pdf,docx,doc|max:6048',
           ]);
        $data=
          [
           'active_status'=>1,
           'updated_by'=>Auth::user()->id,
          ];

        if(!empty($request->file('attachment')))
            {
            $photoId =StudentLogbookModel::where('log_book_id',$id)->first();
            if (!empty( $photoId))
            {
            $previousPhoto=$photoId->file;
            }
        }

        if ($files = $request->file('attachment'))
            {
                $destinationPath =  public_path('/uploads/student_logbook/');
                $profileImage = Auth::user()->email.'-'.date('Ymd-His') . "." . $files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $data['file'] = $profileImage;
            }

     if (!empty($previousPhoto))
     {
        unlink(  public_path('/uploads/student_logbook/'.$previousPhoto));
     }

     StudentLogbookModel::where('log_book_id',$id)->update($data);

        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('student_logbook_attachment');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
