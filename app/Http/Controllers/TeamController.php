<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TeamController extends Controller
{
    protected $team;
    public function __construct(Team $team){
        $this->team= $team;
    }

    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('team');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->team->get(); 
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
                        return $row->foto ? '<img src="'. $row->foto .'" alt="team" width="170" height="170">' : '-';
                    })
                    ->rawColumns(['created_at', 'action','foto'])
                    ->make(true);
        }
        $title = 'Team';
        return view('admin.team.index', compact('title'))->render();
    }

    public function show(Request $request, $id=""){
        $data = [];
        if($id != "add"){
            $data = $this->team->find($id); 
        }
        return view('admin.team.form', compact('data'))->render();
    }
    
    public function store(Request $request){
        $valid = Validator::make($request->all(), [ 
            'name' => 'required', 
            'title' => 'required', 
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'errors' => $valid->errors()]);
        }
        $res = ['status' => false,'msg'=>'errors', 'errors' => []];
        $account  = Account::first(); 
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
            // dd([
            //     'account_id' => $account->id,
            //     'description' => $request->description, 
            //     'name' => $request->name, 
            //     'title' => $request->title, 
            //     'foto' => $imgName, 
            // ]);
            $this->team->create([
                'account_id' => $account->id,
                'description' => $request->description, 
                'name' => $request->name, 
                'title' => $request->title, 
                'foto' => $imgName, 
            ]);
            $res = ['status' => true,'msg'=>'Success add data', 'errors' => []];
        }else{
            $check = $this->team->find($request->id); 
            $imgName = $check->foto;
            if ($check) {
                if ($request->hasFile('image') && $request->image != '') {
                    $image = $request->file('image');
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
                    'account_id' => $account->id,
                    'description' => $request->description, 
                    'name' => $request->name, 
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
        $check = $this->team->find($id);
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
