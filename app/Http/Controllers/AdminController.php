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
    
    public function createInstructor(Request $request)
    {

        $admin = Auth::guard('sanctum-admin')->user();
        if (!$admin) {
        return response()->json(['message' => 'Unauthorized'], 401);
        }
    
    $data = $request->validate([
        'uid' => 'required',
        'first_name' => 'required',
        'family_name' => 'required',
        'email' => 'required|email',
        'i_username' => 'required',
        'i_password' => 'required',
    ]);


    $instructorData = [
        'uid' => $data['uid'],
        'first_name' => $data['first_name'],
        'family_name' => $data['family_name'],
        'i_username' => $data['i_username'],
        'i_password' => Hash::make($data['i_password']),
        'email' => $data['email']
    ];

    $instructor = Instructor_details::create($instructorData);

    return response()->json([
        'token' => $instructor->createToken('api_token')->plainTextToken
    ], 200);
    }

    public function createTrainee(Request $request)
    {
    $admin = Auth::guard('sanctum-admin')->user();
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

    $trainee = Trainee_details::create([
        'uid' => $data['uid'],
        'first_name' => $data['first_name'],
        'family_name' => $data['family_name'],
        't_username' => $data['username'],
        't_password' => bcrypt($data['password']),
        'email' => $data['email'],
    ]);

    return response()->json([
        'trainee' => $trainee,
        'token' => $trainee->createToken('api_token')->plainTextToken
    ], 200);
    }

    public function updateTrainee(Updatetrainee_detailsRequest $request, trainee_details $trainee_details, $trainee_id)
{
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

    $trainee = Trainee_details::findOrFail($trainee_id);

    $trainee->update([
        'uid' => $data['uid'],
        'first_name' => $data['first_name'],
        'family_name' => $data['family_name'],
        't_username' => $data['username'],
        't_password' => bcrypt($data['password']),
        'email' => $data['email'],
    ]);

    return response()->json([
        'trainee' => $trainee,
    ], 200);
}
    
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
