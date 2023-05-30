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
        $instructor = Instructor_details::where('i_username', $credentials['username'])
            ->where('i_password', $credentials['password'])
            ->first();

        if (!$instructor) {
            return response()->json(['message' => 'Authentication failed'], 401);
        }

        return response()->json(['message' => 'Login successful'], 200);
    }

    public function getLogbooks($instructorId, $logbookId)
    {
        $logbooks = Logbook::where('logbook_id', $logbookId) -> where('instructor_id', $instructorId)->first();

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
