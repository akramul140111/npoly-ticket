<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    //protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  $this->middleware('guest')->except('logout');
    }



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $email       = $request->email;
        $password    = $request->password;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $email, 'password' => $password, 'active_status' => 1])) {
            if(Auth::user()->support_user_id=='0'){
                return redirect()->intended('home');
            }else{
                return redirect()->intended('support_home');
            }

        } else {

            return redirect('login')->withErrors(['msg' => 'The User Name or Password is incorrect']);
        }
    }

    //use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function logout()
    {
        Auth::logout();
        Session::flush();
        return redirect('login');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function info()
    {
        echo '<pre>';
        //var_dump(Auth::user()->id);
        if (Auth::user()->id) {
            $uid = Auth::user()->id;

            $info = DB::selectOne(DB::raw("SELECT u.id, u.name, u.email, u.email_address, u.course_type,
                dt1.LOOKUP_DATA_NAME AS CTYPE, u.department_id, dt2.LOOKUP_DATA_NAME AS DEPT, u.course_name,
                dt3.LOOKUP_DATA_NAME AS CNAME, u.batch_id, u.student_id, u.USERGRP_ID, u.USERLVL_ID

                FROM users u
                LEFT JOIN sa_lookup_data dt1 ON u.course_type = dt1.LOOKUP_DATA_ID
                LEFT JOIN sa_lookup_data dt2 ON u.department_id = dt2.LOOKUP_DATA_ID
                LEFT JOIN sa_lookup_data dt3 ON u.course_name = dt3.LOOKUP_DATA_ID

                WHERE u.id=$uid
                "));

            //$info = $this->db->query("SELECT * fruits where fruit_type = 5")->result();

            if ($info) {
                var_dump($info);
                echo 'EMAIL = <b>' . $info->email . '</b>';
                echo '<br>';
                echo 'COURSE TYPE = <b>' . $info->CTYPE . ' (' . $info->course_type . ')</b>';
                echo '<br>';
                echo 'DEPARTMENT = <b>' . $info->DEPT . ' (' . $info->department_id . ')</b>';
                echo '<br>';
                echo 'COURSE NAME = <b>' . $info->CNAME . ' (' . $info->course_name . ')</b>';
                echo '<br>';
                echo '<br>';
                echo '<br>';

                if ($info->student_id > 0) {
                    $mxPlace = DB::select(DB::raw("SELECT id, block_placement_id,
                        place_department, parent_course_type, place_course,
                        current_block, sub_block, has_sub
                        FROM tea_block_placement_chd WHERE student_id=$info->student_id ORDER BY id DESC LIMIT 0,1"));

                    if ($mxPlace[0]) {

                        $pct = $mxPlace[0]->parent_course_type;
                        $pd = $mxPlace[0]->place_department;
                        $pc = $mxPlace[0]->place_course;

                        if ($pct) {
                            $mxPlaceCourseType = DB::selectOne(DB::raw("SELECT LOOKUP_DATA_NAME AS title
                                FROM sa_lookup_data WHERE LOOKUP_DATA_ID=$pct"));
                        }
                        if ($pd) {
                            $mxPlaceDept = DB::selectOne(DB::raw("SELECT LOOKUP_DATA_NAME AS title
                                FROM sa_lookup_data WHERE LOOKUP_DATA_ID=$pd"));
                        }
                        if ($pc) {
                            $mxPlaceCourse = DB::selectOne(DB::raw("SELECT LOOKUP_DATA_NAME AS title
                                FROM sa_lookup_data WHERE LOOKUP_DATA_ID=$pc"));
                        }

                        echo '<u><b>Last Placement Data: </b></u><br>';
                        //echo 'Block ID = '.$mxPlace[0]->block_placement_id.'<br>';
                        echo 'Current Block = ' . $mxPlace[0]->current_block . '<br>';
                        if ($mxPlace[0]->has_sub == 0) {
                            echo 'Sub Block = No Sub Block<br>';
                        } else {
                            echo 'Sub Block = ' . $mxPlace[0]->sub_block . '<br>';
                        }
                        echo 'Block Place Chd ID = ' . $mxPlace[0]->id . '<br>';
                        echo 'Place Course = ' . $mxPlaceCourseType->title . '(' . $mxPlace[0]->parent_course_type . ')';
                        echo '<br>';
                        echo 'Place Faculty = ' . $mxPlaceDept->title . '(' . $mxPlace[0]->place_department . ')';
                        echo '<br>';
                        echo 'Place Department = ' . $mxPlaceCourse->title . '(' . $mxPlace[0]->place_course . ')';
                        echo '<br>';
                    }
                }

                echo '<br>';
                echo '<br>';

                var_dump(Auth::user());
            }
        }

        // $mxPlace = DB::selectOne(DB::raw("SELECT MAX(dt1.id) AS MXID
        //     // FROM tea_block_placement_chd AS dt1"));
    }
}
