<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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




Route::get('/',[HomeController::class, 'index'])->name('home.index');

Route::get('/login',[UserController::class, 'login'])->name('user.login');
Route::get('/registration',[UserController::class, 'index'])->name('user.registration');


Route::post('/validate',[UserController::class, 'validate_registration'])->name('user.validate');
Route::post('/validate_login',[UserController::class, 'validate_login'])->name('user.log');
Route::get('/logout',[UserController::class, 'logout'])->name('user.logout');


//Middleware for UserAccess
//user
Route::middleware(['auth', 'user-access:user'])->group(
    function(){
        Route::get('/user/home', [HomeController::class, 'user_home'])->name('home.user');
        Route::get('/files/{file}', [HomeController::class, 'download'])->name('download');
    }
);

//admin
Route::middleware(['auth', 'user-access:admin'])->group(
    function(){
        Route::get('/admin/home', [HomeController::class, 'admin_home'])->name('home.admin');
    }
);
