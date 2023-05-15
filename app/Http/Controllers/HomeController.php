<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\OrganizationInfo;
use DB;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('prevent-back-history');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // support home
    public function support_index()
    {
        return view('support_home');
    }
    public function indexa()
    {
        return view('layouts.indexa');
    }


    public function organizationIndex()
    {

        $header = array(
            'pageTitle'  => 'Organization Setup',
            'tableTitle' => 'Organization Setup List'

        );
        $results = OrganizationInfo::all();
        $orgInfo = DB::table('organization_information')->select('*')->get();
        //dd($orgInfo);
        return view('dashboard_setup.orgIndex', compact('header', 'results', 'orgInfo'));
    }

    public function create(Request $request)
    {

        return view('dashboard_setup.createOrgSetup');
    }

    public function store(Request $request)
    {

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);



            $file = $request->file('image');
            $fileWithExt = $file->getClientOriginalName();
            $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);
            // get file extension
            $extension = $file->getClientOriginalExtension();
            // create unique file name
            $imageOne = $filename . '_' . time() . '.' . $extension;
            // move to destination
            $destination = base_path() . '/public/uploads/imageOne/';
            $file->move($destination, $imageOne);


            $file = $request->file('image2');
            $fileExt = $file->getClientOriginalName();
            $file_name = pathinfo($fileExt, PATHINFO_FILENAME);
            // get file extension
            $ext = $file->getClientOriginalExtension();
            // create unique file name
            $imageTwo = $file_name . '_' . time() . '.' . $ext;
            // move to destination
            $destination = base_path() . '/public/uploads/imageTwo/';
            $file->move($destination, $imageTwo);


            //$path = $request->file('image')->store('public/images');
            //$path2 = $request->file('image2')->store('public/images');
            $post = new OrganizationInfo;
            $post->organization_name = $request->organization_name;
            $post->organization_phone = $request->organization_phone;
            $post->organization_mobile = $request->organization_mobile;
            $post->organization_image_one = $imageOne;
            $post->organization_image_two = $imageTwo;
            $post->organization_address = $request->organization_address;
            $post->organization_email = $request->organization_email;
            $post->active_status = $request->active_status;
            $post->save();
            Session::flash('success', 'Data Saved successfully!');
            return response()->json(['success' => 'saved']);
        }
    }
    public function editOrgInfo(Request $request, $id)
    {
        $header = array(
            'pageTitle'  => 'Organization Setup',
            'tableTitle' => 'Organization Setup List'

        );
        $orgInfo = DB::table('organization_information')->select('*')->where('organization_id', $id)->first();
        //dd($orgInfo);
        return view('dashboard_setup.editOrgInfo', compact('header', 'orgInfo', 'id'));
    }

    public function updateOrgInfo(Request $request, $id)
    {

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            ]);
            if (!empty($request->file('image'))) {
                $file = $request->file('image');
                $fileWithExt = $file->getClientOriginalName();
                $filename = pathinfo($fileWithExt, PATHINFO_FILENAME);
                // get file extension
                $extension = $file->getClientOriginalExtension();
                // create unique file name
                $imageOne = $filename . '_' . time() . '.' . $extension;
                // move to destination
                $destination = base_path() . '/public/uploads/imageOne/';
                $file->move($destination, $imageOne);

                $file = $request->file('image2');
                $fileExt = $file->getClientOriginalName();
                $file_name = pathinfo($fileExt, PATHINFO_FILENAME);
                // get file extension
                $ext = $file->getClientOriginalExtension();
                // create unique file name
                $imageTwo = $file_name . '_' . time() . '.' . $ext;
                // move to destination
                $destination = base_path() . '/public/uploads/imageTwo/';
                $file->move($destination, $imageTwo);

                $post = OrganizationInfo::find($id);
                $post->organization_image_one = $imageOne;
                $post->organization_image_two = $imageTwo;
                $post->save();
            }


            //$path = $request->file('image')->store('public/images');
            //$path2 = $request->file('image2')->store('public/images');


        }
        $post = OrganizationInfo::find($id);
        $post->organization_name = $request->organization_name;
        $post->organization_phone = $request->organization_phone;
        $post->organization_mobile = $request->organization_mobile;
        $post->organization_address = $request->organization_address;
        $post->organization_email = $request->organization_email;
        $post->active_status = $request->active_status;
        $post->save();
        Session::flash('success', 'Data Saved successfully!');
        return response()->json(['success' => 'saved']);
    }

    public function newsDetails($id){
        $newsDetails = DB::table('npoly_support_news')
            ->select('news_title','news_desc','news_image')
            ->where('news_id',$id)
            ->first();
        return view('news.newsDetails',compact('newsDetails'));
    }
}
