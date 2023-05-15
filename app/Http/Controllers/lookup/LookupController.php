<?php

namespace App\Http\Controllers\lookup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\lookup\LookupGroupModel;
use App\Models\lookup\LookupGroupDataModel;
use DB;
use Session;

class LookupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header=array(

            'pageTitle' => 'Group Settings',
            'tableTitle' => 'Group',
       );
       $lookupGroupItems=LookupGroupDataModel::get();

       $lookupGroups=LookupGroupModel::where('ACTIVE_FLAG', 1)->get();
        return view('lookup.index', compact('header', 'lookupGroups','lookupGroupItems') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lookup.create_group');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lookup_group=new LookupGroupModel();
        $lookup_group->LOOKUP_GRP_NAME=$request->group_name;
        $lookup_group->USE_CHAR_NUMB=$request->short_name_type;
        $lookup_group->LOOKUP_GRP_NAME=$request->group_name;
        $lookup_group->ORDER_SL_NO=1;

        $lookup_group->save();

        Session::flash('success', "Data Save Successfully");
        return redirect()->route('lookupIndex');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
/**
    *
     * @param  int  $USE_CHAR_NUMB ,$LOOKUP_GRP_ID

     */
    public function createLookupGroupItem($LOOKUP_GRP_ID, $USE_CHAR_NUMB)
    {
        if($LOOKUP_GRP_ID){
            $lookup_group=LookupGroupModel::where('LOOKUP_GRP_ID',$LOOKUP_GRP_ID)->first();
        }

       return view('lookup.create_group_item', compact('LOOKUP_GRP_ID','USE_CHAR_NUMB', 'lookup_group'));

    }
    /**

     * @param  \Illuminate\Http\Request  $request
     */

    public function storeLookupGroupItem(Request $request)
    {
        $lookup_group_id=$request->lookup_group_id;
        $lookup_group_name=$request->lookup_group_name;
             $CharecterValue = '';
                $numberValue = '';

        // if($lookup_group_name == 'C'){
        //     $CharecterValue = $request->short_name_cha;
        //     $numberValue = NULL;
        // }else{
        //     $CharecterValue = '';
        //     $numberValue =  $request->short_name_num;
        // }
        $lookup_group_item=new LookupGroupDataModel();
        $lookup_group_item->LOOKUP_GRP_ID=$request->lookup_group_id;
        $lookup_group_item->LOOKUP_DATA_NAME=$request->item_name;
        //$lookup_group_item->CHAR_LOOKUP=$CharecterValue;
        //$lookup_group_item->NUMB_LOOKUP=$numberValue;
        $lookup_group_item->ORDER_SL_NO=1;
        $lookup_group_item->ACTIVE_FLAG=$request->status;

        if(isset($request->SHORT_NAME)){
            $lookup_group_item->SHORT_NAME=$request->SHORT_NAME;
        }
        $lookup_group_item->save();

        Session::flash('success', "Data Save Successfully");
        return redirect()->route('lookupIndex');



    }

    /**
     * @param  int  $USE_CHAR_NUMB ,$id

     */
    public function editLookupGroupItem($id, $USE_CHAR_NUMB)
    {
        $lookup_group_item=LookupGroupDataModel::where('LOOKUP_DATA_ID',$id)->first();
        if($lookup_group_item){
            $lookup_group=LookupGroupModel::where('LOOKUP_GRP_ID',$lookup_group_item->LOOKUP_GRP_ID)->first();
        }

        return view('lookup.edit_group_item', compact('lookup_group_item','USE_CHAR_NUMB','lookup_group'));
    }
    public function updateLookupGroupItem(Request $request, $id)
    {
        $lookup_group_name=$request->lookup_group_name;
             $CharecterValue = '';
                $numberValue = '';

        // if($lookup_group_name == 'C'){
        //     $CharecterValue = $request->short_name_cha;
        //     $numberValue = NULL;
        // }else{
        //     $CharecterValue = '';
        //     $numberValue =  $request->short_name_num;
        // }
        $lookup_group_item=LookupGroupDataModel::find($id);
        $lookup_group_item->LOOKUP_DATA_NAME=$request->item_name;
        //$lookup_group_item->CHAR_LOOKUP=$CharecterValue;
        //$lookup_group_item->NUMB_LOOKUP=$numberValue;
        $lookup_group_item->ORDER_SL_NO=1;
        $lookup_group_item->ACTIVE_FLAG=$request->status;
        $lookup_group_item->SHORT_NAME=$request->SHORT_NAME;

        $lookup_group_item->save();

        Session::flash('success', "Data Update Successfully");
        return redirect()->route('lookupIndex');


    }
}
