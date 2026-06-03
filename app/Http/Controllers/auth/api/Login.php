<?php

namespace App\Http\Controllers\Auth\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['error' => 'Wrong email or password'], 401);
        }

        $accessTokenExpiration = now()->addDays(7);
        $accessToken = $user->createToken('access_token', ['*'], $accessTokenExpiration)->plainTextToken;

        $refreshTokenExpiration = now()->addDays(20);
        $refreshToken = $user->createToken('refresh_token', ['refresh'], $refreshTokenExpiration)->plainTextToken;

        return response()->json([
            'message' => 'Login successful, save the token',
            'access_token' => $accessToken,
            'access_token_expires_at' => $accessTokenExpiration,
            'refresh_token' => $refreshToken,
            'refresh_token_expires_at' => $refreshTokenExpiration,
        ]);
    }
}
