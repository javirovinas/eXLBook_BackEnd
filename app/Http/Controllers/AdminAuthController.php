<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Admin_login;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;

class AdminAuthController extends Controller
{
    use ApiResponser;

    public function createAdmin(Request $request)
    {
        try {
            $data = $request->validate([
                'username' => ['required', 'string', 'max:55'],
                'password' => ['required', 'string', 'min:6'],
            ]);

            $admin = Admin_login::create([
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
            ]);
        return response()->json([
            'token' => $admin->createToken('api_token')->plainTextToken
        ]);
    } catch (\Exception $e) {
        throw $e;
    }
    }

    public function login(Request $request, Response $response)
    {
        try {
            $data = $request->validate([
                'username' => ['required', 'string', 'max:55'],
                'password' => ['required', 'string', 'min:6']
            ]);

            $admin = Admin_login::where('username', $data['username'])->first();

            if (!$admin || !Hash::check($data['password'], $admin->password)) {
                return $this->success(['error' => 'Credentials do not match'], 401);
            }

            $token = $admin->createToken('api_token')->plainTextToken;
            $admin->api_token = $token; // Assign the token to the `api_token` attribute
            $admin->save(); // Save the model with the updated token

        } catch (\Exception $e) {
            throw $e;
        }
            return $this->success([
                'token' => $token
            ]);
    }
}
