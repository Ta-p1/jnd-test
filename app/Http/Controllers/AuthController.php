<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Link;

class AuthController extends Controller
{
    public function register(Request $req)
    {
        $user = new User;
        $user->name = $req->name;
        $user->username = $req->username;
        $user->email = $req->email;
        $user->role = "user";
        $user->password = Hash::make($req->password);
        $user->save();

        Auth::login($user);

        return redirect('/')->with('success', 'Register successful!');
    }

    public function login(Request $request)
    {
        $login_type = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$login_type => $request->login, 'password' => $request->password])) {
            $user = Auth::user();
            if (auth()->user()->role === 'admin') {
                return redirect('/admin');
            } else {
                return redirect('/')->with('success', 'Login successful!');
            }
        }



        return back()->withErrors(['login' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
