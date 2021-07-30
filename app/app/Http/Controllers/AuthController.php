<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Laravel\Sanctum\NewAccessToken;
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
    /** @var \App\Models\User */

    public function login(Request $request)
    {

        if (Auth::guard('web')->attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            return response([
                'message' => 'Success'
            ]);
        }
        return response([
            'message' => 'invalid auth'
        ]);

    }
    public function user()
    {
        return Auth::user();
    }
}
