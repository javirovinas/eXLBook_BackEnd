<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
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
        
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin_login::create([
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            
        ]);

        return $this->success([
            'token' => $admin->createToken('api_token')->plainTextToken
        ]);
    }

    public function login(Request $request, Response $response)
    {
            $data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
    
        $admin = Admin_login::where('username', $data['username'])->first();
    
        if (!$admin || !Hash::check($data['password'], $admin->password)) {
            return $this->error('Credentials not match', 401);
        }
    
        $token = $admin->createToken('api_token')->plainTextToken;
        $admin->api_token = $token; // Assign the token to the `api_token` attribute
        $admin->save(); // Save the model with the updated token
    
        return $this->success([
            'token' => $token
        ]);
    }
}