<?php

namespace App\Http\Controllers;


use Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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
        If (!Auth::guard('web')->attempt($request->only('email', 'password'))) {
            return response(['msg' => 'no!'], 401);
        }
        $user = Auth::guard('web')->user();

        $token = $user->createToken('token')->plainTextToken;

        $cookie = cookie('jwt', $token, 60 * 24);

        return response(['msg' => 'yes!'])->withCookie($cookie);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $cookie = Cookie::forget('jwt');
        return response()->json(['msg' => 'Не авторизован'])->withCookie($cookie);
        return redirect('/welcome');
    }
    public function user()
    {
        return Auth::user();
    }
}
