<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::prefix('retaguarda')->middleware('jwt.auth')->group(function() {
    Route::get('contato', 'ContatoApiController@index');
    Route::get('contato/{id}', 'ContatoApiController@show');
    Route::post('contato/store', 'ContatoApiController@store');

    Route::put('contato/{id}', 'ContatoApiController@update');
    Route::delete('contato/delete/{id}', 'ContatoApiController@destroy');

    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
// });

Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('logout', 'App\Http\Controllers\AuthController@logout');
