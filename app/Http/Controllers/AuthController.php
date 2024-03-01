<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login','register','refresh','logout']]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|max:120',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|integer|in:1,2',
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Pastikan menggunakan Hash::make
            'role' => $request->role,
        ]);

        $token = Auth::guard('api')->login($user);

        return response()->json(['token' => $token], 200);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $token = Auth::guard('api')->attempt($credentials);

        if (!$token) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token], 200);
    }

    public function logout()
    {
        Auth::guard('api')->logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
}
