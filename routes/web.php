<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FileController;
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


Route::get('/root', [MainController::class, 'user_home'])->name('home.user');

//Middleware for UserAccess
//user
 //Users: Middleware -Creation(takes in account all the normal users(Non admin users) actions)
Route::middleware(['auth', 'user-access:user'])->group(
    function(){
        /* Route::get('/user/home', [MainController::class, 'user_home'])->name('home.user');
        Route::get('/user/home', [MainController::class, 'user_home'])->name('home.user'); */
        //
        Route::get('/plan', [UserController::class, 'asPaid'])->name('myPlan');
        Route::get('/plan/sub/{value}', [UserController::class, 'subscribe'])->name('subscribe');
        Route::get('/plan/unsub/{value}', [UserController::class, 'unsubscribe'])->name('unsubscribe');
        /*Route::POST('/members/add', [TeamController::class, 'addMember'])->name('addMember');
        Route::POST('/members/delete/{id}', [TeamController::class, 'deleteMember'])->name('deleteMember'); */
        
        /* Route::get('/user/home/team/{team_id}', [MainController::class, 'team_home'])->name('home.team_u');
        Route::get('/files/{file}', [MainController::class, 'download'])->name('download');
        //Route::resource('teams', TeamController::class);
        //update team
        Route::post('teams/edit', [TeamController::class, 'update'])->name('update');
        //Delete team
        Route::post('teams/delete/{owner_id}/{id_team}', [TeamController::class, 'destroy'])->name('deleteTeam');
        
        Route::resource('members', MemberController::class);
        Route::get('/members/delete/{id}/{id_team}', [MemberController::class, 'destroy'])->name('deleteMember'); */ 

    }
);
//general-route
//common routes used by admins and users
Route::resource('teams', TeamController::class);
Route::get('/home/team/{team_id}', [MainController::class, 'team_home'])->name('home.team');
Route::get('/files/{file}', [MainController::class, 'download'])->name('download');
 //update team
 Route::post('/teams/edit', [TeamController::class, 'update'])->name('update');
 //Delete team
 Route::post('/teams/delete/{owner_id}/{id_team}', [TeamController::class, 'destroy'])->name('deleteTeam');

Route::resource('members', MemberController::class);
Route::get('/members/delete/{id}/{id_team}', [MemberController::class, 'destroy'])->name('deleteMember');

//search don't work
Route::get('/search/{search}', [FileController::class, 'search'])->name('search');
Route::get('/ricerca/{search}/{teamId}', [FileController::class, 'ricerca'])->name('ricerca');

//pricing: Route to have the price
Route::get('/pricing', [MainController::class, 'pricing'])->name('pricing');


 //admin: Middleware -Creation(takes in account all the admin actions)
Route::middleware(['auth', 'user-access:admin'])->group(
    function(){
        Route::get('/admin/my_space', [MainController::class, 'user_home'])->name('admin.space');
        Route::get('/admin/home', [MainController::class, 'admin_home'])->name('home.admin');
        Route::get('/admin/show/users', [AdminController::class, 'show_users'])->name('admin.show_user');
        Route::get('/admin/show/teams_users', [AdminController::class, 'show_teams_users'])->name('admin.show_teams_user');
    
        //Route::get('/admin/delete/{id}', [AdminController::class, 'delete_user_admin'])->name('admin.del');
        //just to show the difference between siple user an admin
/*         Route::get('/admin/home/team/{team_id}', [MainController::class, 'team_home'])->name('home.team');
        Route::get('admin/files/{file}', [MainController::class, 'download'])->name('download'); */
        
       /*  //update team
        Route::post('admin/teams/edit', [TeamController::class, 'update'])->name('update');
        //Delete team
        Route::post('admin/teams/delete/{owner_id}/{id_team}', [TeamController::class, 'destroy'])->name('deleteTeam');

        Route::resource('members', MemberController::class);
        Route::get('admin/members/delete/{id}/{id_team}', [MemberController::class, 'destroy'])->name('deleteMember'); */

    }
);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
