<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\passwordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/login' , [LoginController::class, 'index'])->name('login.index');
Route::post('/login' , [LoginController::class, 'login'])->name('login.login');

Route::get('/changepassword', [passwordController::class, 'index']);
Route::post('/changepassword', [passwordController::class, 'changepassword']);

Route::post('/logout' , [LoginController::class, 'logout']);

route::group(['prefix' => 'register'], function () {
    Route::get('/', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/store', [RegisterController::class, 'store']);
});
