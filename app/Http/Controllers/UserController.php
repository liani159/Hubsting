<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Http\Controllers\Rule;

class UserController extends Controller
{
    // registration
    public function index(){
        return view('user_auth.registration');
    }

    // login
    public function login(){
        return view('user_auth.login');
    }

    public function validate_registration(Request $request){

        $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email','unique:users'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        $formRegistration = $request->all();
        $formRegistration['password'] = Hash::make($formRegistration['password']);

        $user = User::create($formRegistration);

        //fait le login directement apres la creation de l'user
        auth()->login($user);

        return redirect('/')->with('message','Welcome liani');


    }

    public function validate_login(Request $request){
        

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            if(auth()->user()->is_admin == 1){
                return redirect()->route('home.admin');
            }else if(auth()->user()->is_admin == 0){
                return redirect()->route('home.user');
            }

            /*1- return redirect()->route('user.login')>with('Error', 'Email or and password are wrong');
                or
            2- return redirect()->intended('/')->with('message', 'you are now logged in'); */
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request){

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }


    public function asPaid(){
        
        return view('users_views.my_plan');
    }
    
    public function subscribe(Request $request){
        //dd($request->value);
        $user = User::find(auth()->user()->id);
        //User::where('id', auth()->user()->id)->update(['as_paid', $request->value]);
        $user->update(['as_paid' => true]);
        return response()->json([
            'message' => 'ok!',
            'data' => $user->as_paid
        ], 200);
        
    }


    public function unsubscribe(Request $request){
        //dd($request->value);
        $user = User::find(auth()->user()->id);
        //User::where('id', auth()->user()->id)->update(['as_paid', $request->value]);
        $user->update(['as_paid' => false]);
        return response()->json([
            'message' => 'ok!',
            'data' => $user->as_paid
        ], 200);
        
    }
}
