<?php

use App\Http\Controllers\TestController;
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
Route::get('test',[TestController::class,'test']);
Route::post('test/store',[TestController::class,'store'])->name('saveuser');
Route::get('test/create',[TestController::class,'create']);
Route::get('test/index',[TestController::class,'index'])->name('test.index');
Route::delete('test/{user}/destroy',[TestController::class,'destroy'])->name('test.destroy');
Route::get('test/{user}/edit',[TestController::class,'edit'])->name('test.edit');
Route::put('test/{user}/update',[TestController::class,'update'])->name('test.update');
