<?php

namespace App\Http\Controllers\support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\ClientSetupModel;
use  App\Models\lookup\LookupGroupDataModel;
use DB;
use Auth;

class ClientSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Client',
            'tableTitle' => 'Client List'
        );

        $results = DB::table('npoly_clients')
            ->select('*')
            ->orderBy('client_id','desc')
            ->get();

        return view('setup/clients.index',compact('header','results'));
    }

    /**
     * Create class routine form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle' => 'Client',
            'tableTitle' => 'Client List'
        );

        return view('setup/clients.create', compact('header'));
    }

    /* save class routine
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        ClientSetupModel::createClient($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('clientSetupIndex');
    }

    /* class routine update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle' => 'Client',
            'tableTitle' => 'Client List'
        );

        $result = ClientSetupModel::find($id);
        return view('setup/clients.update', compact('header', 'result'));

    }

    /* class routine update action
     * @param $request
     *
     */
    public function update(Request $request)
    {
        ClientSetupModel::updateClient($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('clientSetupIndex');
    }

    /* get day of date
     * @param $date
     *
     */
    public function getDay($date=null)
    {
        if($date)
            return date('l', strtotime($date));
        else
            return '';

    }

    // get block date details for class routine
    public function getBlockDate($id=null)
    {

        $dateForm = '';
        $dateTo = '';
        $status = 0;

        if($id){
            $curDate = date('Y-m-d');
            $block = DB::table('aca_create_block')->where('block_id', $id)->select('duration_from','duration_to')->first();
            if(!empty($block) && !empty($block->duration_from) && !empty($block->duration_to)){
                $dateForm = date('d-m-Y', strtotime($block->duration_from));
                $dateTo = date('d-m-Y', strtotime($block->duration_to));
                if(strtotime($curDate) >= strtotime($block->duration_from) && strtotime($curDate) <= strtotime($block->duration_to)){
                    // $dateForm = date('d-m-Y', $block->duration_from);
                    // $dateTo = date('d-m-Y', $block->duration_to);
                    $status = 1;

                }
            }
        }

        return [
            "dateForm" => $dateForm,
            "dateTo" => $dateTo,
            "status" => $status
        ];

    }

    /**
     * @author Md. Salaquzzaman <salaquzzaman@atilimited.net>
     * @created-date 16-10-2022
     * @purpose Get block list by type, dept & name
     */
    public function getTopicByBlockEx($block_id=null)
    {
        $dept=Auth::user()->department_id;
        $cType=Auth::user()->course_type;
        $cName=Auth::user()->course_name;

        $options = '<option value="">--select--</option>';
        if($block_id){
            // get class routine list
            $topics = DB::select("select c.id cid, c.topic FROM set_topic_mst m
                LEFT JOIN set_topic_chd c ON m.id=c.topic_id
                WHERE m.block_id=$block_id AND m.course_type=$cType AND m.department=$dept AND m.course_name=$cName");
            if($topics){
                foreach($topics as $t){
                    $options.= '<option value="'.$t->cid.'">'.$t->topic.'</option>';
                }
            }

        }else{
        }
        return $options;
    }
}
