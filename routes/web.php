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
Route::get('/offices/show/{office}', 'App\Http\Controllers\OfficeController@show')->name('office_show');
Route::get('/offices/members/{office}/{type?}', 'App\Http\Controllers\OfficeController@members')->name('office_members');
Route::get('/offices/products/{office}/{category?}', 'App\Http\Controllers\OfficeController@products')->name('office_products');


Route::get('/profile/show/{member}', 'App\Http\Controllers\ProfileController@show')->name('profile_show');
Route::get('/profile/offices/{member}', 'App\Http\Controllers\ProfileController@offices')->name('profile_offices');
