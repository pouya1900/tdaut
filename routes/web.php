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

Route::get('/storage/{path}/{file}', 'App\Http\Controllers\StorageController@index')->middleware(['member.auth.optional'])->name('storage');

Route::post('/temp/upload', 'App\Http\Controllers\MediaController@tmp')->name('tmp_upload');

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
    Route::get('/office/panel/{office}', 'App\Http\Controllers\Office\OfficeController@index')->name('mg.office')->middleware('member.permission:no_permission_needed');
    Route::get('/office/create', 'App\Http\Controllers\Office\OfficeController@create')->name('mg.office_create');
    Route::post('/office/create', 'App\Http\Controllers\Office\OfficeController@store')->name('mg.office_store');
    Route::post('/office/updaate/{office}', 'App\Http\Controllers\Office\OfficeController@update')->name('mg.office_update')->middleware('member.permission:update.*');
    Route::get('/office/capabilities/{office}', 'App\Http\Controllers\Office\OfficeController@capabilities')->name('mg.office_capabilities');
    Route::post('/office/capabilities/{office}', 'App\Http\Controllers\Office\OfficeController@capabilities_update')->name('mg.office_capabilities_update')->middleware('member.permission:capability.*');
    Route::get('/office/content/{office}', 'App\Http\Controllers\Office\OfficeController@content_edit')->name('mg.content_edit')->middleware('member.permission:content.*');
    Route::post('/office/content/{office}', 'App\Http\Controllers\Office\OfficeController@content_update')->name('mg.content_update')->middleware('member.permission:content.*');

    Route::get('/office/members/{office}', 'App\Http\Controllers\Office\MemberController@index')->name('mg.office_members')->middleware('member.permission:member.*');
    Route::get('/office/members/{office}/update/{member}', 'App\Http\Controllers\Office\MemberController@edit')->name('mg.office_members_edit')->middleware('member.permission:member.*');
    Route::post('/office/members/{office}/update/{member}', 'App\Http\Controllers\Office\MemberController@update')->name('mg.office_members_update')->middleware('member.permission:member.*');
    Route::get('/office/members/{office}/remove/{member}', 'App\Http\Controllers\Office\MemberController@remove')->name('mg.office_members_remove')->middleware('member.permission:member.*');
    Route::get('/office/members/{office}/create', 'App\Http\Controllers\Office\MemberController@create')->name('mg.office_member_create')->middleware('member.permission:member.*');
    Route::post('/office/members/{office}/create', 'App\Http\Controllers\Office\MemberController@store')->name('mg.office_member_store')->middleware('member.permission:member.*');

    Route::get('/office/roles/{office}', 'App\Http\Controllers\Office\RoleController@index')->name('mg.office_roles')->middleware('member.permission:role.*');
    Route::get('/office/roles/{office}/update/{role}', 'App\Http\Controllers\Office\RoleController@edit')->name('mg.office_roles_edit')->middleware('member.permission:role.*');
    Route::post('/office/roles/{office}/update/{role}', 'App\Http\Controllers\Office\RoleController@update')->name('mg.office_roles_update')->middleware('member.permission:role.*');


    Route::get('/office/supports/{office}', 'App\Http\Controllers\Office\SupportController@index')->name('mg.supports')->middleware('member.permission:support.*');
    Route::get('/office/supports/{office}/show/{support}', 'App\Http\Controllers\Office\SupportController@show')->name('mg.support_show')->middleware('member.permission:support.*');
    Route::post('/office/supports/{office}/show/{support}', 'App\Http\Controllers\Office\SupportController@store_message')->name('mg.support_new_message')->middleware('member.permission:support.*');
    Route::get('/office/supports/{office}/create', 'App\Http\Controllers\Office\SupportController@create')->name('mg.support_new_ticket')->middleware('member.permission:support.*');
    Route::post('/office/supports/{office}/create', 'App\Http\Controllers\Office\SupportController@store')->name('mg.support_new_ticket_store')->middleware('member.permission:support.*');

    Route::get('/office/messages/{office}/show/{user?}', 'App\Http\Controllers\Office\messageController@index')->name('mg.messages')->middleware('member.permission:messages.*');
    Route::post('/office/messages/{office}/create/{user}', 'App\Http\Controllers\Office\messageController@store')->name('mg.store_message')->middleware('member.permission:message.*');

    Route::get('/office/rfps/{office}', 'App\Http\Controllers\Office\proposalController@index')->name('mg.rfps')->middleware('member.permission:rfp.*');
    Route::get('/office/proposal/{office}/create/{document}', 'App\Http\Controllers\Office\proposalController@create')->name('mg.create_proposal')->middleware('member.permission:rfp.*');
    Route::post('/office/proposal/{office}/create/{document}', 'App\Http\Controllers\Office\proposalController@store')->name('mg.store_proposal')->middleware('member.permission:rfp.*');

    Route::get('/office/products/{office}', 'App\Http\Controllers\Office\productController@index')->name('mg.products')->middleware('member.permission:product.*');
    Route::get('/office/products/{office}/edit/{product}', 'App\Http\Controllers\Office\productController@edit')->name('mg.product_edit')->middleware('member.permission:product.*');
    Route::post('/office/products/{office}/edit/{product}', 'App\Http\Controllers\Office\productController@update')->name('mg.product_update')->middleware('member.permission:product.*');
    Route::get('/office/products/{office}/create', 'App\Http\Controllers\Office\productController@create')->name('mg.product_create')->middleware('member.permission:product.*');
    Route::post('/office/products/{office}/create', 'App\Http\Controllers\Office\productController@store')->name('mg.product_store')->middleware('member.permission:product.*');
    Route::get('/office/products/{office}/remove/{product}', 'App\Http\Controllers\Office\productController@remove')->name('mg.product_remove')->middleware('member.permission:product.*');
    Route::get('/office/products/{office}/images/{product}', 'App\Http\Controllers\Office\productController@images')->name('mg.product_images')->middleware('member.permission:product.*');


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


Route::get('/user/{user}', 'App\Http\Controllers\UserController@show')->middleware('user.auth.optional')->name('user_show');
Route::group(['middleware' => ['user.auth']], function () {
    Route::get('/user/password', 'App\Http\Controllers\UserController@password')->name('user_password');
    Route::get('/user/edit', 'App\Http\Controllers\UserController@edit')->name('user_edit');
});
