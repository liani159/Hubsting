<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {       
        $ownerId = Auth::user()->id;
        //$teams = Team::all();
        $teams = User::find($ownerId);
        //dd($teams->teams);
        return view('users_views.teams', ['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['name' => ['required', 'min:3']]);
        $nameTeam = $request->name;
        $ownerId = Auth::user()->id;


       $newTeam = Team::create(['name' => $nameTeam, 'owner_id' => $ownerId]);
       //recupero l id della nuova team creata
        $teamId = $newTeam->id;
        //associazione
        DB::table('team_user')->insert([
            ['user_id' => $ownerId, 'team_id' => $teamId]
        ]);
        

        return redirect()->route('teams.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //dd($team->id);
        $members = Team::find($team->id);
        //dd($teams->teams);
        return view('users_views.members', ['members' => $members, 'id_team' =>$team->id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //rename the team
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /* public function members(Team $team){
        //dd($team->id);
        $members = Team::find($team->id);
        //dd($teams->teams);
        return view('users_views.members', ['members' => $members, 'id_team' =>$team->id]);
    } 

    public function addMember(Request $request){

        $request->validate(['mail' => ['required', 'email', 'max:255']]);
        $email = $request->mail;
        $id_team = $request->id_team;
        $user = User::where('email', $email)->get();
        // $members = Team::find($team->id); 

        $new = $user[0];
        $t= DB::table('team_user')->where('user_id', $new->id)->get();

        if($t[0]!= null){
            DB::table('team_user')->insert([
                ['user_id' => $new->id, 'team_id' => $id_team]
            ]); 
        }

        return response()->json([
            'message' => 'ok!',
            'data' => $new,
        ], 200);
    }

    public function deleteMember(Team $id){


    } */

}
