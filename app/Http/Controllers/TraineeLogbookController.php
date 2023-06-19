<?php

namespace App\Http\Controllers;

use App\Models\trainee_logbook;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Storetrainee_logbookRequest;
use App\Http\Requests\Updatetrainee_logbookRequest;
use Illuminate\Http\Request;
use App\Models\Logbook;
use App\Models\Trainee_details;

class TraineeLogbookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            $tasks = trainee_logbook::all();
            return response()->json($tasks);
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
    public function storeLogbookEntry(Storetrainee_logbookRequest $request)
    {
        $data = $request->validate([
            'work_order_no' => 'required',
            'task_detail' => 'nullable',
            'category' => 'nullable',
            'ATA' => 'nullable',
            'TEE_SO' => 'nullable',
            'INS_SO' => 'nullable',
            'archived' => 'boolean',
        ]);
    
         $traineeId = $request->route('trainee_id'); // Get the trainee_id from the route parameter
        $trainee = Trainee_details::findOrFail($traineeId);

        // Retrieve the logbook associated with the trainee
        $logbook = Logbook::where('trainee_id', $traineeId)->first();

        if ($logbook) {
            $logbookEntry = new trainee_logbook($data);
            $logbookEntry->logbook_id = $logbook->logbook_id;
            $logbookEntry->trainee_id = $trainee->trainee_id;
            $logbookEntry->save();

        return response()->json(['message' => 'Logbook entry added successfully'], 201);
        } else {
            return response()->json(['message' => 'Logbook not found for the given trainee'], 404);
            }
    }        

    /**
     * Display the specified resource.
     */
    public function showLogbookEntry($traineeId, Request $request)
    {
        $logbook =Logbook::find($traineeId);
    /*$logbook = Logbook::where('trainee_id', $traineeId)->first();
*/

    if ($logbook) {
        // Retrieve the tasks associated with the logbook
        $tasks = Trainee_logbook::where('trainee_id', $traineeId)
        ->get();

        if ($tasks->isNotEmpty()) {
            return response()->json(['tasks' => $tasks], 200);
        } else {
            return response()->json(['message' => 'Tasks not found for the given trainee'], 404);
        }
    } else {
        return response()->json(['message' => 'Logbook not found for the given trainee'], 404);
    }
}
public function showTraineeLogbook(Request $request)
{
    $trainee = Auth::guard('sanctum-trainee')->user();
    if (!$trainee) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    $logbooks = Logbook::where('trainee_id', $trainee->trainee_id)->get();

    return response()->json(['logbooks' => $logbooks], 200);
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
    $data = $request->validated();

    $traineeId = $request->input('trainee_id');

    $logbook = Logbook::where('trainee_id', $traineeId)->first();

    if ($logbook) {
        $logbook->fill([
            'logbook_id' => $request->logbook_id,
            'work_order_no' => $request->work_order_no,
            'log_name' => $request->log_name,
            'task_detail' => $request->task_detail,
            'category' => $request->category,
            'ATA' => $request->ATA,
            'TEE_SO' => $request->TEE_SO,
            'INS_SO' => $request->INS_SO,
            'archived' => $request->archived
        ]);

        $logbook->save();

        return response()->json(['message' => 'Logbook successfully updated'], 200);
        } else {
        return response()->json(['message' => "Logbook doesn't exist"], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, trainee_logbook $trainee_logbook)
    {
        $traineeId = $request->input('trainee_id');
    
        $logbook = Logbook::where('trainee_id', $traineeId)->first();
    
        if ($logbook) {
            $logbook->delete();
    
            return response()->json(['message' => 'Logbook successfully deleted'], 200);
        } else {
            return response()->json(['message' => 'Logbook not found'], 404);
        }
    }
    
}
