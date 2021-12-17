<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        $token = Auth::login($user);

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only([
            'email', 'password'
        ]);

        // $user = User::where('email', $credentials['email'])->first();

        // if (!$user || !Hash::check($credentials['password'], $user->password)) {
        //     return response()->json([
        //         'message' => 'Invalid credentials'
        //     ], 401);
        // }

        // $token = Auth::login($user);

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
        return response()->json([
            'token' => $token,
            'user' => Auth::user()
        ]);
    }

    public function getActiveUser()
    {
        $activeUser = Auth::user();

        return response()->json($activeUser);
    }

    public function logout()
    {
        Auth::logout();
    }
    
    public function refreshToken()
    {
        $newToken = Auth::refresh();

        return response()->json([
            'token' => $newToken
        ]);
    }
}
