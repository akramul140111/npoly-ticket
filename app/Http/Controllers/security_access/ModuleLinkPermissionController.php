<?php

namespace App\Http\Controllers\security_access;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\security_access\ModuleLinkPermissionModel;
use DB;
class ModuleLinkPermissionController extends Controller
{

   public function modulePageLinkCreate(Request $request)
   {

      $SA_MLINKS_ID = $request->input('SA_MLINKSID');
      $setCreate = $request->input('setCreate'); 
      // print_r($SA_MLINKS_ID);
      // print_r($setCreate);exit;
      $pageStatus = DB::table('sa_uglw_mlink')->where('SA_UGLWM_LINK', $SA_MLINKS_ID)
      ->update([
          'CREATE' => $setCreate
      ]);

      if($pageStatus == true){
          return 'Success';
           exit;
      }else{
          return 'Fail';
      }
   }

    public function modulePageLinkCreate_previous(Request $request)
    {
        $MODULE_ID = $request->input('MODULE_ID');
        $SA_MLINKS_ID = $request->input('SA_MLINKSID');
        $LINK_ID = $request->input('LINK_ID');
       $setCreate = $request->input('setCreate');  
       $SA_UGLWM_LINK = $request->input('SA_UGLWM_LINK');
       $linkId = ModuleLinkPermissionModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)
       ->where('USERGRP_ID', $request->input('groupName'))
       ->where('UG_LEVEL_ID', $request->input('userLevel'))
       ->count();
       //print_r($linkId);exit;

       if($linkId!= 0){
          //echo 'update';exit;
          DB::table('sa_uglw_mlink')
          ->where('sa_uglw_mlink.SA_MLINKS_ID', $SA_MLINKS_ID)
          ->update([
            'CREATE' => $setCreate
          ]);
       }else{
          //echo 'insert';exit;
        DB::table('sa_uglw_mlink')->insert([
            'CREATE' => $setCreate,
            'SA_MODULE_ID' => $MODULE_ID,
            'SA_MLINKS_ID' => $SA_MLINKS_ID,
            'LINK_ID' => $LINK_ID,
            "USERGRP_ID" => $request->input('groupName'),
            "UG_LEVEL_ID" => $request->input('userLevel')
        ]);
       }
    }

    
    public function modulePageLinkRead(Request $request)
    {
        $MODULE_ID = $request->input('MODULE_ID');
        $SA_MLINKS_ID = $request->input('SA_MLINKSID');
        $LINK_ID = $request->input('LINK_ID');
       $setCreate = $request->input('setCreate');  
       $SA_UGLWM_LINK = $request->input('SA_UGLWM_LINK');
       $linkId = ModuleLinkPermissionModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)->first();
    //    print_r($linkId);exit;

       if($linkId!=''){
          DB::table('sa_uglw_mlink')
          ->where('sa_uglw_mlink.SA_MLINKS_ID', $SA_MLINKS_ID)
          ->update([
            'READ' => $setCreate
          ]);
       }else{
        DB::table('sa_uglw_mlink')->insert([
            'READ' => $setCreate,
            'SA_MODULE_ID' => $MODULE_ID,
            'SA_MLINKS_ID' => $SA_MLINKS_ID,
            'LINK_ID' => $LINK_ID,
            "USERGRP_ID" => $request->input('groupName'),
            "UG_LEVEL_ID" => $request->input('userLevel')
        ]);
       }
    }


    public function modulePageLinkUpdate(Request $request)
   {

      $SA_MLINKS_ID = $request->input('SA_MLINKSID');
      $setCreate = $request->input('setCreate'); 
      // print_r($SA_MLINKS_ID);
      // print_r($setCreate);exit;
      $pageStatus = DB::table('sa_uglw_mlink')->where('SA_UGLWM_LINK', $SA_MLINKS_ID)
      ->update([
          'UPDATE' => $setCreate
      ]);

      if($pageStatus == true){
          return 'Success';
           exit;
      }else{
          return 'Fail';
      }
   }

    
    public function modulePageLinkUpdate_old(Request $request)
    {
        $MODULE_ID = $request->input('MODULE_ID');
        $SA_MLINKS_ID = $request->input('SA_MLINKSID');
        $LINK_ID = $request->input('LINK_ID');
       $setCreate = $request->input('setCreate');  
       $SA_UGLWM_LINK = $request->input('SA_UGLWM_LINK');
       $linkId = ModuleLinkPermissionModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)->first();
    //    print_r($linkId);exit;

       if($linkId!=''){
          DB::table('sa_uglw_mlink')
          ->where('sa_uglw_mlink.SA_MLINKS_ID', $SA_MLINKS_ID)
          ->update([
            'UPDATE' => $setCreate
          ]);
       }else{
        DB::table('sa_uglw_mlink')->insert([
            'UPDATE' => $setCreate,
            'SA_MODULE_ID' => $MODULE_ID,
            'SA_MLINKS_ID' => $SA_MLINKS_ID,
            'LINK_ID' => $LINK_ID,
            "USERGRP_ID" => $request->input('groupName'),
            "UG_LEVEL_ID" => $request->input('userLevel')
        ]);
       }
    }
    

    public function modulePageLinkDelete(Request $request)
    {
        $MODULE_ID = $request->input('MODULE_ID');
        $SA_MLINKS_ID = $request->input('SA_MLINKSID');
        $LINK_ID = $request->input('LINK_ID');
       $setCreate = $request->input('setCreate');  
       $SA_UGLWM_LINK = $request->input('SA_UGLWM_LINK');
       $linkId = ModuleLinkPermissionModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)->first();
    //    print_r($linkId);exit;

       if($linkId!=''){
          DB::table('sa_uglw_mlink')
          ->where('sa_uglw_mlink.SA_MLINKS_ID', $SA_MLINKS_ID)
          ->update([
            'DELETE' => $setCreate
          ]);
       }else{
        DB::table('sa_uglw_mlink')->insert([
            'DELETE' => $setCreate,
            'SA_MODULE_ID' => $MODULE_ID,
            'SA_MLINKS_ID' => $SA_MLINKS_ID,
            'LINK_ID' => $LINK_ID,
            "USERGRP_ID" => $request->input('groupName'),
            "UG_LEVEL_ID" => $request->input('userLevel')
        ]);
       }
    }

    
    public function modulePageLinkStatus(Request $request)
    {
        $MODULE_ID = $request->input('MODULE_ID');
        $SA_MLINKS_ID = $request->input('SA_MLINKSID');
        $LINK_ID = $request->input('LINK_ID');
       $setCreate = $request->input('setCreate');  
       $SA_UGLWM_LINK = $request->input('SA_UGLWM_LINK');
       $linkId = ModuleLinkPermissionModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)->first();
    //    print_r($linkId);exit;

       if($linkId!=''){
          DB::table('sa_uglw_mlink')
          ->where('sa_uglw_mlink.SA_MLINKS_ID', $SA_MLINKS_ID)
          ->update([
            'STATUS' => $setCreate
          ]);
       }else{
        DB::table('sa_uglw_mlink')->insert([
            'STATUS' => $setCreate,
            'SA_MODULE_ID' => $MODULE_ID,
            'SA_MLINKS_ID' => $SA_MLINKS_ID,
            'LINK_ID' => $LINK_ID,
            "USERGRP_ID" => $request->input('groupName'),
            "UG_LEVEL_ID" => $request->input('userLevel')
        ]);
       }
    }


    
}
