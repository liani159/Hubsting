<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function show_users(Request $request){
        if($request->ajax()){
            return datatables()->of(User::all())->toJson();
        }

        //dd($users);
        return view('admins_views.users');
    }
    
    public function show_teams_users(Request $request){
        if($request->ajax()){
            return datatables()->of(Team::all())->toJson();
        }
        //dd($teams);
        return view('admins_views.users_teams');
    }

}
