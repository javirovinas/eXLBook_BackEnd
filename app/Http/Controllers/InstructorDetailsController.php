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
    public function create(Request $request)
    {
        $data = $request->validate([
            'instructor_id' => 'required',
            'uid' => 'required',
            'first_name' => 'required',
            'family_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
        ]);

        $instructor = Instructor_details::create([
            'instructor_id' => $data['instructor_id'],
            'uid' => $data['uid'],
            'first_name' => $data['first_name'],
            'family_name' => $data['family_name'],
            'username' => $data['username'],
            'password' => $data['password'],
            'email' => $data['email'],
        ]);

        return response()->json(['message' => 'Instructor created successfully'], 201);

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
