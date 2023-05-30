<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TraineeAuth
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('trainee')->check()) {
            return $next($request);
        }

        return response()->json(['message' => 't-Unauthorized'], 401);
    }
}
