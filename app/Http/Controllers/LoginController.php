<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Response;

class LoginController extends Controller
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index()
    {
        return view('login.login');
    }
    public function authenticate(Request $request)
    {
        $login = $request->email; 
        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$fieldType => $login]);
        // create credentials for attempt
        $Thiscredentials = [$fieldType => $fieldType == 'email' ? 'required|email:dns' : 'required', 'password' => 'required']; 
        $valid = Validator::make($request->all(),$Thiscredentials);
         
        if ($valid->fails()) {
            // return response()->json(['status' => false, 'msg' => $valid->getMessageBag()->toArray()]);
            $err =  collect($valid->errors());
            if(!isset($err['email']))  $err['email'] =["The username/email field is required."]; 
            return response()->json(['status' => false, 'errors' => $err ]);
        }
        $credentials = [$fieldType => $request->email , 'password' => $request->password]; 
       
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::User();
            Session::put('user', $user);
            // return response()->json(session()->all());
            // return redirect()->intended('dashboard');
            return response()->json([
                'status' => true,
                'valid'=>true,
                'message' => 'Sukses, Login Berhasil',
                'data' => auth()->user(),
                'errors' => []
            ]);
        }
        return response()->json(['status' => false, 'valid'=>true, 'errors' => ['email'=>['not valid email/username or password is wrong.']]]);
      
        // return back()->with('login_error', 'Error Periksa Kembali Email Atau Password');
    }
    public function registrasi(Request $request){
        $validate = Validator::make($request->all(), [
            'nama' => 'required',
            'no_telp' => 'required|min:11|numeric',
            'email' => 'required|email:dns|unique:users,email',
            'password' => 'min:6',
            'repeat_password' => 'min:6|same:password',
            'tanggal_lahir'=>'required',
            'jenis_kelamin'=>'required'
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false, 'valid'=>false, 'msg' => 'Gagal, veriksa kembali form isian', 'data' => $validate->errors()]);
        }

        $data = [
            'name' => $request->nama,
            'username' => $request->nama,
            'no_telp' =>  $request->no_telp,
            'email' =>  $request->email,
            'tanggal_lahir' =>  $request->tanggal_lahir,
            'jenis_kelamin' =>  $request->jenis_kelamin,
            'role_id' => 2,
            'password' => bcrypt($request->password),
            'privacy_term'=>$request->privacy_policy
        ];

        $response =  User::create($data);
        session()->flash('success', 'Berhasil Registrasi, Selamat Berbelanja.');
        return response()->json([
            'status'=>true,
            'valid'=>true,
            'msg' => 'Berhasil Registrasi, Selamat Berbelanja.',
            'data'=> $response
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return response()->json([
            'status' => true,
            'msg' => 'Logout Success'
        ]);
        // return redirect()->route('login');
    }

    public function change_password(Request $request){
        $validate = Validator::make($request->all(),[
            'old_password' => ['required', new MatchOldPassword],
            'new_password'=>'min:6',
            'repeat_password'=>'min:6|same:new_password'
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => false,  'msg' => 'Gagal, veriksa kembali form isian', 'errors' => $validate->errors()]);
        }
        $data = ['password'=> bcrypt($request->new_password)];

        $check = $this->user->find(auth()->user()->id)->update($data);
        if($check){
            return response()->json([
                'status' => true,
                'msg' => 'Berhasil, Ubah Password',
                'data' => auth()->user(),
                'errors' => []
            ]);
        }
    }

    public function change_profile(Request $request){

        // dd($request);
        $valid = Validator::make($request->all(), [
            'nama' => 'required|max:225'
        ]);
        if ($valid->fails()) {
            return response()->json(['status' => false, 'data' => $valid->errors()]);
        }
        $imgName = null;

        $check = $this->user->find(auth()->user()->id);
        $imgName = $check->foto;
        if ($check) {
            if ($request->hasFile('foto') && $request->foto != null) {
                $image = $request->file('foto');
                $allowedfileExtension = ['jpg', 'png', 'jpeg'];
                $extension = $image->getClientOriginalExtension();
                $checkEx = in_array($extension, $allowedfileExtension);
                if ($checkEx) { 
                    $path_old = public_path('uploads/image/') . collect(explode('/',$check->image))->last();
                    if (file_exists($path_old) && $check->image != null) {
                        unlink($path_old);
                    }
                    $imgName = $image->hashName();
                    $image->move('uploads/image/', $imgName); 
                    $imgName =asset('uploads/image/'.$imgName); 
                }else{
                    return response()->json(['status' => false, 'data' => ["foto" => ["file not allowed."]]]);
                }
            } 
            $data = [
                'name' => $request->nama,
                'foto' => $imgName, 
            ]; 
            $check->fill($data)->save(); 
            Session::put('user',$check);
            return response()->json(['status' => true, 'msg' => 'Update sukses ', 'data' =>  $check], Response::HTTP_OK); 
        }
    }
}
