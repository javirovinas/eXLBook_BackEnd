<?php

namespace App\Http\Controllers;

use App\Models\Trainee_details;
use App\Models\trainee_logbook;
use App\Models\logbook;
use App\Http\Requests\Storetrainee_detailsRequest;
use App\Http\Requests\Updatetrainee_detailsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class TraineeDetailsController extends Controller
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

    // Authenticate the trainee
    $trainee = Trainee_details::where('t_username', $credentials['username'])->first();

    if (!$trainee) {
        return response()->json(['message' => 'Authentication failed'], 401);
    }

    if ($credentials['password'] !== $trainee->t_password) {
        return response()->json(['message' => 'Authentication failed'], 401);
    }

    // Retrieve the trainee's logbook and tasks
    $logbook = logbook::where('trainee_id', $trainee->trainee_id)->first();

    if (!$logbook) {
        return response()->json(['message' => 'Logbook not found for the given trainee'], 404);
    }

    $tasks = trainee_logbook::where('logbook_id', $logbook->logbook_id)->get();

    return response()->json(['logbook' => $logbook, 'tasks' => $tasks], 200);
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
    public function store(Storetrainee_detailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(trainee_details $trainee_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(trainee_details $trainee_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatetrainee_detailsRequest $request, trainee_details $trainee_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(trainee_details $trainee_details)
    {
        //
    }
}
