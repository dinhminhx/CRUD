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

Route::get('/', function () {
    return view('Welcome back SIR');
});
Route::get('/', 'App\Http\Controllers\RestaurantController@index')->name('index');
Route::get('/create', 'App\Http\Controllers\RestaurantController@create')->name('create');
Route::post('store/', 'App\Http\Controllers\RestaurantController@store')->name('store');
Route::get('show/{restaurant}', 'App\Http\Controllers\RestaurantController@show')->name('show');
Route::get('edit/{restaurant}', 'App\Http\Controllers\RestaurantController@edit')->name('edit');
Route::put('edit/{restaurant}','App\Http\Controllers\RestaurantController@update')->name('update');
Route::delete('/{restaurant}','App\Http\Controllers\RestaurantController@destroy')->name('destroy');