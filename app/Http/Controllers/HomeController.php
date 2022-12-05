<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /* public function __construct(){
        ths->middleware('auth');
    } */

    public function index(){
        return view('land_page');
    }

    public function user_home(){
        return view('users_views.index');
    }

    public function admin_home(){
        return view('admins_views.index');
    }
}
