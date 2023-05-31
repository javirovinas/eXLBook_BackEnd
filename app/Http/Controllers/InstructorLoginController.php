<?php

namespace App\Http\Controllers;

use App\Models\Instructor_details;
use App\Models\instructor_login;
use App\Http\Requests\Storeinstructor_loginRequest;
use App\Http\Requests\Updateinstructor_loginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class InstructorLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $instructor = Instructor_details::where('i_username', $credentials['username'])->first();

        if ($instructor && Hash::check($credentials['password'], $instructor->i_password)) {
            // Login successful
            return response()->json(['message' => 'Login successful', 'instructor' => $instructor], 200);
        } else {
            // Invalid credentials
            return response()->json(['message' => 'Invalid credentials'], 401);
        }
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
    public function store(Storeinstructor_loginRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(instructor_login $instructor_login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(instructor_login $instructor_login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updateinstructor_loginRequest $request, instructor_login $instructor_login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(instructor_login $instructor_login)
    {
        //
    }
}
