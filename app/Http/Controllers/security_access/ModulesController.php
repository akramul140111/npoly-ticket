<?php

namespace App\Http\Controllers\security_access;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\security_access\ModulesModel;
use Session;
use DB;

class ModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Modules',
            'tableTitle' => 'Modules'
        );    
        $modules=ModulesModel::get();
        return view('security_access.modules.index', compact('header', 'modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $header = array(
        'pageTitle'  => 'Modules Create',
        'tableTitle' => 'Modules  List'
    );
     return view('security_access.modules.create', compact('header'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $modules=new ModulesModel();
        $modules->MODULE_NAME=$request->module_name;
        $modules->MODULE_NAME_BN=$request->module_name_bangla;
        $modules->CATEGORY=1;
        $modules->SHORT_NAME=$request->short_name; 
        $modules->SL_NO = $request->serial_no;
        $modules->ACTIVE_STATUS=$request->active_status;
        $modules->save();
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('moduleSetup');
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
          $header = array
         (
            'pageTitle'  => 'Modules Edit',

         );
         $modules = ModulesModel::where('MODULE_ID', $id)->first();          
         return view('security_access.modules.edit', compact('header','modules'));
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
        $modules = ModulesModel::find($id);
        $modules->MODULE_NAME=$request->module_name;
        $modules->MODULE_NAME_BN=$request->module_name_bangla;
        $modules->CATEGORY=1;
        $modules->SHORT_NAME=$request->short_name; 
        $modules->SL_NO = $request->serial_no;
        $modules->ACTIVE_STATUS=$request->active_status;
        $modules->save();
        Session::flash('success', 'Data Update successfully!');
        return redirect()->route('moduleSetup');
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
