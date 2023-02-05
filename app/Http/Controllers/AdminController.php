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
    

            $results = DB::table('users')
                        ->join('files', 'users.id', '=', 'files.user_id')
                        ->select('users.name as name', 'users.id as id', 'users.email as email',
                            DB::raw("DATE_FORMAT(users.created_at, '%d/%m/%Y') as created_at"), DB::raw("SUM(files.size) AS size,
                            CASE
                                WHEN SUM(files.size) >= 1073741824 THEN CONCAT(ROUND(SUM(files.size) / 1073741824, 2), ' GB')
                                WHEN SUM(files.size) >= 1048576 THEN CONCAT(ROUND(SUM(files.size) / 1048576, 2), ' MB')
                                WHEN SUM(files.size) >= 1024 THEN CONCAT(ROUND(SUM(files.size) / 1024, 2), ' KB')
                                ELSE CONCAT(SUM(files.size), ' B')
                            END AS size_formatted"))
                        ->groupBy('users.id')
                        ->get();

        //dd($results);
        if($request->ajax()){
            return datatables()->of($results)->toJson();
        }

        return view('admins_views.users');
    }
    
    public function show_teams_users(Request $request){
        $teams = Team::all();

        $results = DB::table('teams')
            ->join('users', 'teams.owner_id', '=', 'users.id')
            ->select('teams.name as nome', 'teams.id as id_team', 'users.name as owner_name',
                'teams.created_at as created_at')
            ->get(); 
            /* $results = DB::table('teams')
            ->join('users', 'teams.owner_id', '=', 'users.id')
            ->leftJoin(DB::raw('(SELECT team_id, SUM(files.size) as size FROM files GROUP BY team_id) as files'), function($join) {
                $join->on('teams.id', '=', 'files.team_id');
            })
            ->select('teams.name as nome', 'teams.id as id_team', 'users.name as owner_name',
                'teams.created_at as created_at', 'files.size')
            ->groupBy('teams.owner_id')
            ->havingRaw('COUNT(teams.owner_id) <= 1')
            ->get(); */


        //dd($results);
        if($request->ajax()){
            return datatables()->of($results)->toJson();
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
