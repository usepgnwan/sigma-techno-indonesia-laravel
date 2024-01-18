<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Articel;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slide_show;
use App\Models\Suply;
use App\Models\Team;
use App\Models\Tentang;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    protected $account;
    public function __construct(Account $account){
        $this->account= $account;
    }

    public function index(Request $request){
        if(!$request->ajax()){
            $url = route('profile');
            return redirect()->route('account',['url' => $url]);
        }
        $title = 'Profile';
        $data = $this->account->first();
        $artikel = Articel::get();
        $tentang = Tentang::first();
        return view('admin.account.index', compact('title','data','artikel','tentang'))->render();
    }
    public function show(){
        $data = $this->account->first();
        return response()->json(['status' => true, 'data' => $data]);
    }
    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'name' => 'required|max:225',
            'description' => 'required',
            'alamat' => 'required',
            'email' => 'required',
            'content' => 'required',
        ]);
        if ($valid->fails()) {
            // return response()->json(['status' => false, 'msg' => $valid->getMessageBag()->toArray()]);
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        }
        $imgName = null;

        $check = $this->account->with('artikel')->first();
        // dd($check);
        $imgName = $check->logo;
        $cover_about = $check->cover_about;
        $cover_artikel = $check->cover_artikel;
        if ($check) {
            if ($request->hasFile('image') && $request->image != '') {
                $image = $request->file('image');
                $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                $extension = $image->getClientOriginalExtension();
                $checkEx = in_array($extension, $allowedfileExtension);
                if ($checkEx) {
                    $path_old = public_path('uploads/image/') . collect(explode('/',$check->image))->last();
                    if (file_exists($path_old) && $check->image != null) {
                        unlink($path_old);
                    }
                    $imgName = $image->hashName();
                    $image->move('uploads/image/', $imgName); 
                    $imgName =asset('uploads/image/'.$imgName); 
                }else{
                    return response()->json(['status' => false, 'errors' => ["image" => ["file not allowed."]]]);
                }
            }
            if ($request->hasFile('cover_about') && $request->cover_about != '') {
                $image = $request->file('cover_about');
                $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                $extension = $image->getClientOriginalExtension();
                $checkEx = in_array($extension, $allowedfileExtension);
                if ($checkEx) {
                    $path_old = public_path('uploads/image/') . collect(explode('/',$check->cover_about))->last();
                    if (file_exists($path_old) && $check->image != null) {
                        unlink($path_old);
                    }
                    $cover_about = $image->hashName();
                    $image->move('uploads/image/', $cover_about); 
                    $cover_about =asset('uploads/image/'.$cover_about); 
                }else{
                    return response()->json(['status' => false, 'errors' => ["image" => ["file not allowed."]]]);
                }
            }
            if ($request->hasFile('cover_artikel') && $request->cover_artikel != '') {
                $image = $request->file('cover_artikel');
                $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                $extension = $image->getClientOriginalExtension();
                $checkEx = in_array($extension, $allowedfileExtension);
                if ($checkEx) {
                    $path_old = public_path('uploads/image/') . collect(explode('/',$check->cover_artikel))->last();
                    if (file_exists($path_old) && $check->image != null) {
                        unlink($path_old);
                    }
                    $cover_artikel = $image->hashName();
                    $image->move('uploads/image/', $cover_artikel); 
                    $cover_artikel =asset('uploads/image/'.$cover_artikel); 
                }else{
                    return response()->json(['status' => false, 'errors' => ["image" => ["file not allowed."]]]);
                }
            }
            
            $data = [
                'name' => $request->name,
                'description' => $request->description, 
                'address' => $request->alamat, 
                'email' => $request->email,
                'artikel_id' => $request->content,
                'phone' => $request->phone,
                'logo' => $imgName, 
                'cover_about' => $cover_about, 
                'cover_artikel' => $cover_artikel, 
                'ig' => $request->ig,
                'twitter' => $request->twitter,
                'fb' => $request->fb,
                'linkedin' => $request->linkedin,
            ];
            $check->fill($data)->save(); 
            return response()->json(['status' => true, 'msg' => 'Update sukses ', 'data' =>  $check,'errors'=>[]], Response::HTTP_OK); 
        }  
    }

    public function upload_tinymce(Request $request){
        // dd($request->file('file'));
        if ($request->hasFile('file')) {
            $allowedfileExtension = ['jpg', 'png', 'jpeg'];
            $image = $request->file('file');  
            $extension = $image->getClientOriginalExtension();
            $check = in_array($extension, $allowedfileExtension); 
            if ($check) {
                $image = $request->file('file');   
                // $filename = $files->store('tinymce', ['disk' => 'public_uploads']);
                $imgName = $image->hashName();
                $image->move('uploads/image/', $imgName); 
                $imgName =asset('uploads/image/'.$imgName);  
                return response()->json(['location' => $imgName], Response::HTTP_OK);
            }else{
                return response()->json(['location' => null ], Response::HTTP_BAD_REQUEST);
            }
        }
    }

    public function icon(){
        return view('admin.account.icon')->render();
    }

    public function about(Request $request){
        $valid = Validator::make($request->all(), [ 
            'content' => 'required', 
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        } 
        $check = Tentang::first(); 
        if ($check) {
            $data = [
                'title' => '-',
                'image' => '-',
                'description' => $request->content,
            ];
            $check->fill($data)->save(); 
            return response()->json(['status' => true, 'msg' => 'Update sukses ', 'data' =>  $check,'errors'=>[]], Response::HTTP_OK); 
        }
    }

    public function resume(Request $request){
        if(!$request->ajax()){
            $url = route('resume');
            return redirect()->route('account',['url' => $url]);
        }
        $slider = Slide_show::get();
        $suply = Suply::get();
        $service = Service::get();
        $project = Project::get();
        $team = Team::get();
        $artikel = Articel::where('status','=','1')->limit(6)->get(); 
        $account = Account::with('artikel')->first();
        $active = '/';  
        // dd('dd');
        return view('admin.resume.index', compact('slider','suply','account','service','artikel','team', 'active','project')); 
    }
} 