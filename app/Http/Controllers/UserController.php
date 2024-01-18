<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{   
    protected $user;
    public function __construct(User $user){
        $this->user= $user;
    }

    public function index(Request $request, $opt=''){
        if(!$request->ajax()){
            $url = route('user');
            return redirect()->route('account',['url' => $url]);
        }
        if ($request->ajax() && $opt == 'data') {
            $data = $this->user->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn =  ''; 
                        $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm edit-data " title="edit"  data-id="' . $row->id . '">Edit</a> ';
                        $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm delete-data " title="edit"  data-id="' . $row->id . '">Edit</a>'; 
                        return $btn;
                    })
                    ->addColumn('my_role', function($row){
                        return $row->role->description;
                    })
                    ->addColumn('created_at', function ($row) {
                        return Carbon::parse($row->created_at)->diffForHumans();
                    })
                    ->rawColumns(['created_at', 'action' ])
                    ->make(true);
        }
        $title = 'User';
        return view('admin.user.index', compact('title'))->render();
    }
}
