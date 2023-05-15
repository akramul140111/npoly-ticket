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

class ModuleManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Page Permission',
            'tableTitle' => 'Page Permission List',
        );
        $modules = DB::table('sa_modules')->get();
        return view('security_access.modules_manage.index',compact('header','modules'));
    }

    public function userIndex()
    {
        $header = array(
            'pageTitle' => 'Create user',
            'tableTitle' => 'All user List',
        );

        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->where('s.ACTIVE_FLAG', 1)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->get();

        // below data are obsolated. Please search in searchUser()
        // $users = DB::table('users')
        // ->leftJoin('sa_lookup_data','users.course_type','=','sa_lookup_data.LOOKUP_DATA_ID')
        // ->leftJoin('sa_lookup_data as d2','users.department_id','=','d2.LOOKUP_DATA_ID')
        // ->leftJoin('sa_lookup_data as d3','users.course_name','=','d3.LOOKUP_DATA_ID')
        // //->where('USERGRP_ID','!=', 3)
        // //->where('USERGRP_ID','!=', 4)
        // ->select('users.name','users.email','users.email_address','users.active_status','sa_lookup_data.LOOKUP_DATA_NAME as course_type','d2.LOOKUP_DATA_NAME as department','d3.LOOKUP_DATA_NAME as course_name')
        // ->orderBy('users.id', 'DESC')
        // ->get();
        $users = [];


        return view('security_access.new_user.index',compact('header','users','courseTypes'));
    }


    public function searchUser($type=null, $dept=null, $name=null)
    {

        $users = [];

        // searhcing result
        if(!empty($type) && !empty($dept) && !empty($name)){
            $users = DB::table('users')
            ->leftJoin('sa_lookup_data','users.course_type','=','sa_lookup_data.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as d2','users.department_id','=','d2.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as d3','users.course_name','=','d3.LOOKUP_DATA_ID')
            //->where('USERGRP_ID','!=', 3)
            //->where('USERGRP_ID','!=', 4)
            ->where('users.course_type','=', $type)
            ->where('users.department_id','=', $dept)
            ->where('users.course_name','=', $name)
            ->select('users.bmdc_no','users.name','users.contact_no','users.email','users.email_address','users.active_status','sa_lookup_data.LOOKUP_DATA_NAME as course_type','d2.LOOKUP_DATA_NAME as department','d3.LOOKUP_DATA_NAME as course_name')
            ->orderBy('users.id', 'DESC')
            ->get();

        }else if(!empty($type) && !empty($dept) && empty($name)){
            $users = DB::table('users')
            ->leftJoin('sa_lookup_data','users.course_type','=','sa_lookup_data.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as d2','users.department_id','=','d2.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as d3','users.course_name','=','d3.LOOKUP_DATA_ID')
            //->where('USERGRP_ID','!=', 3)
            //->where('USERGRP_ID','!=', 4)
            ->where('users.course_type','=', $type)
            ->where('users.department_id','=', $dept)
            ->select('users.bmdc_no','users.name','users.contact_no','users.email','users.email_address','users.active_status','sa_lookup_data.LOOKUP_DATA_NAME as course_type','d2.LOOKUP_DATA_NAME as department','d3.LOOKUP_DATA_NAME as course_name')
            ->orderBy('users.id', 'DESC')
            ->get();

        }else if(!empty($type) && empty($dept) && empty($name)){
            $users = DB::table('users')
            ->leftJoin('sa_lookup_data','users.course_type','=','sa_lookup_data.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as d2','users.department_id','=','d2.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as d3','users.course_name','=','d3.LOOKUP_DATA_ID')
            //->where('USERGRP_ID','!=', 3)
            //->where('USERGRP_ID','!=', 4)
            ->where('users.course_type','=', $type)
            ->select('users.bmdc_no','users.name','users.contact_no','users.email','users.email_address','users.active_status','sa_lookup_data.LOOKUP_DATA_NAME as course_type','d2.LOOKUP_DATA_NAME as department','d3.LOOKUP_DATA_NAME as course_name')
            ->orderBy('users.id', 'DESC')
            ->get();
        }else{}

        // initial result
        if(empty($type) && empty($dept) && empty($name)){
            $users = DB::table('users')
            ->leftJoin('sa_lookup_data','users.course_type','=','sa_lookup_data.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as d2','users.department_id','=','d2.LOOKUP_DATA_ID')
            ->leftJoin('sa_lookup_data as d3','users.course_name','=','d3.LOOKUP_DATA_ID')
            //->where('USERGRP_ID','!=', 3)
            //->where('USERGRP_ID','!=', 4)
            ->select('users.bmdc_no','users.name','users.contact_no','users.email','users.email_address','users.active_status','sa_lookup_data.LOOKUP_DATA_NAME as course_type','d2.LOOKUP_DATA_NAME as department','d3.LOOKUP_DATA_NAME as course_name')
            ->orderBy('users.id', 'DESC')
            ->get();
        }

        return view('security_access.new_user.searchResult',compact('users'));
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

        if (User::where('email', $request->email)->exists()) {
            Session::flash('error', 'User name already exists please try another!');
            return redirect()->route('userIndex');
            // exists
        }else{
            $maxId = DB::table('users')->max('id')+1;
            $user=new User();
            $user->USERGRP_ID       = $request->group_name;
            $user->USERLVL_ID       = $request->user_level;
            $user->support_user_id  = $request->group_name =='6'? $maxId:"0";
            $user->employee_id      = !empty($request->employee_id)? $request->employee_id:'';
            $user->designation      = $request->designation;
            $user->department_id    = $request->department;

            $user->course_type      = $request->cousetype;
            $user->course_name      = $request->coursename;
            $user->contact_no       = $request->contact_no;

            $user->name             = $request->user_name;
            $user->email_address    = $request->email_address;
            $user ->password        = bcrypt(request('password'));
            //$user->is_admin=$request->is_admin;
            $user->email            = $request->email;
            $user->active_status    = $request->status;
            $user->save();
            Session::flash('success', 'Data Saved successfully!');
            return redirect()->route('userIndex');
        }

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
        //$user_groups=GroupsModel::where('group_status', 1)->get();
        $user_groups=GroupsModel::where('ACTIVE_STATUS', 1)->get();
        $departments = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 3)
        ->where('s.ACTIVE_FLAG', 1)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->get();
        $courseTypes = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 4)
        ->where('s.ACTIVE_FLAG', 1)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->get();
        $courseNames = DB::table('sa_lookup_data as s')
        ->where('s.LOOKUP_GRP_ID', 5)
        ->where('s.ACTIVE_FLAG', 1)
        ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
        ->get();

//        $designations = DB::table('set_designation')
//        ->where('set_designation.active_status',1)
//        ->get();
        $designations = DB::table('sa_lookup_data as s')
            ->where('s.LOOKUP_GRP_ID', 34)
            ->where('s.ACTIVE_FLAG', 1)
            ->select('s.LOOKUP_DATA_ID','s.LOOKUP_DATA_NAME')
            ->get();
        //$employees = DB::table('npoly_employees')->select('employee_id,employee_name')->where('active_status',1)->get();
        return view('security_access.new_user.create', compact('user_groups','departments','courseTypes','courseNames','designations'));
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

            'pageTitle' => 'Page Permission',
            'tableTitle' => 'Page Permission List',
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
      // $SA_MLINKS_ID_count = DB::selectOne(DB::raw("select count(SA_UGLWM_LINK) SA_UGLWM_LINK from sa_uglw_mlink where SA_UGLWM_LINK= $SA_MLINKS_ID"));
       $setVaue = $request->input('setVaue');

    //    print_r($SA_MLINKS_ID_count->SA_UGLWM_LINK).'<br>';exit;
        // print_r($setVaue);exit;
        $groupName = $request->input('groupName');
        $userLevel = $request->input('userLevel');
        $MODULE_ID = $request->input('MODULE_ID');
        $SA_UGLWM_LINK = $request->input('SA_UGLWM_LINK');
        // print_r($SA_UGLWM_LINK);exit;

            $pageStatus = DB::table('sa_uglw_mlink')->where('SA_UGLWM_LINK', $SA_MLINKS_ID)
            ->update([
                'STATUS' => $setVaue
            ]);

            if($pageStatus == true){
                return 'Success';
                 exit;
            }else{
                return 'Fail';
            }


   }

   public function insertPageLinkStatus(Request $request)
   {

    $SA_MLINKS_ID = $request->input('SA_MLINKS_ID');
    // $SA_MLINKS_ID_count = DB::selectOne(DB::raw("select count(SA_UGLWM_LINK) SA_UGLWM_LINK from sa_uglw_mlink where SA_UGLWM_LINK= $SA_MLINKS_ID"));
     $setVaue = $request->input('setVaue');

  //    print_r($SA_MLINKS_ID_count->SA_UGLWM_LINK).'<br>';exit;
      // print_r($setVaue);exit;
      $groupName = $request->input('groupName');
      $userLevel = $request->input('userLevel');
      $MODULE_ID = $request->input('MODULE_ID');
      $SA_UGLWM_LINK = $request->input('SA_UGLWM_LINK');

    echo 'insert';
    DB::table('sa_uglw_mlink')->insert([
        'USERGRP_ID' => $groupName,
        'UG_LEVEL_ID' => $userLevel,
        'SA_MODULE_ID' => $MODULE_ID,
        'SA_MLINKS_ID' => $SA_UGLWM_LINK,
        'STATUS' => $setVaue,
    ]);
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
