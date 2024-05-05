<?php

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



Route::get('/user-list','App\Http\Controllers\UserController@getUsers');


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/get-current-user','App\Http\Controllers\UserController@getCurrentUser');


    Route::group(['prefix'=>'tasks'], function(){
       Route::post('/create','App\Http\Controllers\TasksController@create');
       Route::get('/show','App\Http\Controllers\TasksController@show');
    });
});