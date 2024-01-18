<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ArticelController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PacketController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QnaController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SuplyController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::controller(FrontController::class)->prefix('/')->group(function(){ 
    Route::get('/','index');
    Route::get('/tentang','about')->name('tentang');
    Route::get('/artikel/{category?}','articel')->name('front.artikel');
    Route::get('/content/artikel/{category?}','content_articel')->name('front.content.artikel');
    Route::get('/artikel/detail/{slug?}','detail_artikel')->name('front.artikel.detail');
    Route::get('/kontak','contact')->name('kontak'); 
    Route::get('/team','team')->name('front.team');

}); 

Route::post('/kontak',[MessageController::class, 'store'])->name('kontak.post');
Route::prefix('integrated')->group(function(){
    Route::get('login', function(){
        return view('user.login.login'); 
    });
    Route::get('display/system', function(){ 
        $token = random_bytes(3);

        // Since random_bytes() returns a string with all kinds of bytes, 
        // it can't be presented "as is".
        // We need to convert it to a better format. Let's use hex
        $token = bin2hex($token);
        // dd($token);
        return view('user.front'); 
    });
});

Route::prefix('auth')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
    Route::post('/login',  [LoginController::class, 'authenticate'])->name('auth.login')->middleware('guest');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/register', [LoginController::class, 'registrasi'])->name('regis');
    Route::post('/change/password', [LoginController::class, 'change_password'])->name('change.password'); 
});

Route::prefix('account')->group(function () {
    Route::controller(AccountController::class)->group(function(){
        Route::get('/profile/show', 'show')->name('profile.show');
    });
    Route::controller(AccountController::class)->group(function(){
        Route::get('/resume', 'resume')->name('resume');
    });
    Route::middleware('auth')->group(function(){
        Route::get('/', function (Request $request) {   
            $url = $request->url ?? '';
            return view('admin.index', compact('url')); 
        })->name('account');
        Route::get('/dashboard', function (Request $request) { 
            if(!$request->ajax()){
                $url = route('dashboard');
                return redirect()->route('account',['url' => $url]);
            }
            $title = "Dashboard";
            return view('admin.dashboard.index', compact('title')) ;
        })->name('dashboard');
        // BAGIAN PROFILE 
        Route::controller(AccountController::class)->group(function(){ 
            Route::post('/upload/tinymce', 'upload_tinymce')->name('upload.tinymce');
            Route::get('/profile', 'index')->name('profile');
            Route::post('/profile', 'store')->name('profile.post');
            Route::get('/list/icon', 'icon')->name('list.icon');
            Route::post('/about', 'about')->name('about.post');
        });
        // BAGIAN USER 
        Route::get('/user/{opt?}', [UserController::class, 'index'])->name('user');
        Route::get('/change/user', function () { return view('admin.account.change_user'); })->name('user.modal');
        Route::post('/change/user',  [LoginController::class, 'change_profile'])->name('change.user');
        // BAGIAN category 
        Route::controller(CategoryController::class)->prefix('category')->group(function(){ 
            Route::get('/{opt?}', 'index')->name('category');
            Route::post('/', 'store')->name('category.post');
            Route::get('/change/category/{opt?}', 'show')->name('category.modal');
            Route::delete('/{opt?}', 'destroy')->name('category.delete');  
        });

        // Bagian Team
        Route::controller(TeamController::class)->prefix('team')->group(function(){
            Route::get('/{opt?}', 'index')->name('team');
            Route::get('/team/{opt?}', 'show')->name('team.modal');
            Route::post('/team/', 'store')->name('team.post');
            Route::delete('/team/{opt?}', 'destroy')->name('team.delete');
        });
        // Bagian Team
        Route::controller(SuplyController::class)->prefix('supplier')->group(function(){
            Route::get('/{opt?}', 'index')->name('supplier');
            Route::get('/supplier/{opt?}', 'show')->name('supplier.modal');
            Route::post('/supplier/', 'store')->name('supplier.post');
            Route::delete('/supplier/{opt?}', 'destroy')->name('supplier.delete');
        });

        // Bagian slider
        Route::controller(SliderController::class)->prefix('slider')->group(function(){
            Route::get('/{opt?}', 'index')->name('slider');
            Route::get('/slider/{opt?}', 'show')->name('slider.modal');
            Route::post('/slider/', 'store')->name('slider.post');
            Route::delete('/slider/{opt?}', 'destroy')->name('slider.delete');
        });
        // Bagian service
        Route::controller(ServiceController::class)->prefix('service')->group(function(){
            Route::get('/{opt?}', 'index')->name('service');
            Route::get('/service/{opt?}', 'show')->name('service.modal');
            Route::post('/service/', 'store')->name('service.post');
            Route::delete('/service/{opt?}', 'destroy')->name('service.delete');
        });
        // Bagian Project
        Route::controller(ProjectController::class)->prefix('project')->group(function(){
            Route::get('/{opt?}', 'index')->name('project');
            Route::get('/project/{opt?}', 'show')->name('project.modal');
            Route::post('/project/', 'store')->name('project.post');
            Route::delete('/project/{opt?}', 'destroy')->name('project.delete');
        });

        // Bagian faq
        Route::controller(QnaController::class)->prefix('faq')->group(function(){
            Route::get('/{opt?}', 'index')->name('faq');
            Route::get('/faq/{opt?}', 'show')->name('faq.modal');
            Route::post('/faq/', 'store')->name('faq.post');
            Route::delete('/faq/{opt?}', 'destroy')->name('faq.delete');
        });

        // Bagian artikel
        Route::controller(ArticelController::class)->prefix('artikel')->group(function(){
            Route::get('/{opt?}', 'index')->name('artikel');
            Route::get('/modal/{opt?}', 'show')->name('artikel.modal');
            Route::post('/', 'store')->name('artikel.post');
            Route::get('/view/{slug?}', 'view')->name('artikel.view');
            Route::get('/sort/{kategori_id}/{id?}', 'sort')->name('artikel.sort');
            Route::delete('/{opt?}', 'destroy')->name('artikel.delete');
        });
        // Bagian message
        Route::controller(MessageController::class)->prefix('message')->group(function(){
            Route::get('/{opt?}', 'index')->name('message');
            Route::get('/data/limit', 'all_list')->name('limit.message');
        });
    });
});

Route::get('/tes', function () {
    $title = 'testing ug.post';
    return view('admin.pages.main', compact('title'))->render();
})->name('form.tes');

Route::post('account', [AccountController::class, 'index'])->name('account.post');