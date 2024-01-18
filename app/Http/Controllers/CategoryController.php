<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(Category $category){
        $this->category= $category;
    }

    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('category');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->category->get();
            
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
                    ->rawColumns(['created_at', 'action'])
                    ->make(true);
        }
        $title = 'User';
        return view('admin.category.index', compact('title'))->render();
    }

    public function show(Request $request, $id=""){
        $data = [];
        if($id != "add"){
            $data = $this->category->find($id); 
        } 
        return view('admin.category.form', compact('data'))->render();
    }
    
    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'description' => 'required|max:225',
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        }
        $res = ['status' => false,'msg'=>'errors', 'errors' => []];
        if($request->id =='add'){
            $this->category->create([
                'description' => $request->description, 
            ]);
            $res = ['status' => true,'msg'=>'Success add data', 'errors' => []];
        }else{
            $check = $this->category->find($request->id);
            $data = [
                'description' => $request->description, 
            ]; 
            $check->fill($data)->save(); 
            $res = ['status' => true,'msg'=>'Success edit data', 'errors' => []];
        }
        
        return response()->json($res);
    }
    public function destroy($id)
    {
        $check = $this->category->find($id);

        if ($check) {
            $check->delete();
            return response()->json(['status' => true, 'msg' => 'Berhasil Hapus Data'], Response::HTTP_OK);
        }
        return response()->json(['status' => false, 'msg' => 'Gagal Hapus Data'], Response::HTTP_BAD_REQUEST);
    }
}
