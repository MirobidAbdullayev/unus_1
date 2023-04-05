<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthManagerController extends Controller
{
    public function login_view()
    {
        return view('login_view');
    }

    public function register_view()
    {
        return view('register_view');
    }

    public function login_viewPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home.userpage'));
        }
        return redirect(route('login_view'))->with("error", "Login details are not valid");
    }

    public function register_viewPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $date['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($date);
        if(!$user){
            return redirect(route('register_view'))->with("error", "Registration failed, try again.");
        }
        return redirect(route('login_view'))->with("success", "Registration success, Login to access the app");
    }

    public function logout_view(){
        Session::flush();
        Auth::logout();
        return redirect(route('login_view'));
    }
}
