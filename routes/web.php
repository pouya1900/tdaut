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

Route::get('/search-member', 'App\Http\Controllers\ProfileController@search')->name('search_member');
Route::get('/username/check', 'App\Http\Controllers\AuthController@check_username')->name('check_username');
Route::get('/professor/check', 'App\Http\Controllers\AuthController@check_professor')->name('check_professor');
Route::get('/search-office', 'App\Http\Controllers\OfficeController@search')->name('check_office');

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
    Route::get('/office/create', 'App\Http\Controllers\Office\OfficeController@create')->name('mg.office_create');
    Route::post('/office/create', 'App\Http\Controllers\Office\OfficeController@store')->name('mg.office_store');
    Route::get('/office/not-active/{office}', 'App\Http\Controllers\Office\OfficeController@not_active')->name('office_not_active');

    Route::get('/office/slideshow/{office}', 'App\Http\Controllers\Office\OfficeController@images')->name('mg.slideshow_images')->middleware('member.permission:update.*');

    Route::get('/office/dashboard/{office}', 'App\Http\Controllers\Office\OfficeController@dashboard')->name('mg.office.dashboard');
    Route::get('/office/request/{office}', 'App\Http\Controllers\Office\OfficeController@request')->name('mg.office_request')->middleware('member.permission:update.*');

    Route::get('/office/panel/{office}', 'App\Http\Controllers\Office\OfficeController@index')->name('mg.office');
    Route::post('/office/update/{office}', 'App\Http\Controllers\Office\OfficeController@update')->name('mg.office_update')->middleware('member.permission:update.*');
    Route::get('/office/capabilities/{office}', 'App\Http\Controllers\Office\OfficeController@capabilities')->name('mg.office_capabilities');
    Route::post('/office/capabilities/{office}', 'App\Http\Controllers\Office\OfficeController@capabilities_update')->name('mg.office_capabilities_update')->middleware('member.permission:capability.*');
    Route::get('/office/content/{office}', 'App\Http\Controllers\Office\OfficeController@content_edit')->name('mg.content_edit')->middleware('member.permission:content.*');
    Route::post('/office/content/{office}', 'App\Http\Controllers\Office\OfficeController@content_update')->name('mg.content_update')->middleware('member.permission:content.*');

    Route::get('/office/members/{office}', 'App\Http\Controllers\Office\MemberController@index')->name('mg.office_members')->middleware('member.permission:member.*');
    Route::get('/office/members/{office}/edit/{member}', 'App\Http\Controllers\Office\MemberController@edit')->name('mg.office_members_edit')->middleware('member.permission:member.*');
    Route::post('/office/members/{office}/update/{member}', 'App\Http\Controllers\Office\MemberController@update')->name('mg.office_members_update')->middleware('member.permission:member.*');
    Route::get('/office/members/{office}/remove/{member}', 'App\Http\Controllers\Office\MemberController@remove')->name('mg.office_members_remove')->middleware('member.permission:member.*');
    Route::get('/office/members/{office}/create', 'App\Http\Controllers\Office\MemberController@create')->name('mg.office_member_create')->middleware('member.permission:member.*');
    Route::post('/office/members/{office}/store', 'App\Http\Controllers\Office\MemberController@store')->name('mg.office_member_store')->middleware('member.permission:member.*');

    Route::get('/office/roles/{office}', 'App\Http\Controllers\Office\RoleController@index')->name('mg.office_roles')->middleware('member.permission:role.*');
    Route::get('/office/roles/{office}/edit/{role}', 'App\Http\Controllers\Office\RoleController@edit')->name('mg.office_roles_edit')->middleware('member.permission:role.*');
    Route::post('/office/roles/{office}/update/{role}', 'App\Http\Controllers\Office\RoleController@update')->name('mg.office_roles_update')->middleware('member.permission:role.*');


    Route::get('/office/supports/{office}', 'App\Http\Controllers\Office\SupportController@index')->name('mg.supports')->middleware('member.permission:support.*');
    Route::get('/office/supports/{office}/show/{support}', 'App\Http\Controllers\Office\SupportController@show')->name('mg.support_show')->middleware('member.permission:support.*');
    Route::post('/office/supports/{office}/show/{support}', 'App\Http\Controllers\Office\SupportController@store_message')->name('mg.support_new_message')->middleware('member.permission:support.*');
    Route::get('/office/supports/{office}/create', 'App\Http\Controllers\Office\SupportController@create')->name('mg.support_new_ticket')->middleware('member.permission:support.*');
    Route::post('/office/supports/{office}/store', 'App\Http\Controllers\Office\SupportController@store')->name('mg.support_new_ticket_store')->middleware('member.permission:support.*');

    Route::get('/office/messages/{office}/show/{user?}', 'App\Http\Controllers\Office\messageController@index')->name('mg.messages')->middleware('member.permission:messages.*');
    Route::post('/office/messages/{office}/store/{user}', 'App\Http\Controllers\Office\messageController@store')->name('mg.store_message')->middleware('member.permission:message.*');

    Route::get('/office/rfps/{office}', 'App\Http\Controllers\Office\proposalController@index')->name('mg.rfps')->middleware('member.permission:rfp.*');
    Route::get('/office/proposal/{office}/create/{rfp}', 'App\Http\Controllers\Office\proposalController@create')->name('mg.create_proposal')->middleware('member.permission:rfp.*');
    Route::post('/office/proposal/{office}/store/{rfp}', 'App\Http\Controllers\Office\proposalController@store')->name('mg.store_proposal')->middleware('member.permission:rfp.*');

    Route::get('/office/rfps/{office}/show/{rfp}', 'App\Http\Controllers\Office\proposalController@show')->name('mg.rfp.show')->middleware('member.permission:rfp.*');
    Route::get('/office/rfps/{office}/send/{document}', 'App\Http\Controllers\Office\proposalController@send')->name('mg.rfp.send')->middleware('member.permission:rfp.*');
    Route::get('/office/rfps/{office}/delete/{document}', 'App\Http\Controllers\Office\proposalController@delete')->name('mg.rfp.delete')->middleware('member.permission:rfp.*');


    Route::get('/office/products/{office}', 'App\Http\Controllers\Office\productController@index')->name('mg.products')->middleware('member.permission:product.*');
    Route::get('/office/products/{office}/edit/{product}', 'App\Http\Controllers\Office\productController@edit')->name('mg.product_edit')->middleware('member.permission:product.*');
    Route::post('/office/products/{office}/update/{product}', 'App\Http\Controllers\Office\productController@update')->name('mg.product_update')->middleware('member.permission:product.*');
    Route::get('/office/products/{office}/create', 'App\Http\Controllers\Office\productController@create')->name('mg.product_create')->middleware('member.permission:product.*');
    Route::post('/office/products/{office}/store', 'App\Http\Controllers\Office\productController@store')->name('mg.product_store')->middleware('member.permission:product.*');
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
Route::get('/registered/{type}', 'App\Http\Controllers\AuthController@registered')->name('registered');


Route::get('/user/show/{user}', 'App\Http\Controllers\User\UserController@show')->middleware('user.auth.optional')->name('user_show');
Route::group(['middleware' => ['user.auth']], function () {
    Route::get('/user/edit', 'App\Http\Controllers\User\UserController@edit')->name('user_edit');
    Route::post('/user/update', 'App\Http\Controllers\User\UserController@update')->name('user_update');
    Route::get('/user/password', 'App\Http\Controllers\User\UserController@password')->name('user_password');
    Route::post('/user/password', 'App\Http\Controllers\User\UserController@update_password')->name('update_user_password');

    Route::get('/user/rfps', 'App\Http\Controllers\User\ProposalController@index')->name('user_rfps');
    Route::get('/user/rfps/show/{rfp}', 'App\Http\Controllers\User\ProposalController@show')->name('user_rfp_show');
    Route::get('/user/rfps/create/{rfp}', 'App\Http\Controllers\User\ProposalController@create')->name('user_rfp_create');
    Route::post('/user/rfps/store/{rfp}', 'App\Http\Controllers\User\ProposalController@store')->name('user_rfp_store');
    Route::get('/user/rfps/new/create', 'App\Http\Controllers\User\ProposalController@create_rfp')->name('user_new_rfp_create');
    Route::post('/user/rfps/new/store', 'App\Http\Controllers\User\ProposalController@store_rfp')->name('user_new_rfp_store');

    Route::get('/user/supports', 'App\Http\Controllers\User\supportController@index')->name('user_supports');
    Route::get('/user/supports/show/{support}', 'App\Http\Controllers\User\supportController@show')->name('user_support_show');
    Route::post('/user/supports/show/{support}', 'App\Http\Controllers\User\supportController@store_message')->name('user_support_new_message');
    Route::get('/user/supports/create', 'App\Http\Controllers\User\supportController@create')->name('user_support_new_ticket');
    Route::post('/user/supports/store', 'App\Http\Controllers\User\supportController@store')->name('user_support_new_ticket_store');

    Route::get('/user/messages/show/{office?}', 'App\Http\Controllers\User\messageController@index')->name('user_messages');
    Route::post('/user/messages/store/{office}', 'App\Http\Controllers\User\messageController@store')->name('user_store_message');


});

Route::get('administrator/login', 'App\Http\Controllers\Admin\AuthController@login')->name('admin.login');
Route::post('administrator/login', 'App\Http\Controllers\Admin\AuthController@do_login')->name('admin.do_login');

Route::group(['middleware' => ['admin.auth'], 'prefix' => 'administrator', 'namespace' => 'App\Http\Controllers\Admin'], function () {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');

    Route::get('/offices', 'OfficeController@index')->name('admin.offices')->middleware('admin.permission:office.*');
    Route::get('/offices/edit/{office}', 'OfficeController@edit')->name('admin.office.edit')->middleware('admin.permission:office.*');
    Route::post('/offices/update/{office}', 'OfficeController@update')->name('admin.office.update')->middleware('admin.permission:office.*');
    Route::get('/offices/remove/{office}', 'OfficeController@remove')->name('admin.office.remove')->middleware('admin.permission:office.*');
    Route::get('/offices/members/{office}', 'OfficeController@members')->name('admin.office.members')->middleware('admin.permission:office.*');

    Route::get('/products/all/{office?}', 'ProductController@index')->name('admin.products')->middleware('admin.permission:product.*');
    Route::get('/products/edit/{product}', 'ProductController@edit')->name('admin.product.edit')->middleware('admin.permission:product.*');
    Route::post('/products/update/{product}', 'ProductController@update')->name('admin.product.update')->middleware('admin.permission:product.*');
    Route::get('/products/remove/{product}', 'ProductController@remove')->name('admin.product.remove')->middleware('admin.permission:product.*');
    Route::get('/products/images/{product}', 'ProductController@images')->name('admin.product.images')->middleware('admin.permission:product.*');

    Route::get('/users', 'UserController@index')->name('admin.users')->middleware('admin.permission:user.*');
    Route::get('/users/edit/{user}', 'UserController@edit')->name('admin.user.edit')->middleware('admin.permission:user.*');
    Route::post('/users/update/{user}', 'UserController@update')->name('admin.user.update')->middleware('admin.permission:user.*');
    Route::get('/users/remove/{user}', 'UserController@remove')->name('admin.user.remove')->middleware('admin.permission:user.*');

    Route::get('/members', 'MemberController@index')->name('admin.members')->middleware('admin.permission:member.*');
    Route::get('/members/edit/{member}', 'MemberController@edit')->name('admin.member.edit')->middleware('admin.permission:member.*');
    Route::post('/members/update/{member}', 'MemberController@update')->name('admin.member.update')->middleware('admin.permission:member.*');
    Route::get('/members/remove/{member}', 'MemberController@remove')->name('admin.member.remove')->middleware('admin.permission:member.*');
    Route::get('/members/offices/{member}', 'MemberController@offices')->name('admin.member.offices')->middleware('admin.permission:member.*');

    Route::get('/members/roles/{office}/{member}', 'MemberController@roles')->name('admin.member.roles')->middleware('admin.permission:member.*');
    Route::post('/members/roles/{office}/{member}', 'MemberController@roles_update')->name('admin.member.roles.update')->middleware('admin.permission:member.*');

    Route::get('/supports/{type}', 'SupportController@index')->name('admin.supports')->middleware('admin.permission:support.*');
    Route::get('/supports/show/{support}', 'SupportController@show')->name('admin.support.show')->middleware('admin.permission:support.*');
    Route::post('/supports/store/{support}', 'SupportController@store_message')->name('admin.support.new_message')->middleware('admin.permission:support.*');

    Route::get('/categories', 'CategoryController@index')->name('admin.categories')->middleware('admin.permission:category.*');
    Route::get('/categories/edit/{category}', 'CategoryController@edit')->name('admin.category.edit')->middleware('admin.permission:category.*');
    Route::post('/categories/update/{category}', 'CategoryController@update')->name('admin.category.update')->middleware('admin.permission:category.*');
    Route::get('/categories/create', 'CategoryController@create')->name('admin.category.create')->middleware('admin.permission:category.*');
    Route::post('/categories/store', 'CategoryController@store')->name('admin.category.store')->middleware('admin.permission:category.*');
    Route::get('/categories/remove/{category}', 'CategoryController@remove')->name('admin.category.remove')->middleware('admin.permission:category.*');

    Route::get('/degrees', 'DegreeController@index')->name('admin.degrees')->middleware('admin.permission:list.*');
    Route::get('/degrees/edit/{degree}', 'DegreeController@edit')->name('admin.degree.edit')->middleware('admin.permission:list.*');
    Route::post('/degrees/update/{degree}', 'DegreeController@update')->name('admin.degree.update')->middleware('admin.permission:list.*');
    Route::get('/degrees/create', 'DegreeController@create')->name('admin.degree.create')->middleware('admin.permission:list.*');
    Route::post('/degrees/store', 'DegreeController@store')->name('admin.degree.store')->middleware('admin.permission:list.*');
    Route::get('/degrees/remove/{degree}', 'DegreeController@remove')->name('admin.degree.remove')->middleware('admin.permission:list.*');

    Route::get('/departments', 'DepartmentController@index')->name('admin.departments')->middleware('admin.permission:list.*');
    Route::get('/departments/edit/{department}', 'DepartmentController@edit')->name('admin.department.edit')->middleware('admin.permission:list.*');
    Route::post('/departments/update/{department}', 'DepartmentController@update')->name('admin.department.update')->middleware('admin.permission:list.*');
    Route::get('/departments/create', 'DepartmentController@create')->name('admin.department.create')->middleware('admin.permission:list.*');
    Route::post('/departments/store', 'DepartmentController@store')->name('admin.department.store')->middleware('admin.permission:list.*');
    Route::get('/departments/remove/{department}', 'DepartmentController@remove')->name('admin.department.remove')->middleware('admin.permission:list.*');

    Route::get('/ranks', 'RankController@index')->name('admin.ranks')->middleware('admin.permission:list.*');
    Route::get('/ranks/edit/{rank}', 'RankController@edit')->name('admin.rank.edit')->middleware('admin.permission:list.*');
    Route::post('/ranks/update/{rank}', 'RankController@update')->name('admin.rank.update')->middleware('admin.permission:list.*');
    Route::get('/ranks/create', 'RankController@create')->name('admin.rank.create')->middleware('admin.permission:list.*');
    Route::post('/ranks/store', 'RankController@store')->name('admin.rank.store')->middleware('admin.permission:list.*');
    Route::get('/ranks/remove/{rank}', 'RankController@remove')->name('admin.rank.remove')->middleware('admin.permission:list.*');

    Route::get('/reports/types', 'ReportTypeController@index')->name('admin.reports.types')->middleware('admin.permission:report.*');
    Route::get('/reports/types/edit/{report_type}', 'ReportTypeController@edit')->name('admin.reports.type.edit')->middleware('admin.permission:report.*');
    Route::post('/reports/types/update/{report_type}', 'ReportTypeController@update')->name('admin.reports.type.update')->middleware('admin.permission:report.*');
    Route::get('/reports/types/create', 'ReportTypeController@create')->name('admin.reports.type.create')->middleware('admin.permission:report.*');
    Route::post('/reports/types/store', 'ReportTypeController@store')->name('admin.reports.type.store')->middleware('admin.permission:report.*');
    Route::get('/reports/types/remove/{report_type}', 'ReportTypeController@remove')->name('admin.reports.type.remove')->middleware('admin.permission:report.*');

    Route::get('/reports', 'ReportController@index')->name('admin.reports')->middleware('admin.permission:report.*');

    Route::get('/tags', 'TagController@index')->name('admin.tags')->middleware('admin.permission:list.*');
    Route::get('/tags/edit/{tag}', 'TagController@edit')->name('admin.tag.edit')->middleware('admin.permission:list.*');
    Route::post('/tags/update/{tag}', 'TagController@update')->name('admin.tag.update')->middleware('admin.permission:list.*');
    Route::get('/tags/create', 'TagController@create')->name('admin.tag.create')->middleware('admin.permission:list.*');
    Route::post('/tags/store', 'TagController@store')->name('admin.tag.store')->middleware('admin.permission:list.*');
    Route::get('/tags/remove/{tag}', 'TagController@remove')->name('admin.tag.remove')->middleware('admin.permission:list.*');

    Route::get('/admins', 'AdminController@index')->name('admin.admins')->middleware('admin.permission:*');
    Route::get('/admins/edit/{administrator}', 'AdminController@edit')->name('admin.admin.edit')->middleware('admin.permission:*');
    Route::post('/admins/update/{administrator}', 'AdminController@update')->name('admin.admin.update')->middleware('admin.permission:*');
    Route::get('/admins/remove/{administrator}', 'AdminController@remove')->name('admin.admin.remove')->middleware('admin.permission:*');
    Route::get('/admins/create', 'AdminController@create')->name('admin.admin.create')->middleware('admin.permission:*');
    Route::post('/admins/store', 'AdminController@store')->name('admin.admin.store')->middleware('admin.permission:*');

    Route::get('/roles', 'RoleController@index')->name('admin.roles')->middleware('admin.permission:*');
    Route::get('/roles/edit/{role}', 'RoleController@edit')->name('admin.role.edit')->middleware('admin.permission:*');
    Route::post('/roles/update/{role}', 'RoleController@update')->name('admin.role.update')->middleware('admin.permission:*');


});

