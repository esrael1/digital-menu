<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
   public function register(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'phone' => 'required',
        'business_name' => 'required|string|max:255',
        'tin' => 'required|unique:users,tin',
        'password' => 'required|min:6|confirmed',
    ]);

    // Generate base slug from business name
    $baseSlug = Str::slug($request->business_name);

    // Ensure slug uniqueness
    $slug = $baseSlug;
    $count = 1;
    while (User::where('slug', $slug)->exists()) {
        $slug = $baseSlug . '-' . $count++;
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'business_name' => $request->business_name,
        'tin' => $request->tin,
        'slug' => $slug,
        'password' => Hash::make($request->password),
    ]);

    return response()->json([
        'message' => 'Registration successful',
        'data' => [
            'email' => $user->email,
            'business_name' => $user->business_name,
            'menu_url' => url('/menu/' . $user->slug),
        ],
    ], 201);
}

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken(Str::random(10))->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'token' => $token
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
