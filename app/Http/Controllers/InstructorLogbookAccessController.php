<?php

namespace App\Http\Controllers;

use App\Models\Instructor_logbook_access;
use App\Http\Requests\StoreInstructor_logbook_accessRequest;
use App\Http\Requests\UpdateInstructor_logbook_accessRequest;
use App\Models\logbook;
use App\Models\trainee_details;
use App\Models\trainee_logbook;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class InstructorLogbookAccessController extends Controller
{
    public function getLogbooks()
    {
        $instructor = Auth::guard('sanctum-instructor')->user();
        if (!$instructor) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $logbooks = logbook::where('instructor_id', $instructor->instructor_id)->get();

        if ($logbooks->isEmpty()) {
            return response()->json(['message' => 'No logbooks found for the instructor'], 404);
        }

        $traineeLogbooks = [];
        foreach ($logbooks as $logbook) {
            $trainee = trainee_details::find($logbook->trainee_id);
            $traineeName = $trainee->first_name . ' ' . $trainee->family_name;
            $traineeLogbooks[] = [
                'logbook_id' => $logbook->logbook_id,
                'logbook_name' => $logbook->logbook_name,
                'instructor_id' => $logbook->instructor_id,
                'trainee_id' => $trainee->trainee_id,
                'trainee_name' => $traineeName,
            ];
        }

        return response()->json(['trainee_logbooks' => $traineeLogbooks], 200);
    }



    public function getTasks($traineeId, $logbookId = null)
    {
        $instructor = Auth::guard('sanctum-instructor')->user();
        if (!$instructor) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $query = Trainee_logbook::where('trainee_id', $traineeId);

            // If a specific logbookId is provided, add it to the query
        if ($logbookId !== null) {
            $query->where('logbook_id', $logbookId);
        }

        $tasks = $query->get();

        if ($tasks->isEmpty()) {
            return response()->json(['message' => 'No tasks found for the logbook'], 404);
        }

        return response()->json(['tasks' => $tasks], 200);
    }


    public function getLogbooksAssigned()
    {
    }


    public function getTasksAssigned()
    {
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
    public function update(UpdateInstructor_logbook_accessRequest $request, $taskId)
    {
        $instructor = Auth::guard('sanctum-instructor')->user();
        if (!$instructor) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $data = $request->validate([
            'INS_SO' => 'nullable',
        ]);

        // Convert TEE_SO value to valid datetime format
        if (!empty($data['INS_SO'])) {
            $data['INS_SO'] = Carbon::createFromFormat('Y-m-d H:i:s', $data['INS_SO'])->format('Y-m-d H:i:s');
        }

        $logbookEntry = trainee_logbook::where('task_id', $taskId)->first();

        // Check if the logbook entry belongs to the instructor
        $logbook = logbook::where('instructor_id', $instructor->instructor_id)->where('logbook_id', $logbookEntry->logbook_id)->first();
        if (!$logbook) {
            return response()->json(['message' => 'Logbook entry not found for the given trainee'], 404);
        }

        $logbookEntry->update($data);

        return response()->json(['message' => 'Logbook entry updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor_logbook_access $instructor_logbook_access)
    {
        //
    }
}
