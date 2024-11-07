<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming data (email and password)
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        // Attempt to find the user by email
        $user = User::where('email', $request->email)->first();

        // If user does not exist, create a new user
        if (!$user) {
            // Create a new user and hash the password before saving
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'name' => $request->name ?? '', // You can add other default fields if needed
            ]);
        } else {
            // Check if the password matches (if user exists)
            if (!Hash::check($request->password, $user->password)) {
                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }
        }

        // Generate a token for the user
        $token = $user->createToken('YourAppName')->plainTextToken;

        // Return success message with the token
        return response()->json([
            'message' => 'Login successful',
            'token' => $token
        ]);
    }
}
