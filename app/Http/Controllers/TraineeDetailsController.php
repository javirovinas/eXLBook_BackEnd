<?php

namespace App\Http\Controllers;

use App\Models\Trainee_details;
use App\Http\Requests\Storetrainee_detailsRequest;
use App\Http\Requests\Updatetrainee_detailsRequest;
use Illuminate\Http\Request;

class TraineeDetailsController extends Controller
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
    public function create(Request $request)
    {
        $data = $request->validate([
            'trainee_id' => 'required',
            'uid' => 'required',
            'first_name' => 'required',
            'family_name' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email' => 'required|email',
        ]);

        $trainee = Trainee_details::create([
            'trainee_id' => $data['trainee_id'],
            'uid' => $data['uid'],
            'first_name' => $data['first_name'],
            'family_name' => $data['family_name'],
            'username' => $data['username'],
            'password' => $data['password'],
            'email' => $data['email'],
        ]);

        return response()->json(['message' => 'Trainee created successfully'], 201);
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
