<?php

namespace App\Http\Controllers\student_portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\StuTraineeFeedbackModel;
use App\Models\security_access\GroupsModel;
use DB;
use Auth;

class StudentFeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $header = array(
            'pageTitle' => 'Student Feedback',
            'tableTitle' => 'Student Feedback List'

        );
           $userGroupId= Auth::user()->USERGRP_ID;
             if( $userGroupId==2 || $userGroupId==5 )
             { 
                $results = StuTraineeFeedbackModel::leftJoin('sa_user_group','stu_trainee_feedback.reporing_to','=','sa_user_group.USERGRP_ID')  
                                                    ->select('sa_user_group.USERGRP_NAME','stu_trainee_feedback.*')
                                                    ->orderByDesc('stu_trainee_feedback.feedback_id')
                                                    ->get();
              }else
              { 
                $results = StuTraineeFeedbackModel::leftJoin('sa_user_group','stu_trainee_feedback.reporing_to','=','sa_user_group.USERGRP_ID')  
                                                    ->select('sa_user_group.USERGRP_NAME','stu_trainee_feedback.*')
                                                    ->where('stu_trainee_feedback.student_id', Auth::user()->student_id)
                                                    ->orderByDesc('stu_trainee_feedback.feedback_id')->get();
              }

               return view('student_portal.student_feedback.index',compact('header','results'));
    }

    /**
     * create student feedback form
     * @param None
     * 
     */  
    public function create()
    {       
        $header = array(
            'pageTitle' => 'Student Feedback',
            'tableTitle' => 'Student Feedback List'

        );
        $reportingUsers= GroupsModel::whereIn('USERGRP_ID', [2, 5])->get();

        return view('student_portal.student_feedback.create', compact('header','reportingUsers'));
    }

    /* save student feedback information
     * @param Request $request
     * 
     */ 
    public function store(Request $request)
    {
        StuTraineeFeedbackModel::createStudentFeedback($request);
        Session::flash('success', 'Data Saved successfully!');
        return redirect()->route('studentFeedback');    
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
            'pageTitle' => 'Student Feedback',
            'tableTitle' => 'Student Feedback List'

        );
        $reportingUsers= GroupsModel::whereIn('USERGRP_ID', [2, 5])->get();

        $result = StuTraineeFeedbackModel::find($id);
        return view('student_portal.student_feedback.update', compact('header', 'result','reportingUsers'));

    }

    /* student feedback update action
     * @param $request
     * 
     */ 
    public function update(Request $request)
    {
        StuTraineeFeedbackModel::updateStudentFeedback($request);
        Session::flash('success', 'Data Updated successfully!');
        return redirect()->route('studentFeedback');
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
