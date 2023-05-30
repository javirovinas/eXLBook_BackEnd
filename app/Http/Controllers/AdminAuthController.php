<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Admin_login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AdminAuth;
class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $isAuthenticated = Admin_login::login($request->username, $request->password);

        if ($isAuthenticated) {
            $admin = Auth::guard('admin')->user();
            $admin->api_token = Str::random(60);
            $admin->save();

            return response()->json(['token' => $admin->api_token], 200);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}