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
Route::get('/home2', 'App\Http\Controllers\HomeController@index2')->name('index2');
Route::get('/test/{office}', 'App\Http\Controllers\TestController@index')->name('test');

Route::get('/offices', 'App\Http\Controllers\OfficeController@index')->name('offices');
Route::get('/offices/show/{office}', 'App\Http\Controllers\OfficeController@show')->name('office_show');
Route::get('/offices/members/{office}/{type?}', 'App\Http\Controllers\OfficeController@members')->name('office_members');
Route::get('/offices/products/{office}/{category?}', 'App\Http\Controllers\OfficeController@products')->name('office_products');
Route::get('/offices/rfp/{office}', 'App\Http\Controllers\OfficeController@rfp')->middleware(['user.auth', 'user.permission:rfp.*'])->name('office_rfp');
Route::post('/offices/rfp/{office}', 'App\Http\Controllers\OfficeController@store_rfp')->middleware(['user.auth', 'user.permission:rfp.*'])->name('office_store_rfp');
Route::get('/offices/contact/{office}', 'App\Http\Controllers\OfficeController@contact')->name('office_contact');
Route::get('/offices/chat/{office}', 'App\Http\Controllers\OfficeController@chat')->middleware(['user.auth', 'user.permission:chat.*'])->name('office_chat');
Route::post('/offices/chat/{office}', 'App\Http\Controllers\OfficeController@store_chat')->middleware(['user.auth', 'user.permission:chat.*'])->name('office_store_chat');


Route::get('/profile/show/{member}', 'App\Http\Controllers\ProfileController@show')->middleware(['member.auth.optional'])->name('profile_show');
Route::get('/profile/offices/{member}', 'App\Http\Controllers\ProfileController@offices')->name('profile_offices');
Route::get('/profile/edit', 'App\Http\Controllers\ProfileController@edit')->middleware(['member.auth'])->name('profile_edit');
Route::post('/profile/update', 'App\Http\Controllers\ProfileController@update')->middleware(['member.auth'])->name('profile_update');
Route::get('/profile/password', 'App\Http\Controllers\ProfileController@password')->middleware(['member.auth'])->name('profile_password');
Route::post('/profile/password', 'App\Http\Controllers\ProfileController@update_password')->middleware(['member.auth'])->name('update_profile_password');


Route::get('/products/show/{product}', 'App\Http\Controllers\ProductController@show')->name('product_show');

Route::group(['middleware' => ['member.auth']], function () {
    Route::get('/office/panel/{office}', 'App\Http\Controllers\Office\OfficeController@index')->name('mg.office');
    Route::get('/office/create', 'App\Http\Controllers\Office\OfficeController@create')->name('mg.office_create');
    Route::post('/office/create', 'App\Http\Controllers\Office\OfficeController@store')->name('mg.office_store');
    Route::post('/office/updaate/{office}', 'App\Http\Controllers\Office\OfficeController@update')->name('mg.office_update');
    Route::get('/office/capabilities/{office}', 'App\Http\Controllers\Office\OfficeController@capabilities')->name('mg.office_capabilities');
    Route::post('/office/capabilities/{office}', 'App\Http\Controllers\Office\OfficeController@capabilities_update')->name('mg.office_capabilities_update');
    Route::get('/office/members/{office}', 'App\Http\Controllers\Office\OfficeController@members')->name('mg.office_members');

});

//aut route

//->middleware(['member.permission:product.*'])

Route::get('/login/{type}', 'App\Http\Controllers\AuthController@login')->name('login');
Route::post('/doLogin/member', 'App\Http\Controllers\AuthController@do_member_login')->name('do_login_member');
Route::post('/doLogin/user', 'App\Http\Controllers\AuthController@do_user_login')->name('do_login_user');
Route::get('/register/member', 'App\Http\Controllers\AuthController@register_member')->name('register_member');
Route::get('/register/user', 'App\Http\Controllers\AuthController@register_user')->name('register_user');
Route::post('/register/member', 'App\Http\Controllers\AuthController@do_register_member')->name('do_register_member');
Route::post('/register/user', 'App\Http\Controllers\AuthController@do_register_user')->name('do_register_user');
Route::get('/confirmation-email-member/{token}', 'App\Http\Controllers\AuthController@confirmation_email_member')->name('confirmation_email_member');
Route::get('/confirmation-email-user/{token}', 'App\Http\Controllers\AuthController@confirmation_email_user')->name('confirmation_email_user');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');


Route::get('/storage/{model_type}/{file_name}', 'App\Http\Controllers\StorageController@index')->name('storage_index');
