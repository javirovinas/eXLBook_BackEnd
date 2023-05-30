<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin_login;
use Illuminate\Support\Facades\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->check()) {
            return $next($request);
        }
        else{
        return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
