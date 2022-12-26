<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //      
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
        //for add member to the team
        $request->validate(['mail' => ['required', 'email', 'max:255']]);
        $email = $request->mail;
        $id_team = $request->id_team;
        $user = User::where('email', $email)->get();
        /* $members = Team::find($team->id); */

        $new = $user[0];
        /* $new->created_at = $new->created_at->format('d F Y'); */
        $t= DB::table('team_user')->where('team_id', $id_team)
            ->where('user_id', $new->id)->first();

        if($t == null){
            DB::table('team_user')->insert([
                ['user_id' => $new->id, 'team_id' => $id_team]
            ]);
            return response()->json([
                'message' => 'ok!',
                'data' => $new,
            ], 200);
        }else{
            return response()->json([
                'message' => 'ok!',
                'data' => $t[0],
            ], 200);
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy(Request $request)
    {
        
        //$a = $request->id;
        /*get the specific team_user where the id and the team_id are those passe
        in parameter to the route in form and with ajax functionality*/
        $t= DB::table('team_user')->where('team_id', $request->id_team)->
        where('user_id', $request->id)
        ->get();

        //$t[0]->delete();
        DB::table('team_user')->where('team_id', $request->id_team)->
        where('user_id', $request->id)
        ->delete();
        

        return response()->json([
            'message' => 'ok!',
            'data' => $t[0],
        ], 200);
    }


    /* public function deleteMember(Request $request){

        $a = $request->id_team;
        $t= DB::table('team_user')->where('team_id', $request->id_team)->
        where('user_id', $request->id)
        ->get();
        

        return response()->json([
            'message' => 'ok!',
            'data' => $a,
        ], 200);

    }  */
}
