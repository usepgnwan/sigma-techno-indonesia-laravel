<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Category;
use App\Models\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    protected $project;
    public function __construct(Project $project){
        $this->project= $project;
    }

    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('project');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->project->get(); 
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
                    ->addColumn('image', function ($row) {
                        return $row->image ? '<img src="'. $row->image .'" alt="slider" width="170" height="170">' : '-';
                    })
                    ->addColumn('status', function ($row) {
                        return ($row->status)  ?   '<span class="badge rounded-pill bg-primary">Aktif</span>' : '-';
                    }) 
                    ->rawColumns(['created_at', 'action','image','artikel', 'status'])
                    ->make(true);
        }
        $title = 'project';
        return view('admin.project.index', compact('title'))->render();
    }

    public function show(Request $request, $id=""){
        $data = [];
        if($id != "add"){
            $data = $this->project->find($id); 
        }
        $kategori = Category::get();
        // dd($data);
        return view('admin.project.form', compact('data','kategori'))->render();
    }
    
    public function store(Request $request){
        $valid = Validator::make($request->all(), [ 
            'title' => 'required', 
            'description' => 'required',
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        }
        $res = ['status' => false,'msg'=>'errors', 'errors' => []]; 
        $imgName = null;
        if($request->id =='add'){ 
            if ($request->hasFile('image') && $request->image != '') { 
                $image = $request->file('image');
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
            $this->project->create([ 
                'id_articel' => $request->artikel, 
                'title' => $request->title, 
                'description' => $request->description, 
                'image' => $imgName,
                'status' => isset($request->status) && $request->status =='on' ? true : false, 
            ]);
            $res = ['status' => true,'msg'=>'Success add data', 'errors' => []];
        }else{
            $check = $this->project->find($request->id); 
            $imgName = $check->image;
            if ($check) {
                if ($request->hasFile('image') && $request->image != '') {
                    $image = $request->file('image');
                    $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                    $extension = $image->getClientOriginalExtension();
                    $checkEx = in_array($extension, $allowedfileExtension);
                    if ($checkEx) {
                        $path_old =  public_path('uploads/image/') . collect(explode('/',$check->image))->last();
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
                
                $data = [ 
                    'id_articel' => $request->artikel,
                    'title' => $request->title, 
                    'description' => $request->description, 
                    'image' => $imgName, 
                    
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
        $check = $this->project->find($id);
        if ($check) {
        $path_old =  public_path('uploads/image/') . collect(explode('/',$check->image))->last();
        if (file_exists($path_old) && $check->image != null) {
            unlink($path_old);
        }
            $check->delete();
            return response()->json(['status' => true, 'msg' => 'Berhasil Hapus Data'], Response::HTTP_OK);
        }
        return response()->json(['status' => false, 'msg' => 'Gagal Hapus Data'], Response::HTTP_BAD_REQUEST);
    }
}
