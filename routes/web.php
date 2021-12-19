<?php

use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\Users\LoginController;
use App\Http\Services\Product\UploadService;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin/user/login',[LoginController::class,'index'])->name('login');
Route::post('admin/user/login/store',[LoginController::class,'store']);
//auth  để kiểm tra người dùng đăng nhập nếu hợp lệ vào admin, không hợp lệ trả về login
Route::middleware(['auth'])->group(function(){
    Route:: prefix('admin')->group(function(){
        Route::get('/',[MainController::class,'index'])->name('admin');
        Route::get('main',[MainController::class,'index']);
        //Menus
        Route::prefix('menus')->group(function(){
                Route::get('add',[MenuController::class,'create']);
                Route::post('add',[MenuController::class,'store']);// menu validate form xác thực 
                Route::get('list',[MenuController::class,'index']);
                Route::get('edit/{menu}',[MenuController::class,'show']);
                Route::post('edit/{menu}',[MenuController::class,'update']);
                Route::delete('destroy',[MenuController::class,'destroy']);
                
        });
        #Product
        Route::prefix('products')->group(function(){
            Route::get('add',[ProductController::class,'create']);
            Route::post('add',[ProductController::class,'store']);
            Route::get('list',[ProductController::class,'index']);
        });
        #Upload dùng cho up ảnh lên
        // Route::post('upload/services',[UploadController::class,'store']);
        Route::post('upload/services',[UploadController::class,'store']);
    });

});
// Route::get('doc-so/{a}/{b}',function($a,$b){
//     return $a + $b;

// });

