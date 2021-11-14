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

Route::get('/', 'App\Http\Controllers\Admin\AuthController@auth');
Route::get('login', 'App\Http\Controllers\Admin\AuthController@auth');
Route::get('logout', 'App\Http\Controllers\Admin\AuthController@authLogout');
Route::post('login', 'App\Http\Controllers\Admin\AuthController@Login');

Route::get('companies', 'App\Http\Controllers\Admin\PagesController@companies')->middleware('perm:companies,read');
Route::post('add-companies', 'App\Http\Controllers\Admin\ActionController@addCompany')->middleware('perm:companies,create');
Route::post('edit-companies', 'App\Http\Controllers\Admin\ActionController@editCompany')->middleware('perm:companies,update');
Route::get('delete-company/{id}', 'App\Http\Controllers\Admin\ActionController@deleteCompany')->middleware('perm:companies,delete');



Route::get('employees', 'App\Http\Controllers\Admin\PagesController@employees')->middleware('perm:employees,read');
Route::post('add-employee', 'App\Http\Controllers\Admin\ActionController@addEmployees')->middleware('perm:employees,create');
Route::post('edit-employee', 'App\Http\Controllers\Admin\ActionController@editEmployees')->middleware('perm:employees,update');
Route::get('delete-employee/{id}', 'App\Http\Controllers\Admin\ActionController@deleteEmployees')->middleware('perm:employees,delete');



Route::get('admins', 'App\Http\Controllers\Admin\PagesController@admins')->middleware('perm:admins,read');
Route::post('add-admin', 'App\Http\Controllers\Admin\ActionController@addAdmin')->middleware('perm:admins,create');
Route::get('delete-admin/{id}', 'App\Http\Controllers\Admin\ActionController@deleteAdmin')->middleware('perm:admins,delete');



Route::get('permissions', 'App\Http\Controllers\Admin\PagesController@permissions')->middleware('perm:permissions,read');
Route::post('add-permissions', 'App\Http\Controllers\Admin\ActionController@addPermissions')->middleware('perm:permissions,create');