<?php

namespace App\Providers;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
// Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('barang', 'Api\BarangController@index');
    Route::get('barang/{id}', 'Api\BarangController@show');
    Route::post('barang', 'Api\BarangController@store');
    Route::put('barang/{id}', 'Api\BarangController@update');
    Route::delete('barang/{id}', 'Api\BarangController@destroy');
});
