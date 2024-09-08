<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('post')->middleware(['auth:sanctum','permission:post'])->group(function()
{
    Route::post('store',[PostController::class,'store']);
    Route::get('userpost',[PostController::class,'userPost']);
    Route::get('relation',[PostController::class,'relation']);
    Route::post('filter',[PostController::class,'filter']);
});
Route::prefix('image')->middleware(['auth:sanctum','permission:image'])->group(function()
{
    Route::post('store',[ImageController::class,'store']);
});
Route::prefix('comment')->middleware(['auth:sanctum','permission:comment'])->group(function()
{
    Route::post('post/store',[CommentController::class,'postStore']);
    Route::post('image/store',[CommentController::class,'imageStore']);
});
Route::prefix('user')->group(function()
{
    Route::post('register',[UserController::class,'userRegister']);
    Route::post('login',[UserController::class,'userLogin']);
    Route::get('logout',[UserController::class,'userLogout'])->middleware('auth:sanctum');
});
Route::post('mail',[MailController::class,'sendMail']);
