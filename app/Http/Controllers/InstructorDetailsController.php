<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructor_detailsRequest;
use App\Http\Requests\UpdateInstructor_detailsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Models\Instructor_details;
use App\Models\trainee_logbook;
use App\Models\logbook;
use App\Models\Trainee_details;

class InstructorDetailsController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor_details::all();

        return response()->json([
        'instructors' => $instructors,
        ]);
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
    public function show(Instructor_details $instructor_details, $instructor_id)
    {
        $instructor = Instructor_details::find($instructor_id);

    if (!$instructor) {
        return response()->json(['message' => 'Instructor not found'], 404);
    }

    return response()->json(['instructor' => $instructor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor_details $instructor_details, $instructor_id)
    {
        $instructor = Instructor_details::find($instructor_id);
        if($instructor)
        {
            return response()->json([
                'status'=> 200,
                'instructor' => $instructor,

            ], 200);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No Student ID found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructor_detailsRequest $request, Instructor_details $instructor_details, $instructor_id)
    {
        $instructor = Instructor_details::find($instructor_id);

    if (!$instructor) {
        return response()->json(['message' => 'Instructor not found'], 404);
        }

        $data = $request->validate([
            'uid' => 'required',
            'first_name' => 'required',
            'family_name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
        ]);

    $instructor->update($data);

    return response()->json(['message' => 'Instructor updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor_details $instructor_details)
    {
        //
    }
}
