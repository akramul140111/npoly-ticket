<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\StuTraineeFeedbackModel;
use DB;
use Auth;


class TraineeFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Trainee Feedback',
            'tableTitle' => 'Trainee Feedback List'

        );

        if(Auth::user()->USERGRP_ID==1){ // admin
            $results = StuTraineeFeedbackModel::orderByDesc('feedback_id')->get();
        }else{ 
            $results = StuTraineeFeedbackModel::where('student_id', Auth::user()->student_id)->orderByDesc('feedback_id')->get();
        }

        

        return view('student_portal.trainee_feedback.index',compact('header','results'));
    }

    /**
     * create student feedback form
     * @param None
     * 
     */  
    public function create()
    {       
        $header = array(
            'pageTitle' => 'Trainee Feedback',
            'tableTitle' => 'Trainee Feedback List'

        );
        
        return view('student_portal.trainee_feedback.create', compact('header'));
    }

    /* save student feedback information
     * @param Request $request
     * 
     */ 
    public function store(Request $request)
    {
        StuTraineeFeedbackModel::createStudentFeedback($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('traineeFeedback');    
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

    /* student feedback update page
     * @param $id
     * 
     */ 
    public function edit($id)
    { 
        $header = array(
            'pageTitle' => 'Trainee Feedback',
            'tableTitle' => 'Trainee Feedback List'

        );

        $result = StuTraineeFeedbackModel::find($id);
        return view('student_portal.trainee_feedback.update', compact('header', 'result'));

    }

    /* student feedback update action
     * @param $request
     * 
     */ 
    public function update(Request $request)
    {
        StuTraineeFeedbackModel::updateStudentFeedback($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('traineeFeedback');
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

