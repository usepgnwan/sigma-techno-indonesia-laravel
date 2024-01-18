<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Suply;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SuplyController extends Controller
{
    protected $supply;
    public function __construct(Suply $supply){
        $this->supply= $supply;
    }

    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('supply');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->supply->get(); 
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
                    ->addColumn('foto', function ($row) {
                        return $row->foto ? '<img src="'. $row->foto .'" alt="supply" width="170" height="170">' : '-';
                    })
                    ->rawColumns(['created_at', 'action','foto'])
                    ->make(true);
        }
        $title = 'supply';
        return view('admin.supply.index', compact('title'))->render();
    }

    public function show(Request $request, $id=""){
        $data = [];
        if($id != "add"){
            $data = $this->supply->find($id); 
        }
        return view('admin.supply.form', compact('data'))->render();
    }
    
    public function store(Request $request){
        $valid = Validator::make($request->all(), [  
            'title' => 'required',  
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
            $this->supply->create([ 
                'title' => $request->title, 
                'foto' => $imgName, 
            ]);
            $res = ['status' => true,'msg'=>'Success add data', 'errors' => []];
        }else{
            $check = $this->supply->find($request->id); 
            $imgName = $check->foto;
            if ($check) {
                if ($request->hasFile('image') && $request->image != '') {
                    $image = $request->file('image');
                    $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                    $extension = $image->getClientOriginalExtension();
                    $checkEx = in_array($extension, $allowedfileExtension);
                    if ($checkEx) {
                        $path_old =  public_path('uploads/image/') . collect(explode('/',$check->image))->last();
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
                    'foto' => $imgName, 
                ];
                $check->fill($data)->save(); 
                return response()->json(['status' => true, 'msg' => 'Update sukses ', 'data' =>  $check,'errors'=>[]], Response::HTTP_OK); 
            } 
        } 
        return response()->json($res);
    }
    public function destroy($id)
    {
        $check = $this->supply->find($id);
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
