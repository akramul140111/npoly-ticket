<?php

namespace App\Http\Controllers\custom_auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use App\Models\User; 
use Hash;

class ResetPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPassword($token)
    {
        // $users=users::get();

        return view('customauth.passwords.reset', ['token' => $token]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function PostPassword(Request $request)
    {
        $request->validate([
            
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
      
        ]);
      
        $updatePassword = DB::table('password_resets')
                            ->where(['token' => $request->token])
                            ->first();
                           
      
        if(!$updatePassword){

            return back()->withInput()->with('error', 'Invalid token!');
        }
          $user =DB::table('users')->where('users.email_address',$updatePassword->email)->update(['password' => Hash::make($request->password)]);
             
          return redirect('/login')->with('message', 'Your password has been changed!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
}
