<?php

namespace App\Http\Controllers;

// En el controlador de autenticación de tu API (por ejemplo, AuthController)
use Illuminate\Support\Facades\Auth;
use App\Models\User;

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        $token = $user->createToken('YourAppName')->plainTextToken;

        return response()->json(['token' => $token]);
    }

    return response()->json(['message' => 'Unauthorized'], 401);
}
