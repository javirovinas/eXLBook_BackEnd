<?php

namespace App\Http\Controllers;

use App\Models\Instructor_details;
use App\Http\Requests\StoreInstructor_detailsRequest;
use App\Http\Requests\UpdateInstructor_detailsRequest;
use Illuminate\Http\Request;

class InstructorDetailsController extends Controller
{
    public function createInstructor(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'id' => 'required',
            'uid' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
        ]);

        // Generate the username by joining the first name and last name
        $username = $request->input('first_name') . '.' . $request->input('last_name');

        // Create a new Instructor instance
        $instructor = new Instructor_details;
        $instructor->id = $request->input('id');
        $instructor->uid = $request->input('uid');
        $instructor->first_name = $request->input('first_name');
        $instructor->last_name = $request->input('last_name');
        $instructor->email = $request->input('email');
        $instructor->username = $username;
        $instructor->password = $request->input('password');
        $instructor->save();

        return response()->json(['message' => 'Instructor created successfully'], 201);
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
