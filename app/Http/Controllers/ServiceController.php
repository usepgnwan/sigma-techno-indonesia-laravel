<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    protected $service;
    public function __construct(Service $service){
        $this->service= $service;
    }

    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('service');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->service->get(); 
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =  ''; 
                        $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm edit-data" title="edit"  data-id="' . $row->id . '"><span class="ri-edit-box-fill"></span></a> ';
                        $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm delete-data" title="delete"  data-id="' . $row->id . '"><span class="ri-delete-bin-5-line"></span></a>'; 
                        return $btn;
                    })
                    ->addColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->diffForHumans();
                    }) 
                    ->addColumn('artikel', function ($row) {
                        return !is_null($row->artikel)  ? '<a class="btn btn-primary view-content"  data-slug="' . $row->artikel->slug . '"><i class="ri-file-copy-2-line"></i></a>' : '<span class="badge rounded-pill bg-danger">No Content</span>';
                    })
                    ->addColumn('status', function ($row) {
                        return ($row->status)  ?   '<span class="badge rounded-pill bg-primary">Aktif</span>' : '-';
                    })
                    ->addColumn('icon', function ($row) {
                        return !is_null($row->icon)  ? '<span class="badge rounded-pill bg-primary"><i class="'. $row->icon .'"></i></span>' : '-';
                    })
                    ->rawColumns(['created_at', 'action','foto','artikel','icon','status'])
                    ->make(true);
        }
        $title = 'service';
        return view('admin.service.index', compact('title'))->render();
    }

    public function show(Request $request, $id=""){
        $data = [];
        if($id != "add"){
            $data = $this->service->find($id); 
        }
        $kategori = Category::get();
        // dd($data);
        return view('admin.service.form', compact('data','kategori'))->render();
    }
    
    public function store(Request $request){
        $valid = Validator::make($request->all(), [ 
            'title' => 'required', 
            'icon' => 'required',
            'description' => 'required',
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        }
        $res = ['status' => false,'msg'=>'errors', 'errors' => []]; 
        if($request->id =='add'){
            $this->service->create([ 
                'id_articel' => $request->artikel, 
                'title' => $request->title, 
                'icon' => $request->icon, 
                'description' => $request->description,  
                'status' => isset($request->status) && $request->status =='on' ? true : false, 
            ]);
            $res = ['status' => true,'msg'=>'Success add data', 'errors' => []];
        }else{
            $check = $this->service->find($request->id);  
            if ($check) { 
                $data = [ 
                    'id_articel' => $request->artikel,
                    'title' => $request->title, 
                    'icon' => $request->icon, 
                    'description' => $request->description, 
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
        $check = $this->service->find($id);
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
}