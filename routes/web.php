<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Adminlogin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|ALTER TABLE `tbl_customer` ADD `google2fa` TINYINT NOT NULL DEFAULT '0' AFTER `auth_token`;
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/404', function() {
    return view('404');
});

Route::get('/',[Adminlogin::class , 'index']);

//admin controller start
Route::get('/logout',[Adminlogin::class,'logout']);
Route::post('/validate',[Adminlogin::class,'login']);

Route::get('/dashboard',[Dashboard::class , 'index']);

// category controller start
Route::get('/manage-category',[CategoryController::class , 'index']);
Route::post('/save_category',[CategoryController::class , 'save_category']);
Route::post('/show_category',[CategoryController::class , 'show_category']);
Route::post('/category_status',[CategoryController::class , 'category_status']);
Route::post('/delete_category',[CategoryController::class , 'delete_category']);
Route::post('/edit_category',[CategoryController::class , 'edit_category']);