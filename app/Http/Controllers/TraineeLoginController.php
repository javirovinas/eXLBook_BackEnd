<?php

namespace App\Http\Controllers;

use App\Models\trainee_login;
use App\Http\Requests\Storetrainee_loginRequest;
use App\Http\Requests\Updatetrainee_loginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Str;


class TraineeLoginController extends Controller
{
    public function login(Request $request)
    {
        $isAuthenticated = Trainee_login::login($request->username, $request->password);

        if ($isAuthenticated) {
            $trainee = Auth::guard('trainee')->user();
            $trainee->api_token = Str::random(60);
            $trainee->save();

            return response()->json(['token' => $trainee->api_token], 200);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
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
