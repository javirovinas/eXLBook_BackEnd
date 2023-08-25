<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructor_detailsRequest;
use App\Http\Requests\UpdateInstructor_detailsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponser;
use App\Models\Instructor_details;
use Illuminate\Database\QueryException;

class InstructorDetailsController extends Controller
{
    use ApiResponser;
    
    public function login(Request $request)
    {
        try {
            $credentials = $request->only('username', 'password');
    
            $instructor = Instructor_details::where('i_username', $credentials['username'])->first();
    
            if ($instructor && Hash::check($credentials['password'], $instructor->i_password)) {
                // Login successful
                $token = $instructor->createToken('api_token', [$instructor->id])->plainTextToken;
                $instructor->api_token = $token; // Assign the token to the `api_token` attribute
                $instructor->save(); // Save the model with the updated token
    
                return $this->success([
                    'token' => $token
                ]);
            }
        
            } catch (\Exception $e) {
            throw $e;
        }
        return response()->json(['error' => 'Incorrect username or password'], 401);
    }

    public function index()
    {
        $admin = Auth::guard('sanctum-admin')->user();
        if (!$admin) {
            return $this->error('Unauthorized', 401);
        }

        $instructors = Instructor_details::all();
        return response()->json(['instructors' => $instructors]);
            
    }

    public function show(Instructor_details $instructor_details, $instructor_id)
    {
        try {
            $admin = Auth::guard('sanctum-admin')->user();
            if (!$admin) {
                return $this->error('Unauthorized', 401);
            }
            $instructor = Instructor_details::find($instructor_id);
    
            if (!$instructor) {
                return $this->error('Instructor not found', 404);
            }
    
            return response()->json([
                'instructor' => $instructor,
            ]);
        } catch (\Exception $e) {
            return $this->error('An error occurred while fetching the instructor', 500);
        }
    }

    public function edit(Instructor_details $instructor_details, $instructor_id)
    {
        try {
            $admin = Auth::guard('sanctum-admin')->user();
            if (!$admin) {
                return $this->error('Unauthorized', 401);
            }

            $instructor = Instructor_details::find($instructor_id);
    
            if ($instructor) {
                return response()->json([
                    'status' => 200,
                    'instructor' => $instructor,
                ], 200);
            } else {
                return $this->error('No Instructor ID found', 404);
            }
        } catch (\Exception $e) {
            return $this->error('An error occurred while editing the instructor', 500);
        }
    }

    public function update(UpdateInstructor_detailsRequest $request, instructor_details $instructor_details, $instructor_id)
    {
        $admin = Auth::guard('sanctum-admin')->user();
        if (!$admin) {
            return $this->error('Unauthorized', 401);
        }
        $instructor = Instructor_details::find($instructor_id);

        if (!$instructor) {
            return response()->json(['message' => 'Instructor not found'], 404);
        }

        $data = $request->validate([
            'uid' => 'required',
            'first_name' => 'required',
            'family_name' => 'required',
            'email' => 'required|email',
            'i_username' => 'required',
            'i_password' => 'required',
            // Add other validation rules for the fields you want to update
        ]);

        try {
            // Check if the updated uid (instructor_id) exists for any other instructor
            $existingInstructorUID = instructor_details::where('uid', $data['uid'])
                ->where('instructor_id', '!=', $instructor->instructor_id)
                ->first();
            
            $existingInstructorUsername = instructor_details::where('i_username', $data['i_username'])
                ->where('instructor_id', '!=', $instructor->instructor_id)
                ->first();

            $existingInstructorEmail = instructor_details::where('email', $data['email'])
                ->where('instructor_id', '!=', $instructor->instructor_id)
                ->first();

            if ($existingInstructorUID) {
                return response()->json(['error' => 'The UID is already assigned to another instructor'], 400);
            }
            if ($existingInstructorUsername) {
                return response()->json(['error' => 'The Username is already assigned to another instructor'], 400);
            }
            if ($existingInstructorEmail) {
                return response()->json(['error' => 'The Email is already assigned to another instructor'], 400);
            }

            // Validate the input data
            if (empty($data['i_username']) || empty($data['i_password'])) {
                return response()->json(['error' => 'Username and Password required.'], 400);
            }
    
            if (!is_numeric($data['uid'])) {
                return response()->json(['error' => 'UID must be an integer.'], 400);
            }
    
            $uidString = (string) $data['uid'];
            if (strlen($uidString) !== 6) {
                return response()->json(['error' => 'UID must be exactly 6 digits long.'], 400);
            }

            if (!is_numeric($data['uid'])) {
                return response()->json(['error' => 'UID must be an integer.'], 400);
            }
    
            $uidString = (string) $data['uid'];
            if (strlen($uidString) !== 6) {
                return response()->json(['error' => 'UID must be exactly 6 digits long.'], 400);
            }

            if (preg_match('/\s/', $data['i_username'])) {
                return response()->json(['error' => 'Username cannot contain spaces.'], 400);
            }     
    
            if (strlen($data['i_username']) > 54) {
                return response()->json(['error' => 'Username is too long.'], 400);
            }

        } catch (QueryException $e) {
            // Handle database connection or query exception
            return response()->json(['error' => 'Failed to update instructor.'], 500);
        }
        
        
        if (isset($data['i_password'])) {
            if ($data['i_password'] == $instructor->i_password) {
                unset($data['i_password']); // Remove password from data if it's the same as the old hash
            } else {
                if (strlen($data['i_password']) < 6) {
                    return response()->json(['error' => 'Password must be at least 6 characters long.'], 400);
                }
                if (preg_match('/\s/', $data['i_password'])) {
                    return response()->json(['error' => 'Password cannot contain spaces.'], 400);
                }
                $data['i_password'] = Hash::make($data['i_password']);
            }
        }
        $instructor->update($data);
        return response()->json(['message' => 'Instructor updated successfully']);

    }
}
    
