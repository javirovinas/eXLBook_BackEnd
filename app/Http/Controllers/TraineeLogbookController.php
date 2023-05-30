<?php

namespace App\Http\Controllers;

use App\Models\trainee_logbook;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Storetrainee_logbookRequest;
use App\Http\Requests\Updatetrainee_logbookRequest;
use Illuminate\Http\Request;
use App\Models\logbook;


class TraineeLogbookController extends Controller
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
    public function storeLogbookEntry(Storetrainee_logbookRequest $request)     //Add an entry to the logbook
    {
        $data = $request->validate([
            'logbook_id' => 'required',
            'work_order_no' => 'required',
            'log_name' => 'required',
            'task_detail' => 'nullable',
            'category' => 'nullable',
            'ATA' => 'nullable',
            'TEE_SO' => 'nullable',
            'INS_SO' => 'nullable',
            'archived' => 'boolean',
        ]);

        $trainee = Auth::guard('trainee')->user();
        $logbook = $trainee->logbook;

        $logbookEntry = new trainee_logbook($data);
        $logbook->logbookEntries()->save($logbookEntry);

        return response()->json(['message' => 'Logbook entry added successfully'], 201);
        }

    /**
     * Display the specified resource.
     */
    public function showLogbook($logbookId, request $request, trainee_logbook $trainee_logbook)       //Retreive the logbook
    {
            $traineeId = $request->input('trainee_id');

             // Retrieve the logbook associated with the trainee
            $logbook = Logbook::where('trainee_id', $traineeId)->first();

            if ($logbook) {
            // Retrieve the tasks associated with the logbook
            $tasks = trainee_logbook::where('logbook_id', $logbook->logbook_id)
                     ->where('trainee_id', $traineeId)
                     ->get();

            return response()->json(['logbook' => $logbook, 'tasks' => $tasks], 200);
            } else {
                return response()->json(['message' => 'Logbook not found for the given trainee'], 404);
                }
    }

    public function saveLogbook(Request $request)
    {
        // Logic to save logbook progress
    }

    public function submitLogbook(Request $request)
    {
        // Logic to submit logbook
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(trainee_logbook $trainee_logbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatetrainee_logbookRequest $request, trainee_logbook $trainee_logbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(trainee_logbook $trainee_logbook)
    {
        //
    }
}
