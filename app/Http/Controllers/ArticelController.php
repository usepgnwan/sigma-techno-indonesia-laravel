<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Articel;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ArticelController extends Controller
{
    protected $artikel;
    public function __construct(Articel $artikel){
        $this->artikel= $artikel;
    }

    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('artikel');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->artikel->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =  ''; 
                        $btn = '<div   style="width:70px">
                   <a href="javascript:void(0)" class="btn btn-primary btn-sm edit-data" title="edit"  data-id="' . $row->id . '"><span class="ri-edit-box-fill"></span></a> 
                      <a href="javascript:void(0)" class="btn btn-danger btn-sm delete-data" title="delete"  data-id="' . $row->id . '"><span class="ri-delete-bin-5-line"></span></a> 
                        <div>'; 
                        return $btn;
                    })
                    ->addColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->diffForHumans();
                    })
                    ->addColumn('foto', function ($row) {
                        return $row->foto ? '<img src="'. $row->foto .'" alt="artikel" width="170" height="170">' : '-';
                    })
                    ->addColumn('category', function ($row) {  
                        return $row->category->description ?? "";
                    })
                    ->addColumn('status', function ($row) {  
                        return $row->status ? "Aktif" : 'Tidak Aktif';
                    })
                    ->addColumn('body', function ($row) {  
                        return strip_tags(\Str::limit($row->body,'250'));
                    })
                    ->addColumn('short_body', function ($row) {  
                        return \Str::limit($row->short_body,'250');
                    })
                    ->addColumn('youtube', function ($row) {
                        return  is_null($row->youtube) ? '-' : '<a href="' . $row->youtube .'" class="glightbox btn"> <i class="ri-play-circle-line"></i> </a>';
                    })
                    ->rawColumns(['created_at', 'action','foto','category','status','short_body','youtube'])
                    ->make(true);
        }
        
        $title = 'artikel';
        return view('admin.artikel.index', compact('title'))->render();
    }

    public function show(Request $request, $id=""){
        $data = [];
        if($id != "add"){
            $data = $this->artikel->find($id); 
        }
        $kategori = Category::get();
        // dd($data);
        return view('admin.artikel.form', compact('data','kategori'))->render();
    }
    
    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'title' => 'required', 
            'categories_id' => 'required', 
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        }
        $res = ['status' => false,'msg'=>'errors', 'errors' => []];
     
        $imgName = null;
        if($request->id =='add'){ 
            if ($request->hasFile('foto') && $request->foto != '') { 
                $image = $request->file('foto'); 
                $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                $extension = $image->getClientOriginalExtension();
                $checkEx = in_array($extension, $allowedfileExtension);
                if ($checkEx) { 
                    $imgName = $image->hashName();
                    $image->move('uploads/image/', $imgName); 
                    $imgName =asset('uploads/image/'.$imgName); 
                }else{
                    return response()->json(['status' => false, 'errors' => ["image" => ["file not allowed."]]]);
                }
            }  
            $this->artikel->create([ 
                'title' => $request->title, 
                'categories_id' => $request->categories_id, 
                'youtube' => $request->youtube, 
                'short_body' => $request->short_body, 
                'body' => $request->body, 
                'foto' => $imgName, 
                'status' => isset($request->status) && $request->status =='on' ? true : false, 
            ]);
            $res = ['status' => true,'msg'=>'Success add data', 'errors' => []];
        }else{
            $check = $this->artikel->find($request->id); 
            $imgName = $check->foto;
            if ($check) {
                if ($request->hasFile('foto') && $request->foto != '') {
                    $image = $request->file('foto');
                    $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                    $extension = $image->getClientOriginalExtension();
                    $checkEx = in_array($extension, $allowedfileExtension);
                    if ($checkEx) {
                        $path_old =  public_path('uploads/image/') . collect(explode('/',$check->foto))->last();
                        if (file_exists($path_old) && $check->foto != null) {
                            unlink($path_old);
                        }
                        $imgName = $image->hashName();
                        $image->move('uploads/image/', $imgName); 
                        $imgName =asset('uploads/image/'.$imgName); 
                    }else{
                        return response()->json(['status' => false, 'errors' => ["image" => ["file not allowed."]]]);
                    }
                }
                
                $data = [ 
                    'title' => $request->title, 
                    'categories_id' => $request->categories_id,
                    'youtube' => $request->youtube,  
                    'short_body' => $request->short_body, 
                    'body' => $request->body, 
                    'foto' => $imgName, 
                    'status' => isset($request->status) && $request->status =='on' ? true : false, 
                ];
                $check->fill($data)->save(); 
                return response()->json(['status' => true, 'msg' => 'Update sukses ', 'data' =>  $check,'errors'=>[]], Response::HTTP_OK); 
            } 
        } 
        return response()->json($res);
    }
    public function destroy($id)
    {
        $check = $this->artikel->find($id);
        if ($check) {
        $path_old =  public_path('uploads/image/') . collect(explode('/',$check->foto))->last();
        if (file_exists($path_old) && $check->foto != null) {
            unlink($path_old);
        }
            $check->delete();
            return response()->json(['status' => true, 'msg' => 'Berhasil Hapus Data'], Response::HTTP_OK);
        }
        return response()->json(['status' => false, 'msg' => 'Gagal Hapus Data'], Response::HTTP_BAD_REQUEST);
    }

    public function view($slug)
    {
        $check = $this->artikel->where('slug', '=', $slug)->first();
 

        if ($check) {
            echo "
            <div class='table-responsive'> " . $check->body ."</div>
            ";
          return;
        }

        echo  "data tidak ditemukan";
    }

    public function sort($id, $idarticel){
        $check = $this->artikel->where('categories_id', '=', $id)->get();
        if(count($check) > 0){ 
            return response()->json(['data'=> $check]);
        }
        return response()->json(['data'=> [['id'=>'0','title'=> 'Data tidak ditemukan']]]);
 
        
    }
}
