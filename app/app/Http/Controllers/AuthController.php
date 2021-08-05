<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        return User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password)
        ]);
    }

    public function login(Request $request)
    {
        Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password]);
        return 'Авторизован';
    }
    // public function loginShow()
    // {
    //     return view('welcome');
    //     return redirect('/');
    // }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        return response()->json(['msg' => 'Не авторизован']);
    }
    public function user() {
        if(Auth::check()) {
            return 'Авторизован';
        }
        return 'Не авторизован';
    }
}
