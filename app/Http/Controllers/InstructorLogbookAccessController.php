<?php

namespace App\Http\Controllers;

use App\Models\Instructor_logbook_access;
use App\Http\Requests\StoreInstructor_logbook_accessRequest;
use App\Http\Requests\UpdateInstructor_logbook_accessRequest;
use App\Models\logbook;
use App\Models\Trainee_details;
use App\Models\trainee_logbook;

class InstructorLogbookAccessController extends Controller
{
    
    public function getLogbooks($instructorId, $logbookId)
    {
        $logbooks = logbook::where('logbook_id', $logbookId) -> where('instructor_id', $instructorId)->first();

        if ($logbooks->isEmpty()) {
            return response()->json(['message' => 'No logbooks found for the instructor'], 404);
        }

        $traineeLogbooks = [];
        foreach ($logbooks as $logbook) {
        $trainee = Trainee_details::find($logbook->trainee_id);
        $traineeName = $trainee->first_name . ' ' . $trainee->family_name;
        $traineeLogbooks[] = [
            'logbook_id' => $logbook->logbook_id,
            'trainee_id' => $trainee->trainee_id,
            'trainee_name' => $traineeName,
        ];
        }
        return response()->json(['trainee_logbooks' => $traineeLogbooks], 200);
    }

    public function getTasks($logbookId)
    {
        $tasks = trainee_logbook::where('logbook_id', $logbookId)->get();

        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No tasks found for the logbook'], 404);
        }

        return response()->json(['tasks' => $tasks], 200);
    }


    public function getLogbooksAssigned() {

    }


    public function getTasksAssigned() {
        
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
    public function store(StoreInstructor_logbook_accessRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor_logbook_access $instructor_logbook_access)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor_logbook_access $instructor_logbook_access)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructor_logbook_accessRequest $request, Instructor_logbook_access $instructor_logbook_access)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor_logbook_access $instructor_logbook_access)
    {
        //
    }
}
