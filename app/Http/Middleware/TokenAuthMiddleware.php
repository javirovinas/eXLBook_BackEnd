<?php

namespace App\Http\Middleware;

use App\Models\Admin_login;
use App\Models\Trainee_details;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /*public function handle(Request $request, Closure $next): Response
    {
        if ($request->routeIs('adminlogin')) {
            return $next($request);
        }
        $token = $request->bearerToken();

        if (!$this->authenticateAdmin($token)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }*/

    private function authenticateAdmin($token)
    {
        $admin = Admin_login::where('api_token', $token)->first();

        return $admin !== null;
    }
    private function authenticateTrainee($token)
    {
        $trainee = Trainee_details::where('api_token', $token)->first();

        return $trainee !== null;
    }
}
