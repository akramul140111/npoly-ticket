<?php

namespace App\Http\Controllers\security_access;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\security_access\ModulesModel;
use App\Models\security_access\ModuleLinksModel;
use Session;
use DB;
use Auth;


class ModuleLinksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $header = array(
        'pageTitle' => 'Security Access',
        'tableTitle' => 'Modules Links'
    );
    //Get data from Modules table
     $modules=ModulesModel::All();
     //leftJoin with modules table
     $moduleLinks=ModuleLinksModel::leftJoin('sa_modules','sa_org_mlinks.SA_MODULE_ID','=','sa_modules.MODULE_ID' )->select('sa_modules.MODULE_NAME as moduleName','sa_org_mlinks.*')->orderBy('sa_org_mlinks.SA_MLINKS_ID','desc')->get();
      return view('security_access.modules_links.index', compact('header','moduleLinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $header = array(
        'pageTitle'  => 'Module Link Create',
        'tableTitle' => 'Module Links'

    );

       //Get data from Modules table

       $modules=ModulesModel::All();

       return view('security_access.modules_links.create', compact('header', 'modules'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $moduleLink=new ModuleLinksModel();
        $moduleLink->SA_MODULE_ID=$request->module_id;
        $moduleLink->SA_MLINK_NAME=$request->module_link_name;
        $moduleLink->SA_MLINK_PAGES=$request->module_link_page;
        $moduleLink->ORG_ID=1;
        $moduleLink->LINK_ID=1;
        $moduleLink->URL_URI=$request->module_link_uri;
        $moduleLink->url_class=$request->url_class;
        $moduleLink->url_function=$request->url_function;
        $moduleLink->url_name=$request->url_name;
        $moduleLink->url_type=$request->url_type;
        $moduleLink->STATUS=$request->status;
        $moduleLink->SL_NO=$request->SL_NO;
        $moduleLink->link_position='L';
        $moduleLink->created_by=Auth::user()->id;

        $moduleLink->save();
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('moduleLinkSetup');


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
        $header = array(
            'pageTitle'  => 'Module Link Edit',
            'tableTitle' => 'Module Links'

        );

     //Get data from Modules table
        $modules = ModulesModel::All();


        $moduleLink = ModuleLinksModel::where('SA_MLINKS_ID', $id)->first();

        return view('security_access.modules_links.edit', compact('header','modules','moduleLink'));

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

        $moduleLink = ModuleLinksModel::find($id);
        $moduleLink->SA_MODULE_ID=$request->module_id;
        $moduleLink->SA_MLINK_NAME=$request->module_link_name;
        $moduleLink->SA_MLINK_PAGES=$request->module_link_page;
        $moduleLink->URL_URI=$request->module_link_uri;
        $moduleLink->url_class=$request->url_class;
        $moduleLink->url_function=$request->url_function;
        $moduleLink->url_name=$request->url_name;
        $moduleLink->url_type=$request->url_type;
        $moduleLink->STATUS=$request->status;
        $moduleLink->SL_NO=$request->SL_NO;
        $moduleLink->updated_by=Auth::user()->id;
        $moduleLink->save();
        Session::flash('success', 'Data Update successfully!');
        return redirect()->route('moduleLinkSetup');
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
