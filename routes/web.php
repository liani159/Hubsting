<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Auth;
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


/* Route::get('/', function () {
    return view('welcome');
}); */


Route::get('/',[MainController::class, 'index'])->name('home.index');

/* Route::get('/login',[UserController::class, 'login'])->name('user.login');
Route::get('/registration',[UserController::class, 'index'])->name('user.registration');


Route::post('/validate',[UserController::class, 'validate_registration'])->name('user.validate');
Route::post('/validate_login',[UserController::class, 'validate_login'])->name('user.log');
Route::get('/logout',[UserController::class, 'logout'])->name('user.logout'); */


//Middleware for UserAccess
//user
Route::middleware(['auth', 'user-access:user'])->group(
    function(){
        Route::get('/user/home', [MainController::class, 'user_home'])->name('home.user');
        Route::get('/user/home/team/{team_id}', [MainController::class, 'team_home'])->name('home.team');
        Route::get('/files/{file}', [MainController::class, 'download'])->name('download');
        Route::resource('teams', TeamController::class);
        Route::resource('members', MemberController::class);
        Route::get('/members/delete/{id}/{id_team}', [MemberController::class, 'destroy'])->name('deleteMember');
        Route::get('/plan', [UserController::class, 'asPaid'])->name('myPlan');
        Route::get('/plan/sub/{value}', [UserController::class, 'subscribe'])->name('subscribe');
        Route::get('/plan/unsub/{value}', [UserController::class, 'unsubscribe'])->name('unsubscribe');
        /*Route::POST('/members/add', [TeamController::class, 'addMember'])->name('addMember');
        Route::POST('/members/delete/{id}', [TeamController::class, 'deleteMember'])->name('deleteMember'); */
        
    }
);

//admin
Route::middleware(['auth', 'user-access:admin'])->group(
    function(){
        Route::get('/admin/home', [MainController::class, 'admin_home'])->name('home.admin');
    }
);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
