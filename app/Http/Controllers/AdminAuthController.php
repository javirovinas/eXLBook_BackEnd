<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Admin_login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $admin = Admin_login::where('username', $credentials['username'])->first();

        if ($admin && password_verify($credentials['password'], $admin->password)) {
            $admin->api_token = Str::random(60);
            $admin->save();

            return response()->json(['token' => $admin->api_token], 200);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}