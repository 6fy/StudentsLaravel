<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', [ AuthController::class, 'login' ])->middleware('isLoggedIn');
Route::get('/dashboard', [ DashboardController::class, 'index' ])->middleware('isLoggedIn');
Route::get('/admin', [ DashboardController::class, 'admin' ])->middleware('isAnAdministrator');

Route::get('/login', [ AuthController::class, 'login' ])->middleware('alreadyLoggedIn');
Route::get('/register', [ AuthController::class, 'register' ])->middleware('alreadyLoggedIn');
Route::get('/logout', [ AuthController::class, 'logout' ])->middleware('isLoggedIn');

Route::post('registerUserRoute', [ AuthController::class, 'registerUser' ])->name('registerUser');
Route::post('loginUserRoute', [ AuthController::class, 'loginUser' ])->name('loginUser');