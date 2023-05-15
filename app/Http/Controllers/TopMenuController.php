<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\SubMenu;
use App\Models\OrganizationInfo;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Session;
class TopMenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle'  => 'Tom Menu',
            'tableTitle' => 'Top Menu List'

        );
        $results = Menu::all()->where('active_status', '=', 1);
        return view('menu.topMenu',compact('header','results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu.createTopMenuForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $menu                   = new Menu;
        $menu->menu_name        = $request->menu_name;
        $menu->menu_description = $request->menu_description;
        $menu->menu_type        = $request->menu_type;
        $menu->menu_serial_id    = $request->menu_serial_id;
        $menu->active_status    = $request->active_status;
        $saveContact = $menu->save();
        Session::flash('success', 'Data Saved successfully!');
        return response()->json(['success' => 'saved']);        
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
        $menu = Menu::find($id);
        $menus = Menu::all()->where('active_status', '=', 1);
        return view('menu.menuUpdate', compact('menu','menus'));
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
        $menu = Menu::find($id);
        $menu->menu_name = $request->menu_name;
        $menu->menu_description = $request->menu_description;
        $menu->menu_type        = $request->menu_type;        
        $menu->menu_serial_id    = $request->menu_serial_id;
        $menu->active_status    = $request->active_status;
        $menu->save();
        Session::flash('success', 'Data Updated successfully!');
        return response()->json(['success' => 'saved']);   
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
     * Remove the specified resource from storage.
     *
     * @param  none
     * @return \Illuminate\Http\Response
     */

    public function subMenuIndex()
    {
        $header = array(
            'pageTitle'  => 'Sub Menu',
            'tableTitle' => 'Sub Menu List'

        );
        $results = SubMenu::getSubmenu();
        return view('sub_menu.subMenuIndex',compact('header','results'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  none
     * @return \Illuminate\Http\Response
     */

    public function createSubMenu()
    {
        $menus = Menu::all()->where('active_status', '=', 1);
        return view('sub_menu.createSubMenuForm', compact('menus'));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */

     public function getSubMenus(Request $request){
         $menuId = $request->menuId;
         $subMenuList = SubMenu::where('active_status',1)->where('menu_id',$menuId)->where('menu_type',5)->get();
         return $subMenuList;
     }

    public function saveSubMenu(Request $request)
    {
        SubMenu::createSubmenu($request);
        Session::flash('success', 'Data Saved successfully!');
        return response()->json(['success' => 'saved']);        
       
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function editSubMenu($id)
    {
        $menus = Menu::all()->where('active_status', '=', 1);
        $subMenus = SubMenu::find($id);
        $subMenuList = SubMenu::where('active_status',1)->where('menu_id',$subMenus->menu_id)->where('menu_type',5)->get();

        return view('sub_menu.updateSubMenuForm', compact('subMenus','menus','subMenuList'));
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int Request $request  $id
     * @return \Illuminate\Http\Response
     */

    public function updateSubMenu(Request $request, $id)
    {
        SubMenu::updateSubmenu($request,$id);
        Session::flash('success', 'Data Updated successfully!');
        return response()->json(['success' => 'saved']);    
    }
}
