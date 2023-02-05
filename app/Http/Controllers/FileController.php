<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Files;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FileController extends Controller
{
    //
    /* public function index ($request){
        $obj = Obj::where('uuid', $request->uuid)->firtOrFail();

        
    } */

    public function search($search){
        //Log::error('Erreur lors de la requête de recherche : '.$search);
        //error_log('Searching for: '. $search);
        $search =$search;
        //dd($search);
        $files = Files::where('user_id', Auth()->user()->id)->where('name', 'like', "$search%")->get();
        //dd($files);
        //Log::error("Erreur 2: ".$files);
        return response()->json([
            'message' => 'success',
            'data' => $files,
        ], 200);

    }

    public function ricerca($search, $teamId){
        //Log::error('Erreur lors de la requête de recherche : '.$search);
        //error_log('Searching for: '. $search);
        $search =$search;
        //dd($teamId);
        $files = Files::where('team_id', $teamId)->where('name', 'like', "$search%")->get();
        //dd($files);
        //Log::error("Erreur 2: ".$files);
        return response()->json([
            'message' => 'success',
            'data' => $files,
        ], 200);

    }
    
}
