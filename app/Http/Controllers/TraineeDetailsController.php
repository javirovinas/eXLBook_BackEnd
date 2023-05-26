<?php

namespace App\Http\Controllers;

use App\Models\trainee_details;
use App\Http\Requests\Storetrainee_detailsRequest;
use App\Http\Requests\Updatetrainee_detailsRequest;
use Illuminate\Http\Request;

class TraineeDetailsController extends Controller
{
    public function createTrainee(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'id' => 'required',
            'uid' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]+$/',
            'category' => 'required',
        ]);

        // Generate the username by joining the first name and last name
        $username = $request->input('first_name') . '.' . $request->input('last_name');

        // Create a new Trainee instance
        $trainee = new Trainee_details;
        $trainee->id = $request->input('id');
        $trainee->uid = $request->input('uid');
        $trainee->first_name = $request->input('first_name');
        $trainee->last_name = $request->input('last_name');
        $trainee->email = $request->input('email');
        $trainee->category = $request->input('category');
        $trainee->username = $username;
        $trainee->password = $request->input('password');
        $trainee->save();

        return response()->json(['message' => 'Trainee created successfully'], 201);
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
