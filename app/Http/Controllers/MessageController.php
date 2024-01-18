<?php

namespace App\Http\Controllers;

use App\Models\Messages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class MessageController extends Controller
{
    protected $msg;
    public function __construct(Messages $msg)
    {
        $this->msg = $msg;
    }
    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('message');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->msg->get(); 
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
        $title = 'message';
        return view('admin.message.index', compact('title'))->render();
    }

    public function store(Request $request){
        $valid = Validator::make($request->all(), [ 
            'name' => 'required', 
            'phone' => 'required', 
            'email' => 'required|email:dns',
            'pesan' => 'required', 
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        }
        $res = ['status' => false,'msg'=>'errors', 'errors' => []];
    
        $imgName = null;
        if($request->id =='add'){  
            $this->msg->create([
                'name' => $request->name,
                'phone' => $request->phone, 
                'email' => $request->email, 
                'pesan' => $request->pesan,  
            ]);
            $res = ['status' => true,'msg'=>'Terima Kasih Pesan Anda telah terkirim..', 'errors' => []];
        }else{
            $check = $this->msg->find($request->id); 
             
                $data = [
                    'name' => $request->name,
                    'phone' => $request->phone, 
                    'email' => $request->email, 
                    'pesan' => $request->pesan,  
                ];
                $check->fill($data)->save(); 
                return response()->json(['status' => true, 'msg' => 'Update sukses ', 'data' =>  $check,'errors'=>[]], Response::HTTP_OK); 
            
        } 
        return response()->json($res);
    }

    public function all_list(){ 
        $limit = $this->msg->limit(5)->get();
        $count = $this->msg->get()->count();
        return response()->json(['limit' => $limit, 'count' => $count ], Response::HTTP_OK); 
    }
}
