<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Tracker;

class FontHomeController extends Controller
{
    public function home(){
        return view('auth.login');
        }
}
