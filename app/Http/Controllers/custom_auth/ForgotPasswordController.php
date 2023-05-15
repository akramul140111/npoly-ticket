<?php

namespace App\Http\Controllers\custom_auth;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Mail;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Session;


class ForgotPasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEmail()
    {
        return view('customauth.passwords.email');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $request->validate([
            'email_address' => 'required|email|exists:users',
        ]);

        $token = Str::random(40);

          DB::table('password_resets')->insert(
              ['email' => $request->email_address, 'token' => $token, 'created_at' => Carbon::now()]
          );

          Mail::send('customauth.verify', ['token' => $token], function($message) use($request){
              $message->to($request->email_address);
              $message->subject('Reset Password Notification');
          });

          return back()->with('message', 'We have e-mailed your password reset link!');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function changePassword()
    {
      return view('auth.passwords.changePassword');
    }
    public function saveChangePassword (Request $request)
    {
        $rules = array(
             // 'currentPassword' => ['required', Hash::check($request->currentPassword, auth()->user()->password)],
            'password'         => 'required',
            // 'password_confirm' => 'required|same:password'
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('home')->with('errors','Password & Confirm password does not matched');
        }

        $hashedPassword = Auth::user()->password;
        if (\Hash::check($request->currentPassword , $hashedPassword)) {
            if (\Hash::check($request->currentPassword , $hashedPassword)) {
 
                // $userId = Auth:: user()->id;
                // $newPassword = $request->password;
                // $user = User::find($userId);
                // $user->password = Hash::make($newPassword);
                // $user->update();
                User::whereId(auth()->user()->id)->update([
                    'password' => Hash::make($request->password)
                ]);
                Session::flash('passChange', "Password Change Sucessfullly!");
                return Redirect::to('home');
            }
            else{
                session()->flash('errors','new password can not be the old password!');
                return redirect()->back();
            } 
        }
        else{
            session()->flash('errors','old password doesnt matched');
            return redirect()->back();
        }





       
    }
}
