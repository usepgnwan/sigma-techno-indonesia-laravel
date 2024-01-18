<?php

namespace App\Http\Controllers;

use App\Models\Qna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator as FacadesValidator; 
use Yajra\DataTables\Facades\DataTables;

class QnaController extends Controller
{

    protected $faq;
    public function __construct(Qna $faq){
        $this->faq= $faq;
    }

    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('faq');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->faq->get();
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
                     
                    ->rawColumns(['created_at', 'action'])
                    ->make(true);
        }
        
        $title = 'faq';
        return view('admin.faq.index', compact('title'))->render();
    }

    public function show(Request $request, $id=""){
        $data = [];
        if($id != "add"){
            $data = $this->faq->find($id); 
        } 
        return view('admin.faq.form', compact('data'))->render();
    }
    
    public function store(Request $request){
        $valid = FacadesValidator::make($request->all(), [
            'title' => 'required', 
            'description' => 'required', 
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        }
 
     
 
        if($request->id =='add'){ 
            
            $this->faq->create([ 
                'title' => $request->title, 
                'description' => $request->description,  
            ]);
            $res = ['status' => true,'msg'=>'Success add data', 'errors' => []];
        }else{
            $check = $this->faq->find($request->id); 
            $imgName = $check->foto;
            if ($check) { 
                $data = [ 
                    'title' => $request->title,
                    'description' => $request->description,  
                ];
                $check->fill($data)->save(); 
                return response()->json(['status' => true, 'msg' => 'Update sukses ', 'data' =>  $check,'errors'=>[]], Response::HTTP_OK); 
            } 
        } 
        return response()->json($res);
    }
    public function destroy($id)
    {
        $check = $this->faq->find($id);
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
