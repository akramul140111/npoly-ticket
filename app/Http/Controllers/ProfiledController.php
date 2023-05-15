<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use DB;
use Validator,Redirect,Response,File;
use Session;
use Illuminate\Support\Facades\Hash;

class ProfiledController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id=Auth::user()->id;
        $department_id=Auth::user()->department_id;
        $setDesignation=DB::table('set_designation')->get();

        $profile=User::leftJoin('sa_lookup_data','users.department_id','=','sa_lookup_data.LOOKUP_DATA_ID')
        ->leftJoin('set_designation','users.designation','=','set_designation.id')
        ->where('users.id',$user_id)
        ->select('sa_lookup_data.LOOKUP_DATA_NAME as departmentName','set_designation.designation as designationName','users.*')
        ->first();


        return view('teacher_portal.profile.update',compact('profile','setDesignation'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function edit()
    {

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
        $validatedData = $request->validate([
            'image' => 'mimes:png,jpg,jpeg,csv,txt,xlx,xls,pdf,docx,doc|max:6048',
           ]);

          if($request->password==0000){

          $data=[
            'name'         =>$request->name,
            'email'        =>$request->email,
            'email_address'=>$request->email_address,
            'designation'  =>$request->designation,
            'bmdc_no'      =>$request->bmdc_no,
            'address'      =>$request->address,
            'contact_no'   =>$request->contact_no
            ];

        }else{
            $data=[
                'name'         =>$request->name,
                'email'        =>$request->email,
                'email_address'=>$request->email_address,
                'designation'  =>$request->designation,
                'bmdc_no'      =>$request->bmdc_no,
                'address'      =>$request->address ,
                'contact_no'   =>$request->contact_no,
                'password'     => Hash::make($request->password)

                ];
        }

            if(!empty($request->file('image'))){
                $photoId =DB::table('users')->where('users.id',$id)->first();

                if (!empty( $photoId)) {
                    $previousPhoto =$photoId->image;
                    $previousSignature=$photoId->signature;
                }
            }
            if($files = $request->file('image')){
              $destinationPath = public_path('/uploads/teacher/');
              $profileImage = date('Ymd').mt_rand(1000,9999).'.'.$files->getClientOriginalExtension();
              $files->move($destinationPath, $profileImage);
              $data['image'] = $profileImage;

            }
            if($files = $request->file('signature')){
                $destinationPath = public_path('/uploads/teacher/signature/');
                $profileImage = date('Ymd').mt_rand(1000,9999).'.'.$files->getClientOriginalExtension();
                $files->move($destinationPath, $profileImage);
                $data['signature'] = $profileImage;

              }


            if (!empty($previousPhoto)) {

                $file_path = public_path().'/uploads/teacher/'.$previousPhoto;

                if(file_exists($file_path)){
                    unlink($file_path);
                }
            }
            if (!empty($previousSignature)) {

                $file_path = public_path().'/uploads/teacher/'.$previousSignature;

                if(file_exists($file_path)){
                    unlink($file_path);
                }
            }



          DB::table('users')->where('users.id',$id)->update($data);
          return redirect()->back();
          Session::flash('success', "Data update Successfully");
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
