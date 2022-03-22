<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

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

Route::get('book',[\App\Http\Controllers\BookController::class,'index']);
Route::get('book/{id}',[\App\Http\Controllers\BookController::class,'show']);
Route::post('book',[\App\Http\Controllers\BookController::class,'store']);
Route::put('book/{id}',[\App\Http\Controllers\BookController::class,'update']);
Route::delete('book/{id}',[\App\Http\Controllers\BookController::class,'destroy']);

Route::get('category',[\App\Http\Controllers\CategoryController::class,'index']);
Route::get('category/{id}',[\App\Http\Controllers\CategoryController::class,'show']);
Route::get('category/countbook/{id}',[\App\Http\Controllers\CategoryController::class,'getcountbook']);
Route::post('category',[\App\Http\Controllers\CategoryController::class,'store']);
Route::put('category/{id}',[\App\Http\Controllers\CategoryController::class,'update']);
Route::delete('category/{id}',[\App\Http\Controllers\CategoryController::class,'destroy']);



Route::post('register',[\App\Http\Controllers\Auth\RegisterController::class,'register']);
Route::post('login',[\App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');
Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::post('/logout',[\App\Http\Controllers\Auth\LogoutController::class,'logout']);
    Route::post('profile',[\App\Http\Controllers\Auth\Profile::class,'profile']);
});
//Admin

Route::post('admin/register',[\App\Http\Controllers\AdminAuth\Auth::class,'register']);
Route::post('admin/login',[\App\Http\Controllers\AdminAuth\Auth::class,'login']);
Route::group(['middleware'=>['auth:sanctum']],function (){
    Route::post('admin/profile',[\App\Http\Controllers\AdminAuth\Auth::class,'profile']);
});
