<?php

namespace App\Http\Controllers;

use App\Models\Instructor_details;
use App\Http\Requests\StoreInstructor_detailsRequest;
use App\Http\Requests\UpdateInstructor_detailsRequest;
use Illuminate\Http\Request;

class InstructorDetailsController extends Controller
{
    
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
    public function store(StoreInstructor_detailsRequest $request)
    {
        
        $validatedData = $request->validate([
            'uid' => 'required',
            'first_name' => 'required',
            'family_name' => 'required',
            'username' => 'required',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            'email' => 'required|email',
        ]);

        $instructor = new Instructor_details;
        $instructor->UID = $request->input('uid');
        $instructor->first_name = $request->input('first_name');
        $instructor->family_name = $request->input('family_name');
        $instructor->i_username = $$request->input('username');;
        $instructor->i_password = $request->input('password');
        $instructor->email = $request->input('email');
        $instructor->save();

        return response()->json(['message' => 'Instructor created successfully'], 201);
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
