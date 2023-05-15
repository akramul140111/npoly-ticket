<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\students_panel\MoneyReceiptAttachmentModel;
use DB;
use Auth;
class MoneyReceiptAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle'  => 'Student Money Receipt',
            'tableTitle' => 'Student Money Receipt List'
        );

        $results = DB::table('stu_money_receipt_attachment as mr')
            ->leftjoin('sa_lookup_data as lkd', 'mr.session', '=', 'lkd.LOOKUP_DATA_ID')
            ->select('mr.*','lkd.LOOKUP_DATA_NAME')
            ->where('mr.student_id', Auth::user()->student_id)
            ->orderBy('money_receipt_id','desc')
            ->get();


        return view('student_portal.money_receipt.index', compact('header','results'));
    }

    /**
     * This method use for create block form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle'  => 'Student Money Receipt',
            'tableTitle' => 'Student Money Receipt List'
        );
        $sessions = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 6)
            ->where('s.ACTIVE_FLAG', 1)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();

        return view('student_portal.money_receipt.create', compact('header','sessions'));
    }

    /* save block information
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        MoneyReceiptAttachmentModel::createMoneyReceipt($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('student_money_receipt');
    }

    /* block update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle'  => 'Student Money Receipt',
            'tableTitle' => 'Student Money Receipt List'
        );

        $sessions = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 6)
            ->where('s.ACTIVE_FLAG', 1)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();

        $moneyReceiptInfo = MoneyReceiptAttachmentModel::find($id);
        return view('student_portal.money_receipt.update', compact('header', 'moneyReceiptInfo','sessions'));
    }

    /* block update action
     * @param $request
     *
     */
    public function update(Request $request)
    {
        //dd($_POST);exit();
        MoneyReceiptAttachmentModel::updateMoneyReceiptAttachment($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('student_money_receipt');
    }

    /* check duplicate money receipt
     * @param $session
     *
     */
    public function checkDuplicate($session=null)
    {
        $data = 0;
        if(!empty($session)){

            $results = DB::table('stu_money_receipt_attachment as dt1')
            ->where('dt1.session', '=',$session)
            ->get();
            if(count($results) > 0){
                $data = count($results);
            }

        }
        return $data;

    }
}
