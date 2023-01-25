<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Obj;
use App\Models\User;
use App\Models\Files;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    /* public function __construct(){
        ths->middleware('auth');
    } */

    public function index(){
        return view('land_page');
    }

    public function user_home(Request $request){
        //for current user
        /*recupiamo l'oggetto di base creato alla creazione dell'user
        che ci permetera di navigare nei folder*/ 
        $obj = Obj::with('children.objectable')->where('user_id',$request->user()->id)
        ->where('uuid', $request->get('uuid', Obj::where('user_id',$request->user()->id)
        ->whereNull('parent_id')
        ->first()->uuid))
        ->firstOrFail();

        //dd($obj->children);

        //return view('users_views.index', ['obj' => $obj]);

        //for return with path of ancestors
        return view('users_views.index', ['obj' => $obj,
        'ancestors' => $obj->ancestorsAndSelf]);
    }

    public function admin_home(Request $request){
        $simple = User::where('as_paid', false)->count();
        $premium = User::where('as_paid', true)->count();
        $admins = User::where('is_admin', true)->count();
        $lista = [$simple, $premium, $admins];
        //total Users
        $total_users = User::all()->count();
        //number of monthly new users
        $num_new_users = User::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->get(['name','created_at'])->count();
        //dd($lista);

        /*number of user registrated each month */
        $userCountByMonth = User::selectRaw('count(id) as count, MONTH(created_at) as month')
            ->groupBy('month')
            ->get();
        //dd($userCountByMonth);

        //total storage used
        $total_storage = Files::all()->sum('size');

        $units = ['b', 'kb', 'mb', 'gb'];

        for($i = 0; $total_storage >1024; $i++){
            $total_storage /= 1024 ;
        }

        $total_storage = round($total_storage, 2) ." ". $units[$i];


        return view('admins_views.index',['lista' => $lista, 'total_users' =>$total_users,
            'num_news_users' =>$num_new_users, 'userCountByMonth' =>$userCountByMonth,
            'total_storage' =>$total_storage]);
    }

    public function download(Files $file){
        //dd($file);
         return Storage::disk('local')->download($file->path, $file->name);
    }

    public function team_home(Request $request, $team_id){
        //for current user
        /*recupiamo l'oggetto di base creato alla creazione dell'user
        che ci permetera di navigare nei folder*/ 
        $obj = Obj::with('children.objectable')->where('team_id',$team_id)
        ->where('uuid', $request->get('uuid', Obj::where('team_id',$team_id)
        ->whereNull('parent_id')
        ->first()->uuid))
        ->firstOrFail();

        //dd($obj->children);

        //return view('users_views.index', ['obj' => $obj]);

        //for return with path of ancestors
        return view('users_views.team_index', ['obj' => $obj,
        'ancestors' => $obj->ancestorsAndSelf, 'team_id' => $team_id]);
    }
}
