<?php

namespace App\Http\Controllers;

use App\Models\Trainee_details;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin_login;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
class AdminAuthController extends Controller
{
    public function createAdmin(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin_login::create([
            'username' => $data['username'],
            'password' => $data['password'],
            'api_token' => Str::random(60), // Generate a random token
        ]);

        return response()->json([
            'message' => 'Admin created successfully',
            'admin' => $admin,
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin_login::where('username', $credentials['username'])->first();

        if ($admin && $admin->password === $credentials['password']) {
            $token = $admin->createToken('admin-token')->plainTextToken;
            return response()->json(['token' => $token], 200);
        }

        throw ValidationException::withMessages(['username' => 'Invalid credentials']);
    }
}