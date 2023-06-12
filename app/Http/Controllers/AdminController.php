<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdmin_loginRequest;
use App\Http\Requests\UpdateAdmin_loginRequest;
use Illuminate\Http\Request;
use App\Models\Admin_login;
use App\Models\Trainee_details;
use App\Models\Instructor_details;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    
    public function createInstructor(Request $request)
    {

        $token = $request->header('Authorization');
        if (!$this->authenticateAdmin($token)) {
            throw ValidationException::withMessages(['token' => 'Invalid token']);
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
        'UID' => $data['uid'],
        'first_name' => $data['first_name'],
        'family_name' => $data['family_name'],
        'i_username' => $data['username'],
        'i_password' => Hash::make($data['password']),
        'email' => $data['email']
    ];

    $instructor = Instructor_details::create($instructorData);

    return response()->json([
        'message' => 'Instructor created successfully',
        'instructor' => $instructor,
        ]);
    }

    public function createTrainee(Request $request)
    {

        /*$adminToken = $request->header('Authorization');
    
        if (!$this->authenticateAdmin($adminToken)) {
            return response()->json(['message' => 'Invalid token'], 401);
        }*/
        $admin = Auth::guard('sanctum')->user();
        if (!$admin) {
        return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        $data = $request->validate([
            'uid' => 'required',
            'first_name' => 'required',
            'family_name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
        ]);
    
        $traineeData = [
            'UID' => $data['uid'],
            'first_name' => $data['first_name'],
            'family_name' => $data['family_name'],
            't_username' => $data['username'],
            't_password' => $data['password'],
            'email' => $data['email'],
        ];
    
        $trainee = Trainee_details::create($traineeData);
        return response()->json(['success' => true, 'message' => 'Trainee created successfully', 'trainee' => $trainee], 200);
    }
    
    /*private function authenticateAdmin($token)
    {
        
        $admin = Admin_login::where('api_token', $token)->first();

        return $admin !== null;
    }*/


    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdmin_loginRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin_login $admin_login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin_login $admin_login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdmin_loginRequest $request, Admin_login $admin_login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin_login $admin_login)
    {
        //
    }
}
