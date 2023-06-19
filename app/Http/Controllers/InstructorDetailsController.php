<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInstructor_detailsRequest;
use App\Http\Requests\UpdateInstructor_detailsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponser;
use App\Models\Instructor_details;

class InstructorDetailsController extends Controller
{
    use ApiResponser;
    public function login(Request $request)
{
    $credentials = $request->only('username', 'password');

    $instructor = Instructor_details::where('i_username', $credentials['username'])->first();

    if ($instructor && Hash::check($credentials['password'], $instructor->i_password)) {
        // Login successful
        $token = $instructor->createToken('api_token', [$instructor->id])->plainTextToken;
        $instructor->api_token = $token; // Assign the token to the `api_token` attribute
        $instructor->save(); // Save the model with the updated token

        return $this->success([
            'token' => $token
        ]);
    } else {
        // Invalid credentials
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor_details::all();

        return response()->json([
        'instructors' => $instructors,
        ]);
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
    public function store(StoreInstructor_detailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor_details $instructor_details, $instructor_id)
    {
        $instructor = Instructor_details::find($instructor_id);

    if (!$instructor) {
        return response()->json(['message' => 'Instructor not found'], 404);
    }

    return response()->json(['instructor' => $instructor]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor_details $instructor_details)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructor_detailsRequest $request, Instructor_details $instructor_details, $instructor_id)
    {
        $instructor = Instructor_details::find($instructor_id);

    if (!$instructor) {
        return response()->json(['message' => 'Instructor not found'], 404);
        }

        $data = $request->validate([
            'uid' => 'required',
            'first_name' => 'required',
            'family_name' => 'required',
            'email' => 'required|email',
            'username' => 'required',
            'password' => 'required',
        ]);

    $instructor->update($data);

    return response()->json(['message' => 'Instructor updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Instructor_details $instructor_details)
    {
        //
    }
}
