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
