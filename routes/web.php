<?php

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

Route::get('/'      ,   'TaskController@index');

Route::group(['prefix' => 'task'], function(){
    Route::get('get'        ,   'TaskController@get')->name('task.get');
    Route::post('store'     ,   'TaskController@store')->name('task.store');
    Route::get('done/{id}' ,   'TaskController@done')->name('task.done');
});