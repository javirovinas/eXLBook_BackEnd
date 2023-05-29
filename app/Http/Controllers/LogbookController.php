<?php

namespace App\Http\Controllers;

use App\Models\logbook;
use App\Models\Instructor_details;
use App\Models\Trainee_details;
use App\Http\Requests\StorelogbookRequest;
use App\Http\Requests\UpdatelogbookRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LogbookController extends Controller
{
    public function assignLogbook(Request $request)
        {
            $data = $request->validate([
                'log_name' => 'required',
                'instructor_id' => 'required',
                'trainee_id' => 'required',
            ]);
    
            // Retrieve the instructor and trainee by their IDs
            $instructor = Instructor_details::findOrFail($data['instructor_id']);
            $trainee = Trainee_details::findOrFail($data['trainee_id']);
    
            // Create a new logbook record and associate it with the instructor and trainee
            $logbook = new Logbook($data);
            $logbook->instructor_id = $instructor->instructor_id;
            $logbook->trainee_id = $trainee->trainee_id;
            $logbook->save();
    
            return response()->json(['message' => 'Logbook assigned successfully'], 201);
        }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logbooks = logbook::all();

        if ($logbooks -> count() > 0) {
            return response() -> json([]);
        } else {
            return response() -> json([]);
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
                'logbook' => "The ID doesn't matches with any logbook"
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
                'logbook' => "The ID doesn't matches with any logbook"
            ], 200);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelogbookRequest $request, int $logbookId)
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

            $logbook = logbook::find($logbookId);

            if ($logbook) {
                $logbook = logbook::update([
                    'name' => $request -> name,
                    'trainee_id' => $request -> trainee_id,
                    'instructor_id' => $request -> instructor_id
                ]);
                return response() -> json([
                    'status' => 200,
                    'message' => 'The logbook has been updated successfully'
                ], 200);
            } else {
                return response() -> json([
                    'status' => 404,
                    'message' => "The ID doesn't matches with any logbook"
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
            return response() -> json([
                'status' => 200,
                'message' => 'Logbook deleted successfully'
            ], 200);
        } else {
            return response() -> json([
                'status' => 404,
                'message' => "The ID doesn't match with any logbook registered."
            ], 404);
        }
    }
}
