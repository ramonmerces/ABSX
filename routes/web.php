<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\VendedoresController;

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
Route::get('/teste', function (){
    return view('teste');
});
Route::get('/cadastro-vendedor', function (){
    return view('cadastro-vendedor');
});
Auth::routes();
Route::group(['middleware' => ['web']], function () {
    Route::post('post-vendedor', 'App\Http\Controllers\Api\VendedoresController@store');
    Route::post('update-vendedor', 'App\Http\Controllers\Api\VendedoresController@updateview');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
