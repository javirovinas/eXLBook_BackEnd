<?php

namespace App\Http\Middleware;

use App\Models\Admin_login;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuth
{
    public function handle($request, Closure $next)
    {
        $apiToken = $request->header('api_token');

        if ($apiToken) {
            // Check if the current user is an admin
            $admin = Admin_login::where('api_token', $apiToken)->first();

            if ($admin && Hash::check($apiToken, $admin->api_token)) {
                // Admin is authenticated, proceed with the request
                return $next($request);
            }
        }

        // Admin authentication failed, return an unauthorized response
        return response()->json(['error' => 'Unauthenticated'], 401);
    }
}
