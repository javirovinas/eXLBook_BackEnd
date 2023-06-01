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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainees = Trainee_details::all();

        return response()->json(['trainees' => $trainees]);
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
       
    }

    /**
     * Display the specified resource.
     */
    public function show(trainee_details $trainee_details, $trainee_id)
    {
        $trainee = Trainee_details::find($trainee_id);

        if (!$trainee) {
            return response()->json(['message' => 'Trainee not found'], 404);
        }
    
        return response()->json(['trainee' => $trainee]);
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
    public function update(Updatetrainee_detailsRequest $request, trainee_details $trainee_details, $trainee_id)
    {
        $trainee = Trainee_details::find($trainee_id);

        if (!$trainee) {
            return response()->json(['message' => 'Trainee not found'], 404);
        }

        $data = $request->validate([
            'uid' => 'required',
            'first_name' => 'required',
            'family_name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
            // Add other validation rules for the fields you want to update
        ]);

        $trainee->update($data);

        return response()->json(['message' => 'Trainee updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(trainee_details $trainee_details)
    {
        //
    }
}
