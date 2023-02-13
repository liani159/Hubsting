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

        //simple
        /* $results = DB::table('teams')
            ->join('users', 'teams.owner_id', '=', 'users.id')
            ->select('teams.name as nome', 'teams.id as id_team', 'users.name as owner_name',
                'teams.created_at as created_at')
            ->get(); */ 

            $results = DB::table('teams')
            ->leftJoin('files', 'teams.id', '=', 'files.team_id')
            ->leftJoin('users', 'teams.owner_id', '=', 'users.id')
            ->selectRaw('teams.*, sum(files.size) as total_size, users.name as owner_name,
                IF(sum(files.size) >= 1073741824, concat(round(sum(files.size) / 1073741824, 2), " GB"),
                IF(sum(files.size) >= 1048576, concat(round(sum(files.size) / 1048576, 2), " MB"),
                IF(sum(files.size) >= 1024, concat(round(sum(files.size) / 1024, 2), " KB"),
                IF(sum(files.size) > 1, concat(sum(files.size), " octets"),
                IF(sum(files.size) = 1, "1 octet",
                "0 octet"))))) as total_size_formatted,
                DATE_FORMAT(teams.created_at, "%d/%m/%Y") as created_at_formatted')
            ->groupBy('teams.id')
            ->get();

            //without conversion
            /* $results = Team::leftJoin('files', 'teams.id', '=', 'files.team_id')
            ->leftJoin('users', 'teams.owner_id', '=', 'users.id')
            ->selectRaw('teams.*, sum(files.size) as total_size, users.name as owner_name')
            ->groupBy('teams.id')
            ->get(); */

            /* foreach ($results as $result) {
                echo $result->name. ' cree par '. $result->owner_name . ' a un total de ' . $result->total_size . ' octets de fichiers associés. </br>';
            } */

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
