<?php

namespace App\Http\Controllers\auth\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use RohanAdhikari\NepaliDate\NepaliDate;

class Register extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:30', 
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:8'
        ]);
       $user = User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password'],)
       ]);
        $accesstokenexpiration = now()->addDays(7);
        $accesstoken = $user->createToken('access_token', ['*'], $accesstokenexpiration)->plainTextToken;
        
        $refresh_token = $user->createToken('refresh_token', ['refresh'], $accesstokenexpiration)->plainTextToken;
        return response()->json([
            'message' => 'User added successfully, save the token',
            'access_token' => $accesstoken,
            'access_token_expires_at' => $accesstokenexpiration,
            'refresh_token' => $refresh_token,
            'refresh_token_expires_at' => $accesstokenexpiration,
        ]);

    }
}
