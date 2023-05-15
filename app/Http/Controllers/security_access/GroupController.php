<?php

namespace App\Http\Controllers\security_access;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\setup\OrganizationModel;
use App\Models\security_access\ModulesModel;
use App\Models\security_access\GroupsModel;
use App\Models\security_access\UserGroupLevelModel;
use App\Models\User;
use App\Models\security_access\ModuleLinksModel;

use DB;
use Session;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Module Management',            
            'tableTitle' => 'Module Management List',
        );
        $organizations = OrganizationModel::all();
        return view('security_access.modules_manage.index',compact('header','organizations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('security_access.new_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user=new User();
        $user->USERGRP_ID =$request->group_name;
        $user->USERLVL_ID  =$request->user_level;
        $user->roll_id  =$request->user_type;
        $user->department_id =$request->department;



        $user->course_type =$request->cousetype;
        $user->course_name =$request->coursename;
        $user->contact_no =$request->contact_no;


        $user->name =$request->user_name;
        $user->email_address =$request->email_address;
        $user ->password = bcrypt(request('password'));
        $user->is_admin=$request->is_admin;
        $user->email=$request->email;
        $user->active_status=$request->status;
        $user->save();
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('moduleManage');

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
     * This method user for creatre group.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function createGroup()
    {
        return view('security_access.user_group.create');
    }

    /**
     * This method user for creatre user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    public function createUser()
    {
        $user_groups=GroupsModel::where('group_status', 1)->get();
        $departments = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 3)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->get();
        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->get();
        $courseNames = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 5)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->get();
  
        return view('security_access.new_user.create', compact('user_groups','departments','courseTypes','courseNames'));
    }


    /**
     * This method user for assign model.
     
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function assignModul()
    {
        $moules = DB::table('sa_modules')->get();//ModulesModel::all();
        $moulesIds = DB::table('sa_org_modules')->get();//ModulesModel::all();
        return view('security_access.assign_module.create',compact('moules','moulesIds'));
        
    }

    /**
     * This method use for add module.
     *
     * @param  None
     */

    public function addModules(Request $request)
    {
        $module_ids = $_POST['module_ids'];
        $module = DB::table('sa_modules')->where('sa_modules.MODULE_ID', $module_ids)->first();
        // print_r($module);exit;
        DB::table('sa_org_modules')->insert([
            'MODULE_IDS' => $module_ids,
            'SA_MODULE_NAME' => $module->MODULE_NAME,
            'org_id' => 1
        ]);
    }

        /**
     * This method use for remove module.
     *
     * @param  none
     */

    public function deleteModules(Request $request)
    {

        $module_ids = $request->input('module_ids');
        DB::table('sa_org_modules')->where('SA_MODULE_ID', $module_ids)->delete();
        }

    /**
     * This method user for add page.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function addPage()
    {
        $header=array(

            'pageTitle' => 'Assing Link',            
            'tableTitle' => 'Modules',
       );
       $userGroups=GroupsModel::get();

       $user_group_levels=UserGroupLevelModel::get();
       $modules = DB::table('sa_modules')->get();//ModulesModel::all();
       return view('security_access.add_page.index', compact('header', 'userGroups','modules'));

    }
     /**
     * This method user for group main page.
     
     */
    public function  groupIndex()
    {

    
       $header=array(

            'pageTitle' => 'User Group',            
            'tableTitle' => 'User Group List',
       );
       $userGroups=GroupsModel::get();

       $user_group_levels=UserGroupLevelModel::get();
     
       return view('security_access.user_group.index', compact('header', 'userGroups', 'user_group_levels'));
    }

     /**
     * This method user for store group.
     * @param  \Illuminate\Http\Request  $request
     
     */
    public function storeGroup(Request $request)
    {
         $group=new GroupsModel();

         $group->USERGRP_NAME=$request->group_name;
         $group->ACTIVE_STATUS=$request->status;
         $group->save();
         Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('groupIndex');

    }
     /**
     * This method user for create Level.
     *  * @param  int  $id
     
     
     */
    public function createLevel($id)
    {
       return view('security_access.user_group_level.create',compact('id'));
    }
 /**
     * This method user for store level.
     * @param  \Illuminate\Http\Request  $request
     
     */
    public function storeLevel(Request $request)
    {  
       
        $groupLeves=new UserGroupLevelModel();
        $groupLeves->USERGRP_ID=$request->group_id;
        $groupLeves->UGLEVE_NAME=$request->level_name;   
        $groupLeves->ACTIVE_STATUS=$request->status;
        $groupLeves->save(); 
        Session::flash('success', 'Data Save Successfully');
        return redirect()->route('groupIndex');    

    }
    /**
     * This method user for edit Level.
     *  * @param  int  $id
     
     
     */
    public function editLevel($id)
    {
        $groupLevel=UserGroupLevelModel::where('UG_LEVEL_ID',$id)->first();
       
        return view('security_access.user_group_level.edit', compact('groupLevel'));
    }
 /**
     * This method user for update Level. 
     * @param  int  $id
      * @param  \Illuminate\Http\Request  $request
     
     */
    public function updateLevel(Request $request,$id)
    {

       $groupLeves = UserGroupLevelModel::find($id);
       $groupLeves->UGLEVE_NAME=$request->level_name;   
       $groupLeves->ACTIVE_STATUS=$request->status;
       $groupLeves->save(); 
       Session::flash('success', 'Update Save Successfully');
       return redirect()->route('groupIndex');

    }
    public function createPage()
   {
    $modules  = ModulesModel::all();
    return view('security_access.add_page.create', compact('modules'));
    
   }
   public function userGroupLevel(Request $request)
   {
    
    $group_id = $request->group_name;
    $groupLevels = UserGroupLevelModel::where('USERGRP_ID',$group_id)->get();

    return response()->json([
   'groupLevels' => $groupLevels

  ]);

   }

   /**
     * This method use for json data from select group.
     
       * @param  \Illuminate\Http\Request  $request
     */
   public function assingLinkGroupLevel(Request $request)
   {
    $group_id = $request->group_name;

    $groupLevels = UserGroupLevelModel::where('USERGRP_ID',$group_id)->get();
  
    return response()->json([
   'groupLevels' => $groupLevels

]);
 }
 
  
   
   public function assingLinkUserLevel(Request $request)
   {
    $UG_LEVEL_ID = $request->input('userLevel');
    $USERGRP_ID = $request->input('groupName');

    $modules = DB::table('sa_modules')->get();
    $modulesLinks = DB::table('sa_uglw_mlink')
           ->leftJoin('sa_modules', 'sa_uglw_mlink.SA_MODULE_ID','=','sa_modules.MODULE_ID')
          ->where('sa_uglw_mlink.USERGRP_ID', $USERGRP_ID)
          ->where('sa_uglw_mlink.UG_LEVEL_ID', $UG_LEVEL_ID)
          ->get();
    //print_r($USERGRP_ID);//exit;
    // print_r($link);exit;
    return view('security_access.add_page.showLinks', compact('modules','USERGRP_ID','UG_LEVEL_ID'));

//     return response()->json([
//    'userLevels' => $userLevels

//   ]);
   }

   public function assingLinkUsergroup(Request $request)
   {
    $group_id = $request->group_name;
 
    $userGroups = User::where('USERGRP_ID',$group_id)->get();

    return response()->json([
   'userGroups' => $userGroups

  ]);
   }

   /**
    * this method used from change page link status
    * @param Request $request
    */

   public function changePageLinkStatus(Request $request)
   {
       $SA_MLINKS_ID = $request->input('SA_MLINKS_ID');
       $setVaue = $request->input('setVaue');       
       $statusValue = DB::table('sa_org_mlinks')->where('sa_org_mlinks.SA_MLINKS_ID', $SA_MLINKS_ID)->get();
       $pageStatus = ModuleLinksModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)
                ->update([
                    'STATUS' => $setVaue
                ]);

                if($pageStatus == true){
                    return 'Success';
                }else{
                    return 'Fail';
                }
   }

   public function updatePageLink(Request $request)
   {
       $SA_MLINKS_ID = $request->input('SA_MLINKS_ID');
       $setUpdate = $request->input('setUpdate');
        //  print_r($setUpdate);exit;
       $flight = ModuleLinksModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)
                ->update([
                    'UPDATE' => $setUpdate
                ]);
   }

   public function changePageLinkCreate(Request $request)
   {
    $SA_MLINKS_ID = $request->input('SA_MLINKS_ID');
    $setCreate = $request->input('setCreate');
     //  print_r($setUpdate);exit;
    $flight = ModuleLinksModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)
             ->update([
                 'CREATE' => $setCreate
             ]);
   }

   public function changePageLinkRead(Request $request)
   {
    $SA_MLINKS_ID = $request->input('SA_MLINKS_ID');
    $setRead = $request->input('setRead');
     //  print_r($setUpdate);exit;
    $flight = ModuleLinksModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)
             ->update([
                 'READ' => $setRead
             ]);
   }

   public function changePageLinkDelete(Request $request)
   {
    $SA_MLINKS_ID = $request->input('SA_MLINKS_ID');
    $setDelete = $request->input('setDelete');
     //  print_r($setUpdate);exit;
    $flight = ModuleLinksModel::where('SA_MLINKS_ID', $SA_MLINKS_ID)
             ->update([
                 'DELETE' => $setDelete
             ]);
   }

   


}