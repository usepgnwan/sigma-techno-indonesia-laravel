<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class AssetController extends Controller
{
    protected $asset;
    public function __construct(Asset $asset){
        $this->asset= $asset;
    }

    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('asset');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->asset->get();
            
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =  ''; 
                        $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm edit-data" title="edit"  data-id="' . $row->id . '"><span class="ri-edit-box-fill"></span></a> ';
                        $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm delete-data" title="delete"  data-id="' . $row->id . '"><span class="ri-delete-bin-5-line"></span></a>'; 
                        return $btn;
                    })
                    ->addColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->format('d M Y H:i:s');
                    })
                    ->rawColumns(['created_at', 'action' ])
                    ->make(true);
        }
        $title = 'User';
        return view('admin.assets.index', compact('title'))->render();
    }

    public function show(Request $request, $id=""){
        $data = [];
        if($id != "add"){
            $data = $this->asset->find($id); 
        }
        return view('admin.assets.form', compact('data'))->render();
    }
    
    public function store(Request $request){
        $valid = Validator::make($request->all(), [
            'jumlah' => 'required',
            'description' => 'required',
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        }
        $res = ['status' => false,'msg'=>'errors', 'errors' => []];
        if($request->id =='add'){
            $this->asset->create(['description'=>$request->description, "jumlah"=> $request->jumlah]);
            $res = ['status' => true,'msg'=>'Success add data', 'errors' => []];
        }else{
            $check = $this->asset->find($request->id);
            $data = ['description' => $request->description, "jumlah"=> $request->jumlah]; 
            $check->fill($data)->save(); 
            $res = ['status' => true,'msg'=>'Success edit data', 'errors' => []];
        }
        
        return response()->json($res);
    }
    public function destroy($id)
    {
        $check = $this->asset->find($id);

        if ($check) {
            $check->delete();
            return response()->json(['status' => true, 'msg' => 'Berhasil Hapus Data'], Response::HTTP_OK);
        }
        return response()->json(['status' => false, 'msg' => 'Gagal Hapus Data'], Response::HTTP_BAD_REQUEST);
    }
}
