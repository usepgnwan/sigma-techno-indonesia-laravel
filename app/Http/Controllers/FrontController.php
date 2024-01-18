<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Articel;
use App\Models\Category;
use App\Models\Project;
use App\Models\Qna;
use App\Models\Service;
use App\Models\Slide_show;
use App\Models\Suply;
use App\Models\Team;
use App\Models\Tentang;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        $slider = Slide_show::get();
        $suply = Suply::get();
        $service = Service::get();
        $project = Project::get();
        $team = Team::get();
        $artikel = Articel::where('status','=','1')->limit(6)->get(); 
        $account = Account::with('artikel')->first();
        $active = '/';  
 
        return view('front.index', compact('slider','suply','account','service','artikel','team', 'active','project')); 
    }

    public function about(){
        $about = Tentang::first();
        $team = Team::get();
        $faq = Qna::get();
        $service = Service::get();
        $active = 'tentang';
        return view('front.about', compact('about','team','faq', 'active','service')); 
    }

    public function articel(Request $request){
        $id_category = $request->category; 
        if(!is_null($id_category)){ 
            $check = Category::where("id", "=",$id_category)->first();
            if(is_null($check)){
            abort('404');
            }
        }
        // dd($check);
        $active = 'artikel';
        $artikel =  Articel::get();
        $service = Service::get();
        $category = Category::get();
        return view('front.artikel', compact('artikel','category','active','service','id_category')); 
    }
    public function team(){ 
        $team = Team::get(); 
        $active = 'team';
        $service = Service::get();
        return view('front.team', compact( 'team' , 'active','service')); 
    }
    public function contact(){
        $service = Service::get();
        $active = 'kontak';
        return view('front.contact', compact('active','service')); 
    }


    public function detail_artikel($slug){
        $service = Service::get();
        $check =  Articel::where('slug', '=', $slug)->first();
        $random =  Articel::inRandomOrder()->limit(8)->get();
        $category = Category::get();
        $active = 'artikel';
        if ($check) { 
          return  view('front.detail_artikel', compact('check','active','category','random','service')); 
        }

        // echo  "data tidak ditemukan";
        abort(404);
    }

    public function content_articel(Request $request){
        if (!$request->ajax()  ) {
            return redirect()->route('front.content.artikel');
        }
        $id = $request->category;
        $id = $id != 0 ? $id : null; 
        $status = $request->status;
        $artikel =  Articel::when($id ?? false, function($query) use ($id){  
            $query->where("categories_id", "=" , $id);
        })->paginate(6)->withQueryString();

        $html = view('front.artikel.content_artikel', compact('artikel', 'status'))->render();
        $arr = ["view"=> $html, "data"=>$artikel];
        return response()->json($arr); 
    }
}
