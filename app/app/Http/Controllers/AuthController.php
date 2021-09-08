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

        // $user = User::where('email', $request->email)->first();

        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     throw ValidationException::withMessages([
        //         'email' => ['The provided credentials are incorrect.'],
        //     ]);
        // }
        // return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout(Request $request)
    {
        $cookie = Cookie::forget('jwt');
        return response()->json(['msg' => 'Не авторизован'])->withCookie($cookie);
    }
    public function user()
    {
        return Auth::user();
    }
}
