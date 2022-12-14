<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\BookyearController;
use App\Http\Controllers\FamilieController;
use App\Http\Controllers\FamilieMemberController;

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
    <------------
    Views
    ------------>
*/

/*
    Index views
*/
Route::get('/', [ AuthController::class, 'login' ])->middleware('isLoggedIn');
Route::get('/dashboard', [ DashboardController::class, 'index' ])->middleware('isLoggedIn');

Route::get('makeAdministrator/{id}', [ AuthController::class, 'makeAdministrator' ])->name('makeAdministrator');

/*
    Family views
*/
Route::get('/familie', [ FamilieController::class, 'familieView' ])->middleware('isAnAdministrator');
Route::get('/familie/add', [ FamilieController::class, 'addFamilieView' ])->middleware('isAnAdministrator');
Route::get('/familie/edit/{id}', [ FamilieController::class, 'editFamilyView' ])->middleware('isAnAdministrator');

/*
    Family Member views
*/
Route::get('/members/{id}', [ FamilieMemberController::class, 'familieMemberView' ])->middleware('isAnAdministrator');
Route::get('/members/{id}/add', [ FamilieMemberController::class, 'addFamilieMemberView' ])->middleware('isAnAdministrator');
Route::get('/members/edit/{id}', [ FamilieMemberController::class, 'editFamilyMemberView' ])->middleware('isAnAdministrator');


/*
    Login views
*/
Route::get('/login', [ AuthController::class, 'login' ])->middleware('alreadyLoggedIn')->name('login');
Route::get('/register', [ AuthController::class, 'register' ])->middleware('alreadyLoggedIn');
Route::get('/logout', [ AuthController::class, 'logout' ])->middleware('isLoggedIn');

/*
    Contribution views
*/
Route::get('/contribution/{id}', [ ContributionController::class, 'contributionDashboardView' ])->middleware('isAnAdministrator');
Route::get('/contribution/add/{id}', [ ContributionController::class, 'addContributionView' ])->middleware('isAnAdministrator');
Route::get('/contribution/edit/{id}', [ ContributionController::class, 'editContributionView' ])->middleware('isAnAdministrator');

/*
    Bookyear views
*/
Route::get('/bookyear', [ BookyearController::class, 'bookyearDashboardView' ])->middleware('isAnAdministrator');
Route::get('/bookyear/add', [ BookyearController::class, 'addBookyearView' ])->middleware('isAnAdministrator');
Route::get('/bookyear/edit/{id}', [ BookyearController::class, 'editBookyearView' ])->middleware('isAnAdministrator');


/*
    <------------
    Functions
    ------------>
*/

/*
    Login functions
*/
Route::post('registerUserRoute', [ AuthController::class, 'registerUser' ])->name('registerUser');
Route::post('loginUserRoute', [ AuthController::class, 'loginUser' ])->name('loginUser');

/*
    Family functions
*/
Route::post('addFamilyRoute', [ FamilieController::class, 'addFamily' ])->middleware('isAnAdministrator')->name('addFamily');
Route::post('editFamilyRoute/{id}', [ FamilieController::class, 'editFamily' ])->middleware('isAnAdministrator')->name('editFamily');
Route::get('deleteFamilyRoute/{id}', [ FamilieController::class, 'deleteFamily' ])->middleware('isAnAdministrator')->name('deleteFamily');

/*
    Family member functions
*/
Route::post('addFamilyMemberRoute/{id}', [ FamilieMemberController::class, 'addFamilyMember' ])->middleware('isAnAdministrator')->name('addFamilyMember');
Route::post('editFamilyMemberRoute/{id}', [ FamilieMemberController::class, 'editFamilyMember' ])->middleware('isAnAdministrator')->name('editFamilyMember');
Route::get('deleteFamilyMemberRoute/{id}', [ FamilieMemberController::class, 'deleteFamilyMember' ])->middleware('isAnAdministrator')->name('deleteFamilyMember');

/*
    Contribution functions
*/
Route::post('addContributionRoute/{id}', [ ContributionController::class, 'addContribution' ])->middleware('isAnAdministrator')->name('addContribution');
Route::post('editContributionRoute/{id}', [ ContributionController::class, 'editContribution' ])->middleware('isAnAdministrator')->name('editContribution');
Route::get('deleteContributionRoute/{id}', [ ContributionController::class, 'deleteContribution' ])->middleware('isAnAdministrator')->name('deleteContribution');

/*
    Bookyear functions
*/
Route::post('addBookyearRoute', [ BookyearController::class, 'addBookyear' ])->middleware('isAnAdministrator')->name('addBookyear');
Route::post('editBookyearRoute/{id}', [ BookyearController::class, 'editBookyear' ])->middleware('isAnAdministrator')->name('editBookyear');
Route::get('deleteBookyearRoute/{id}', [ BookyearController::class, 'deleteBookyear' ])->middleware('isAnAdministrator')->name('deleteBookyear');