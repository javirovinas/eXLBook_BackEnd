<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructor_detailsRequest;
use App\Http\Requests\UpdateInstructor_detailsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Instructor_details;

class InstructorDetailsController extends Controller
{
    public function login(Request $request)
    {
    $credentials = $request->only('username', 'password');

    // Validate the credentials
    $validator = Validator::make($credentials, [
        'username' => 'required',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Authenticate the instructor
    $instructor = Instructor_details::where('username', $credentials['username'])->first();

    if (!$instructor || !Hash::check($credentials['password'], $instructor->password)) {
        return response()->json(['message' => 'Authentication failed'], 401);
    }

    // Retrieve the assigned trainees for the instructor
    $trainees = $instructor->trainees()->get();

    return response()->json(['trainees' => $trainees], 200);
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
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructor_detailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor_details $instructor_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor_details $instructor_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructor_detailsRequest $request, Instructor_details $instructor_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor_details $instructor_details)
    {
        //
    }
}
