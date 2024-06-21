<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request){
        if(request()->isMethod("get")){
            return view("register");
        }elseif(request()->isMethod("post")){
            $request->validate([
                'name'=>'required|string',
                'email'=>'required|email|unique:users',
                'emp_id'=>'required|string',
                'password'=>'required'
            ]);

            User::create([
                'name'=> $request->name,
                'email'=> $request->email,
                'emp_id'=> $request->emp_id,
                'password'=> bcrypt($request->password)
            ]);
            return to_route('login')->with('success','User Registered Successfully.Plz Log In.');
        }
    }
    public function login(Request $request){
        if(request()->isMethod("get")){
            return view("login");
        }
        elseif(request()->isMethod("post")){
            $request->validate([
                "email"=> "required|email",
                "password"=> "required"
            ]);
            if (Auth::attempt($request->only('email', 'password'))) {
                return to_route('calendar.index');
            }else{
                return to_route('login')->with('error','Wrong Credentials Entered.');
            }
        }
    }
    public function dashboard(){
        return view("dashboard");
    }
    public function profile(){

    }
    public function logout(){
        Auth::logout();
        Session::flush();
        return to_route('login')->with('success','User Logged Out Successfully');
    }
}
