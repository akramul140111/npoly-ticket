<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WelcomeInfo;
use DB;
use Session;

class WelcomeController extends Controller
{
    //
    public function index()
    {
        return view('home');
    }

    public function indexa()
    {
        return view('layouts.indexa');
    }


    public function welcomeIndex(){

        $header = array(
            'pageTitle'  => 'Welcome Setup',
            'tableTitle' => 'Welcome Setup List'

        );
        $welcomeInfo = DB::table('dashboard_welcome')->select('*')->get();
        return view('welcome_setup.welcomeIndex',compact('header','welcomeInfo'));

    }

    public function create(Request $request)
    {

        return view('welcome_setup.createWelcomeSetup');
    }

    public function store(Request $request)
    {

        if ($_POST) {
            $post = new WelcomeInfo;
            $post->block_topic_id = $request->block_topic_id;
            $post->welcome_message = $request->welcome_message;
            $post->active_status = $request->active_status;
            $post->save();
            Session::flash('success', 'Data Saved successfully!');
            return response()->json(['success' => 'saved']);
        }

    }
    public function editWelcomeInfo(Request $request,$id){
        $header = array(
            'pageTitle'  => 'Welcome Setup',
            'tableTitle' => 'Welcome Setup List'

        );
        $welcomeInfo = DB::table('dashboard_welcome')->select('*')->where('welcome_id',$id)->first();

        return view('welcome_setup.editWelcomeInfo',compact('header','welcomeInfo','id'));
    }

    public function updateWelcomeInfo(Request $request,$id)
    {

            $post = WelcomeInfo::find($id);
            $post->title = $request->title;
            $post->welcome_message = $request->welcome_message;
            $post->active_status = $request->active_status;
            $post->save();
            Session::flash('success', 'Data Saved successfully!');
            return response()->json(['success' => 'saved']);

        Session::flash('success', 'Data Saved successfully!');
        return response()->json(['success' => 'saved']);
    }
}
