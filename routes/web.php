<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;

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

/*
    Index views
*/
Route::get('/', [ AuthController::class, 'login' ])->middleware('isLoggedIn');
Route::get('/dashboard', [ DashboardController::class, 'index' ])->middleware('isLoggedIn');
Route::get('/admin', [ DashboardController::class, 'admin' ])->middleware('isAnAdministrator');

/*
    Student views
*/
Route::get('/student/add', [ StudentController::class, 'addStudentView' ])->middleware('isAnAdministrator');
Route::get('/student/edit/{id}', [ StudentController::class, 'editStudentView' ])->middleware('isAnAdministrator');

/*
    Login views
*/
Route::get('/login', [ AuthController::class, 'login' ])->middleware('alreadyLoggedIn');
Route::get('/register', [ AuthController::class, 'register' ])->middleware('alreadyLoggedIn');
Route::get('/logout', [ AuthController::class, 'logout' ])->middleware('isLoggedIn');

/*
    Login functions
*/
Route::post('registerUserRoute', [ AuthController::class, 'registerUser' ])->name('registerUser');
Route::post('loginUserRoute', [ AuthController::class, 'loginUser' ])->name('loginUser');

/*
    Student functions
*/
Route::post('addStudentRoute', [ StudentController::class, 'addStudent' ])->middleware('isAnAdministrator')->name('addStudent');
Route::post('editStudentRoute/{id}', [ StudentController::class, 'editStudent' ])->middleware('isAnAdministrator')->name('editStudent');
Route::get('deleteStudentRoute/{id}', [ StudentController::class, 'deleteStudent' ])->middleware('isAnAdministrator')->name('deleteStudent');