<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdmin_loginRequest;
use App\Http\Requests\UpdateAdmin_loginRequest;
use Illuminate\Http\Request;
use App\Models\Admin_login;
use App\Models\Trainee_details;
use App\Models\Instructor_details;
use App\Http\Requests\Updatetrainee_detailsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponser;

class AdminController extends Controller
{
    use ApiResponser;
    
    public function createInstructor(Request $request)
    {
        try {
            $admin = Auth::guard('sanctum')->user();
            if (!$admin) {
                return $this->error('Unauthorized', 401);
            }
        
            $data = $request->validate([
                'uid' => 'required',
                'first_name' => 'required',
                'family_name' => 'required',
                'email' => 'required|email',
                'username' => 'required',
                'password' => 'required',
            ]);

            $instructorData = [
                'uid' => $data['uid'],
                'first_name' => $data['first_name'],
                'family_name' => $data['family_name'],
                'i_username' => $data['username'],
                'i_password' => Hash::make($data['password']),
                'email' => $data['email']
            ];

            $instructor = Instructor_details::create($instructorData);
        } catch (\Exception $e) {
            throw $e;
        }
            return $this->success([
                'token' => $instructor->createToken('api_token')->plainTextToken
            ], 200);

    }

    public function createTrainee(Request $request)
    {
        try {
            $admin = Auth::guard('sanctum')->user();
            if (!$admin) {
                return $this->error('Unauthorized', 401);
            }

            $data = $request->validate([
                'uid' => 'required',
                'first_name' => 'required',
                'family_name' => 'required',
                'email' => 'required|email',
                'username' => 'required',
                'password' => 'required',
            ]);

            $trainee = Trainee_details::create([
                'uid' => $data['uid'],
                'first_name' => $data['first_name'],
                'family_name' => $data['family_name'],
                't_username' => $data['username'],
                't_password' => bcrypt($data['password']),
                'email' => $data['email'],
            ]);

            return $this->success([
                'trainee' => $trainee,
                'token' => $trainee->createToken('api_token')->plainTextToken
            ], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function updateTrainee(Updatetrainee_detailsRequest $request, Trainee_details $trainee_details, $trainee_id)
    {
        try {
            $admin = Auth::guard('sanctum')->user();
            if (!$admin) {
                return $this->error('Unauthorized', 401);
            }

            $data = $request->validated();

            $trainee = Trainee_details::findOrFail($trainee_id);

            $trainee->update([
                'uid' => $data['uid'],
                'first_name' => $data['first_name'],
                'family_name' => $data['family_name'],
                't_username' => $data['username'],
                't_password' => bcrypt($data['password']),
                'email' => $data['email'],
            ]);

            return $this->success([
                'trainee' => $trainee,
            ], 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
