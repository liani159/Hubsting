<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Obj;
use App\Models\User;

class HomeController extends Controller
{
    /* public function __construct(){
        ths->middleware('auth');
    } */

    public function index(){
        return view('land_page');
    }

    public function user_home(Request $request){
        //for current user
        $obj = Obj::where('user_id',$request->user()->id)->where('uuid', $request->get('uuid', Obj::where('user_id',$request->user()->id)->whereNull('parent_id')
        ->first()->uuid))
        ->firstOrFail();

        //dd($obj->children);

        return view('users_views.index', ['obj' => $obj]);
    }

    public function admin_home(Request $request){
        return view('admins_views.index');
    }
}
