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

        // Attempt to authenticate the admin
        if (auth()->attempt($credentials)) {
            // Authentication successful
            $admin = Admin_Login::where('username', $credentials['username'])->first();

            // Generate a new API token for the admin
            $admin->api_token = Str::random(60);
            $admin->save();

            return response()->json(['token' => $admin->api_token], 200);
        }

        // Authentication failed
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}