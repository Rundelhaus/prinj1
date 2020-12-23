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

/*Route::prefix('/tasks')->group(function (){
    Route::get('','TaskController@index');
    Route::post('/', 'TaskController@store');
    Route::prefix('/{task}')->group(function () {
        Route::get('','TaskController@show');
        Route::patch('/','TaskController@update');
        Route::delete('/','TaskController@destroy');
    });
});*/

Route::prefix('/projects')->group(function () {
    Route::get('','ProjectController@index');
    Route::post('/', 'ProjectController@store');
    Route::prefix('/{project}')->group(function () {
        Route::get('','ProjectController@show');
        Route::patch('/','ProjectController@update');
        Route::delete('/','ProjectController@destroy');
        Route::prefix('/column')->group(function () {
            Route::post('/', 'ColumnController@store');
            Route::group(['prefix' => '/{column}'], function () {
                Route::patch('/', 'ColumnController@update');
                Route::delete('/', 'ColumnController@destroy');
            });
        });
        Route::prefix('/tasks')->group(function () {
            Route::get('', 'TaskController@index');
            Route::post('/', 'TaskController@store');
            Route::prefix('/{task}')->group(function () {
                Route::get('', 'TaskController@show');
                Route::patch('/', 'TaskController@update');
                Route::delete('/', 'TaskController@destroy');
            });
        });
    });
});

#Route::middleware('auth:api')->get('/user', function (Request $request) {return $request->user();});
