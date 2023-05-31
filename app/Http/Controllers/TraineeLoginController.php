<?php

namespace App\Http\Controllers;

use App\http\Requests\Storetrainee_loginRequest;
use App\http\Requests\Updatetrainee_loginRequest;
use App\Models\Trainee_details;
use App\Models\Trainee_login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TraineeLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $trainee = Trainee_details::where('t_username', $credentials['username'])->first();

        if ($trainee && Hash::check($credentials['password'], $trainee->t_password)) {
            // Login successful
            return response()->json(['message' => 'Login successful', 'trainee' => $trainee], 200);
        }else {
        // Invalid credentials
        return response()->json(['message' => 'Invalid credentials'], 401);
        }
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
    public function store(Storetrainee_loginRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(trainee_login $trainee_login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(trainee_login $trainee_login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatetrainee_loginRequest $request, trainee_login $trainee_login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(trainee_login $trainee_login)
    {
        //
    }
}
