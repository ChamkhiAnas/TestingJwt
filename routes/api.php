<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


Route::post('login', 'ApiController@login');
Route::post('register', 'ApiController@register');

Route::get('/verify/{token}', 'VerifyController@VerifyEmail')->name('verify');


Route::group(['middleware' => 'auth.jwt'], function () {
    Route::get('logout', 'ApiController@logout');

    Route::get('tasks', 'TaskController@index')->middleware('verified');;
    Route::get('tasks/{id}', 'TaskController@show')->middleware('verified');;
    Route::post('tasks', 'TaskController@store')->middleware('verified');;
    Route::put('tasks/{id}', 'TaskController@update')->middleware('verified');;
    Route::delete('tasks/{id}', 'TaskController@destroy')->middleware('verified');;
});