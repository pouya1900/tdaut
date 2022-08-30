<?php

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('index');
Route::get('/home2', 'App\Http\Controllers\HomeController@index2')->name('index');
Route::get('/test', 'App\Http\Controllers\TestController@index')->name('test');
Route::get('/offices', 'App\Http\Controllers\OfficeController@index')->name('offices');
Route::get('/offices/show/{office}', 'App\Http\Controllers\OfficeController@show')->name('offices_show');


Route::get('/profile/show/{member}', 'App\Http\Controllers\ProfileController@show')->name('profile_show');
