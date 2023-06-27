<?php

namespace App\Http\Controllers;

use App\Models\logbook;
use App\Models\Instructor_details;
use App\Models\Trainee_details;
use App\Http\Requests\StorelogbookRequest;
use App\Http\Requests\UpdatelogbookRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LogbookController extends Controller
{
    public function assignLogbook(Request $request)
    {
    $admin = Auth::guard('sanctum-admin')->user();
    if (!$admin) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $data = $request->validate([
        'logbook_name' => 'required',
        'date' => ['required', 'date_format:Y-m-d'],
        'instructor_id' => 'required',
        'trainee_id' => 'required',
    ]);

    try {
        // Retrieve the instructor and trainee by their IDs
        $instructor = Instructor_details::findOrFail($data['instructor_id']);
        $trainee = Trainee_details::findOrFail($data['trainee_id']);

        // Fetch the instructor name from the instructors table
        $instructorModel = Instructor_details::findOrFail($instructor->instructor_id);
        $instructorName = $instructorModel->first_name . ' ' . $instructorModel->family_name;

        // Fetch the trainee name from the trainees table
        $traineeModel = Trainee_details::findOrFail($trainee->trainee_id);
        $traineeName = $traineeModel->first_name . ' ' . $traineeModel->family_name;

        // Check if the trainee is already assigned to a different instructor
        if ($trainee->logbook && $trainee->logbook->instructor_id !== $instructor->instructor_id) {
            return response()->json(['message' => 'Trainee is already assigned to a different instructor'], 400);
        }

        // Create a new logbook record and associate it with the instructor and trainee
        $logbook = new Logbook($data);
        $logbook->instructor_id = $instructor->instructor_id;
        $logbook->trainee_id = $trainee->trainee_id;
        $logbook->instructor_name = $instructorName; // Save instructor name
        $logbook->trainee_name = $traineeName; // Save trainee name
        $logbook->save();

        return response()->json(['message' => 'Logbook assigned successfully'], 201);

    } catch (ModelNotFoundException $exception) {
        // Handle the case when either instructor or trainee is not found
        if ($exception->getModel() === Trainee_details::class) {
            return response()->json(['message' => 'Invalid trainee ID. Matching Trainee ID not found'], 400);
        }

        // Handle the case when the instructor is not found
        return response()->json(['message' => 'Invalid instructor ID. Matching Instructor ID not found'], 400);
    }
}


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logbooks = logbook::all();

        if ($logbooks -> count() > 0) {
            return response() -> json([
                'message' => 'Logbooks fetched successfully',
                'logbooks' => $logbooks
            ], 200);
        } else {
            return response() -> json(['message' => 'No logbooks found'], 404);
        }
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
    public function store(StorelogbookRequest $request)
    {
        $validator = Validator::make($request -> all(), [
            'name' => 'required|max:20',
            'trainee_id' => 'required|integer',
            'instructor_id' => 'required|integer'
        ]);

        if ($validator -> fails()) {
            return response() -> json([
                'status' => 422,
                'errors' => $validator -> messages()
            ], 422);
        } else {
            $logbook = logbook::create([
                'name' => $request -> name,
                'trainee_id' => $request -> trainee_id,
                'instructor_id' => $request -> instructor_id
            ]);

            if ($logbook) {
                return response() -> json([
                    'status' => 201,
                    'message' => 'The logbook has been created successfully'
                ], 201);
            } else {
                return response() -> json([
                    'status' => 500,
                    'message' => 'Unexpected error'
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($logbookId)
    {
        $logbook = logbook::find($logbookId);

        if ($logbook) {

            return response() -> json([
                'status' => 200,
                'logbook' => $logbook
            ], 200);

        } else {

            return response() -> json([
                'status' => 404,
                'logbook' => "The ID doesn't match with any logbook"
            ], 200);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($logbookId)
    {
        $logbook = logbook::find($logbookId);

        if ($logbook) {

            return response() -> json([
                'status' => 200,
                'logbook' => $logbook
            ], 200);

        } else {

            return response() -> json([
                'status' => 404,
                'logbook' => "The ID doesn't match with any logbook"
            ], 200);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelogbookRequest $request, int $logbookId)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:20',
        'trainee_id' => 'required|integer',
        'instructor_id' => 'required|integer'
    ]);

    if ($validator->fails()) {
        return response()->json([
            'status' => 422,
            'errors' => $validator->messages()
        ], 422);
    } else {
        $logbook = logbook::find($logbookId);

        if ($logbook) {
            $logbook->name = $request->name;
            $logbook->trainee_id = $request->trainee_id;
            $logbook->instructor_id = $request->instructor_id;
            $logbook->save();

            return response()->json([
                'status' => 200,
                'message' => 'The logbook has been updated successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "The ID doesn't match with any logbook"
            ], 404);
        }
    }
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($logbookId)
    {
    $logbook = logbook::find($logbookId);

    if ($logbook) {
        $logbook->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Logbook deleted successfully'
        ], 200);
    } else {
        return response()->json([
            'status' => 404,
            'message' => "The ID doesn't match with any logbook registered."
        ], 404);
    }
    }
}
