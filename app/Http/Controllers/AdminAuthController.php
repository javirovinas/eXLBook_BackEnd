<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admin_login;

class AdminAuthController extends Controller    
{
    public function login(Request $request)
    {
    $credentials = $request->only('username', 'password');

    // Validate the login credentials
    $validatedData = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Check if the provided credentials match any entry in the `admin_login` table
    $admin = Admin_login::where('username', $credentials['username'])
        ->where('password', $credentials['password'])
        ->first();

    if ($admin) {
        // Authentication successful
        $admin->api_token = Str::random(60);
        $admin->save();

        return response()->json(['token' => $admin->api_token], 200);
    }

    // Authentication failed
    return response()->json(['error' => 'Invalid credentials'], 401);
    }
}