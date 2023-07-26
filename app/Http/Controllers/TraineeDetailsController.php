<?php

namespace App\Http\Controllers;

use App\Models\trainee_details;
use App\Http\Requests\Storetrainee_detailsRequest;
use App\Http\Requests\Updatetrainee_detailsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponser;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;



class TraineeDetailsController extends Controller
{
    use ApiResponser;
    /**
     * Display a listing of the resource.
     */

     
    public function index()
    {
        $admin = Auth::guard('sanctum-admin')->user();
        if (!$admin) {
            return $this->error('Unauthorized', 401);
        }

            $trainees = Trainee_details::all();
            return response()->json(['trainees' => $trainees]);

    }

    public function login(Request $request)
    {
        try{
            $credentials = $request->only('username', 'password');

            $trainee = Trainee_details::where('t_username', $credentials['username'])->first();
    
            if ($trainee && Hash::check($credentials['password'], $trainee->t_password)) {
                // Login successful
                $token = $trainee->createToken('api_token', [$trainee->id])->plainTextToken;
                $trainee->api_token = $token; // Assign the token to the `api_token` attribute
                $trainee->save(); // Save the model with the updated token
                
                return $this->success([
                    'token' => $token,
                ]);
            }

            } catch (\Exception $e) {
                throw $e;
            }
            return response()->json(['error' => 'Incorrect username or password'], 401);
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
        $admin = Auth::guard('sanctum-admin')->user();
        if (!$admin) {
            return $this->error('Unauthorized', 401);
        }

        $trainee = Trainee_details::find($trainee_id);

        if (!$trainee) {
            return response()->json(['message' => 'Trainee not found'], 404);
        }
    
        return response()->json(['trainee' => $trainee]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(trainee_details $trainee_details, $trainee_id)
    {
        $admin = Auth::guard('sanctum-admin')->user();
        if (!$admin) {
            return $this->error('Unauthorized', 401);
        }
        $trainee = trainee_details::find($trainee_id);
        if($trainee)
        {
            return response()->json([
                'status'=> 200,
                'trainee' => $trainee,

            ], 200);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'Trainee not found',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Updatetrainee_detailsRequest $request, trainee_details $trainee_details, $trainee_id)
    {
        $trainee = Auth::guard('sanctum-admin')->user();
        if (!$trainee) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $trainee = Trainee_details::find($trainee_id);

        if (!$trainee) {
            return response()->json(['message' => 'Trainee not found'], 404);
        }

        $data = $request->validate([
            'uid' => 'required',
            'first_name' => 'required',
            'family_name' => 'required',
            'email' => 'required|email',
            't_username' => 'required',
            't_password' => 'required',
            // Add other validation rules for the fields you want to update
        ]);

        try {
            // Check if the updated uid (trainee_id) exists for any other trainee
            $existingTraineeUID = trainee_details::where('uid', $data['uid'])
                ->where('trainee_id', '!=', $trainee->trainee_id)
                ->first();
            
            $existingTraineeUsername = trainee_details::where('t_username', $data['t_username'])
                ->where('trainee_id', '!=', $trainee->trainee_id)
                ->first();

            $existingTraineeEmail = trainee_details::where('email', $data['email'])
                ->where('trainee_id', '!=', $trainee->trainee_id)
                ->first();

            if ($existingTraineeUID) {
                return response()->json(['error' => 'The UID is already assigned to another trainee'], 400);
            }
            if ($existingTraineeUsername) {
                return response()->json(['error' => 'The Username is already assigned to another trainee'], 400);
            }
            if ($existingTraineeEmail) {
                return response()->json(['error' => 'The Email is already assigned to another trainee'], 400);
            }
        } catch (QueryException $e) {
            // Handle database connection or query exception
            return response()->json(['error' => 'Failed to update trainee.'], 500);
        }

        if (isset($data['t_password'])) {
            // Hash the updated password
            $data['t_password'] = Hash::make($data['t_password']);
        }
    
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
