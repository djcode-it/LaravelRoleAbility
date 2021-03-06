<?php

use App\Http\Controllers\Management;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authenticate;

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

Route::view('/', 'welcome');


// Manage With Ability
Route::get('/role/create/{sku}', [Management::class, 'CreateRole']);

Route::get('/ability/create/{sku}', [Management::class, 'CreateAbility']);


// Attach & Sync Role to Ability
Route::get('/role/{sku}/ability/sync/{ids}', [Management::class, 'SyncRoleAbilities']);

Route::get('/role/{sku}/ability/attach/{ids}', [Management::class, 'AttachRoleAbilities']);

Route::get('/role/{sku}/ability/detach/{ids}', [Management::class, 'DetachRoleAbilities']);


// Attach & Sync Role to User
Route::get('/user/{name}/role/sync/{ids}', [Management::class, 'SyncUserRole']);

Route::get('/user/{name}/role/attach/{ids}', [Management::class, 'AttachUserRole']);

Route::get('/user/{name}/role/detach/{ids}', [Management::class, 'DetachUserRole']);


// Authenticate & Check user
Route::get('/user/create/{name}/{email}/{password}', [Management::class, 'CreateUser']);

Route::get('/user/{name}/auth', [Authenticate::class, 'Login']);

Route::get('/user/{name}/roles', [Authenticate::class, 'GetUserRoles']);

Route::get('/user/{name}/abilities', [Authenticate::class, 'GetUserAbilities']);

Route::get('/user/logout', [Authenticate::class, 'Logout']);


// User Access Role Based Middleware
Route::view('/admin', 'admin')->middleware('roles:admin');

Route::view('/staff', 'staff')->middleware('roles:admin,staff');

Route::view('/user', 'user')->middleware('roles:admin,staff,user');


// Manage Global Utility
Route::get('/users', [Management::class, 'GetUsers']);

Route::get('/gates', [Management::class, 'GetGates']);

Route::get('/roles', [Management::class, 'GetRoles']);

Route::get('/abilities', [Management::class, 'GetAbilities']);
