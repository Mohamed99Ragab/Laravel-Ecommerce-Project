<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Auth\RestPassword;
use App\Http\Controllers\Api\Auth\SocialAuthController;
use App\Http\Controllers\Api\Auth\updateProfile;
use App\Http\Controllers\Api\BannerController;
use App\Http\Controllers\Api\Cart\CartController;
use App\Http\Controllers\Api\Categories\CategoryController;
use App\Http\Controllers\Api\contactController;
use App\Http\Controllers\Api\Order\orderController;
use App\Http\Controllers\Api\ProductReviews\ProductReviewController;
use App\Http\Controllers\Api\Products\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});



//  Auth
    Route::post('auth/login',[AuthController::class,'login']);
    Route::post('auth/register',[AuthController::class,'register']);

//    login by google
    Route::post('loginByGoogle',[SocialAuthController::class,'loginByGoogle']);


// Rest Password Api
Route::post('forget-password',[RestPassword::class,'forgetPassword']);
Route::post('rest-password',[RestPassword::class,'restPassword']);




//Categories
Route::get('categories',[CategoryController::class,'index']);


// Products
Route::get('products',[ProductController::class,'index']);
Route::get('productDetails/{product_id}',[ProductController::class,'productDetails']);
Route::get('Featuredproducts',[ProductController::class,'getFeaturedProducts']);
Route::get('Newproducts',[ProductController::class,'getNewProducts']);




// Reviews
Route::post('store-review',[ProductReviewController::class,'storeReview']);
Route::get('show-review/{id}',[ProductReviewController::class,'showReview']);
Route::post('edit-review/{id}',[ProductReviewController::class,'editReview']);
Route::delete('delete-review/{id}',[ProductReviewController::class,'deleteReview']);



Route::group(['middleware'=>'jwt.verify'],function (){

    Route::get('user',[updateProfile::class,'userData']);
    Route::post('edit-profile',[updateProfile::class,'updateProfile']);

    Route::post('logout',[AuthController::class,'logout']);


//    Cart
    Route::get('cart',[CartController::class,'index']);
    Route::post('addToCart',[CartController::class,'addToCart']);
    Route::post('editCart',[CartController::class,'editCart']);
    Route::delete('cart/{cart_id}',[CartController::class,'deleteCart']);

    Route::post('updateCartAuto/{cart_id}',[CartController::class,'updateCartAuto']);


//    Orders
    Route::post('makeOrder',[orderController::class,'makeOrder']);
    Route::get('orders',[orderController::class,'index']);

    Route::get('orderDetails/{order_id}',[orderController::class,'orderDetails']);




});

// Banner Api Of Application
Route::get('banners',[BannerController::class,'getAllBanners']);

Route::post('contactUs',[contactController::class,'contactUs']);
