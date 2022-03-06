<?php

// use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Admin\SliderController;
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
        Route::get('/',[App\Http\Controllers\Admin\MainController::class,'index'])->name('admin');
        Route::get('main',[App\Http\Controllers\Admin\MainController::class,'index']);
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
            Route::get('edit/{product}',[ProductController::class,'show']);
            Route::post('edit/{product}',[ProductController::class,'update']);
            Route::get('/search', [ProductController::class,'search']); 
            Route::delete('destroy',[ProductController::class,'destroy']);
        });
        //SLider
        Route::prefix('sliders')->group(function(){
            Route::get('add',[SliderController::class,'create']);
            Route::post('add',[SliderController::class,'store']);
            Route::get('list',[SliderController::class,'index']);
            Route::get('edit/{slider}',[SliderController::class,'show']);
            Route::post('edit/{slider}',[SliderController::class,'update']);
            Route::delete('destroy',[SliderController::class,'destroy']);
        });
        #Upload dùng cho up ảnh lên
        // Route::post('upload/services',[UploadController::class,'store']);
        Route::post('upload/services',[UploadController::class,'store']);
    });

});
    Route::get('/',[MainController::class,'index']);
    Route::post('/services/load-product',[App\Http\Controllers\MainController::class,'loadProduct']);
    Route::get('danh-muc/{id}-{slug}.html',[App\Http\Controllers\MenuController::class,'index']);
    Route::get('san-pham/{id}-{slug}.html',[App\Http\Controllers\ProductController::class,'index']);
    Route::post('add-cart',[App\Http\Controllers\CartController::class,'index']);
    Route::get('carts',[App\Http\Controllers\CartController::class,'show']);
    Route::post('/update-cart',[App\Http\Controllers\CartController::class,'update']);
    Route::get('/carts/delete/{id}',[App\Http\Controllers\CartController::class,'destroy']);
    Route::post('carts',[App\Http\Controllers\CartController::class,'addCart']);




    Route::post('/tim-kiem',[App\Http\Controllers\ProductController::class, 'searchProduct']);

    // Route::get('carts',[App\Http\Controllers\CartController::class,'addCart']);
// Route::get('doc-so/{a}/{b}',function($a,$b){
//     return $a + $b;

// });

