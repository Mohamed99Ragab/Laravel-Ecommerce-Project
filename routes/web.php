<?php

use App\Http\Controllers\web\AdminAuthController;
use App\Http\Controllers\web\BannerController;
use App\Http\Controllers\web\Category\CategoryController;
use App\Http\Controllers\web\homeController;
use App\Http\Controllers\web\Orders\OrderController;
use App\Http\Controllers\web\Products\ProductController;
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






Route::get('/blank', function () {
    return view('blank');
});





Route::group(['middleware'=>'guest:admin'],function (){

    Route::get('/', [AdminAuthController::class,'loginview'])->name('login');
    Route::post('/login', [AdminAuthController::class,'login']);


});

Route::group(['middleware'=>'auth:admin'],function (){

    Route::get('/home', [homeController::class,'home'])->name('home');

    Route::get('/logout', [AdminAuthController::class,'logout'])->name('logout');



//    category
    Route::resource('categories',CategoryController::class);

    //    Products
    Route::resource('products',ProductController::class);


//    banners
    Route::resource('banners',BannerController::class);

//    orders
    Route::get('orders',[OrderController::class,'index'])->name('orders');
    Route::post('update-status/{order_id}',[OrderController::class,'updateStatusOfOrder'])
        ->name('orders.update.status');
    Route::get('destroy/{order_id}',[OrderController::class,'destroy']);

    Route::get('invoice/{order_id}',[OrderController::class,'invoice']);

//     mark as read notifications

    Route::get('markRead',[homeController::class,'markAsReadNotification']);
    Route::get('clearNotify',[homeController::class,'clearNotify']);


//    profile
    Route::get('edit-profile',[AdminAuthController::class,'profile'])->name('profile');
    Route::post('edit-profile',[AdminAuthController::class,'updateProfile'])->name('profile.edit');


});


