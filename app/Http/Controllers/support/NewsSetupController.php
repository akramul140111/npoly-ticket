<?php

namespace App\Http\Controllers\support;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\NewsSetupModel;
use  App\Models\lookup\LookupGroupDataModel;
use DB;
use Auth;

class NewsSetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'News',
            'tableTitle' => 'News List'
        );

        $results = DB::table('npoly_support_news')
            ->select('*')
            ->orderBy('news_id','desc')
            ->get();

        return view('news.index',compact('header','results'));
    }

    /**
     * Create class routine form
     * @param None
     *
     */
    public function create()
    {
        $header = array(
            'pageTitle' => 'News',
            'tableTitle' => 'News List'
        );

        return view('news.create', compact('header'));
    }

    /* save class routine
     * @param Request $request
     *
     */
    public function store(Request $request)
    {
        NewsSetupModel::createNews($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('newsSetupIndex');
    }

    /* class routine update page
     * @param $id
     *
     */
    public function edit($id)
    {
        $header = array(
            'pageTitle' => 'News',
            'tableTitle' => 'News List'
        );

        $result = NewsSetupModel::find($id);
        return view('news.update', compact('header', 'result'));

    }

    /* class routine update action
     * @param $request
     *
     */
    public function update(Request $request)
    {
        NewsSetupModel::updateNews($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('newsSetupIndex');
    }





}
