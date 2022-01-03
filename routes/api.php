<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Customer;
use App\Http\Controllers\Api\Category;
use App\Http\Controllers\Api\Product;
use App\Http\Controllers\Api\GetCryptoValue;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
  
Route::middleware('myapi')->group(function() {
   Route::get('anyurl',[Anyclass::class,'anyMethod']); 
});
Route::post('add_customer',[Customer::class,'saveCustomer']);
Route::post('validate_otp',[Customer::class,'validateOtp']);
Route::post('resend_otp',[Customer::class,'resendOtp']);
Route::get('get_state_or_city/{val?}/{id?}',[Customer::class,'getStateAndCity']);
Route::post('login',[Customer::class,'login']);
Route::get('get_category',[Category::class,'getCategory']);
Route::get('get_subcategory/{category_id}',[Category::class,'getSubCategory']);
Route::get('get_brand',[Category::class,'getBrand']);
//for react
Route::get('getdata/{tablename}',[Category::class,'getData']);
Route::post('/save_product',[Product::class , 'save_product']);
Route::get('/show_product',[Product::class , 'show_product']);
Route::get('/delete_product',[Product::class , 'delete_product']);
//for react
Route::post('get_product/{page?}/{limit?}',[Product::class,'getProduct']);
Route::post('get_image',[Product::class,'getImage']);
Route::post('get_data',[Product::class,'getData']);

Route::get('get_all_crypto',[GetCryptoValue::class,'index']);