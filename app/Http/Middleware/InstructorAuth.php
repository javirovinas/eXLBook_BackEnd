<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use app\Models\Instructor_details;

class InstructorAuth
{
    /*public function handle($request, Closure $next)
    {
        if (Auth::guard('instructor')->check()) {
            return $next($request);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }*/
}
