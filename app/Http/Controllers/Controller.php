<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function login(Request $request)
    {
        $request->validate([
            "email" => "string|email",
            "password" => "string|min:6"
        ]);
        if (Auth::attempt(credentials: ['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // Create an API token for the authenticated user
            $token = $user->createToken('react-portfolio')->plainTextToken;

            // Return the token in the response
            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ]);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
    }
    public function logout(Request $request)
    {
        // Revoke the user's token
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
