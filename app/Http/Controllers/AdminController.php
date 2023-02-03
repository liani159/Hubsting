<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function show_users(Request $request){
        $users= User::all();
        if($request->ajax()){
            return datatables()->of(User::all())->toJson();
        }
        /* if($request->ajax()){
            return datatables()->of($users)->addIndexColumn()->addColumn('action', 
        function($users){
            return '<input type="button" value="Delete" class="btn btn-danger delu" data-id="'.$users->id.'"/a>';
            //return '<a href="{{route('.'admin.del'.', [ '.'id'.'=>'.$users->id.'])}}" class="btn btn-danger delu" data-id="'.$users->id.'">Delete</a>';
        })->rawColumns(['action'])->make(true);
        } */

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

    public function delete_user_admin(Request $request){
        $take = DB::table('users')->where('id', $request->id)->get(); 

        dd($take[0]->id);
        return response()->json([
            'message' => 'ok!',
            'data' => $take[0]->id,
        ], 200);
    }

}
