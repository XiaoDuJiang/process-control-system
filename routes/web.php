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
    return view('welcome');
});

# 登录路由
Route::prefix('login')->group(function () {
    Route::post('/loginIn', [\App\Http\Controllers\Login::class, 'loginIn']);
    Route::post('/register', [\App\Http\Controllers\Login::class, 'register']);
    Route::post('/getUserAuth',[\App\Http\Controllers\Login::class, 'getUserAuth']);
});


