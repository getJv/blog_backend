<?php

use Illuminate\Http\Request;

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

Route::post('/register','Api\AuthController@register');
Route::post('/login','Api\AuthController@login');
Route::middleware('auth:api')->post('/logout','Api\AuthController@logout');


Route::get('/post','PostController@index');
Route::middleware('auth:api')->post('/post','PostController@save');
Route::middleware('auth:api')->put('/post/{id}','PostController@update');
Route::middleware('auth:api')->delete('/post/{id}','PostController@remove');