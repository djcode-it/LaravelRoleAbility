<?php

use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user/auth', [Authenticate::class, 'login']);

Route::get('/user/create', function () {
    User::create([
        'name' => 'djcode',
        'email' => 'test@gmail.com',
        'password' => \Illuminate\Support\Facades\Hash::make('123456')
    ]);
});

Route::get('/user/create', function () {
    User::create([
        'name' => 'djcode',
        'email' => 'test@gmail.com',
        'role' => 'staff',
        'password' => \Illuminate\Support\Facades\Hash::make('123456')
    ]);
});
