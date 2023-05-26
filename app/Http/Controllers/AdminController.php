<?php

namespace App\Http\Controllers;

use App\Models\Admin_login;
use App\Http\Requests\StoreAdmin_loginRequest;
use App\Http\Requests\UpdateAdmin_loginRequest;

namespace App\Http\Controllers;

use App\Http\Requests\StoreAdmin_loginRequest;
use App\Http\Requests\UpdateAdmin_loginRequest;
use Illuminate\Http\Request;
use App\Models\Admin_login;
use App\Models\Trainee_details;
use App\Models\Instructor_details;

class AdminController extends Controller
{
    public function createTrainee(Request $request)     //Create Trainee
    {
        $data = $request->validate([
            'id' => 'required|unique:trainees,id|unique:instructors,id',
            'uid' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'category' => 'required',
        ]);

        $username = $data['first_name'] . '.' . $data['last_name'];     //Create username and password for trainee
        $traineeData = [
        'username' => $username,
        'password' => $data['password'],
        'trainee_id' => $data['id'],
        'trainee_name' => $username,
        ];

        $trainee = Trainee_details::createTrainee($data);

        return response()->json([
            'message' => 'Trainee created successfully',
            'trainee' => $trainee,
        ]);
    }

    public function createInstructor(Request $request)      //Create Instructor
    {
        $data = $request->validate([
            'id' => 'required|unique:trainees,id|unique:instructors,id',
            'uid' => 'required|unique',
            'first_name' => 'required',
            'last_name' => 'required',                'email' => 'required|email',
            'password' => 'required',
        ]);
        $username = $data['first_name'] . '.' . $data['last_name'];     // Create username and password for instructor
            $instructorData = [
            'username' => $username,
            'password' => $data['password'],
            'instructor_id' => $data['id'],
            'instructor_name' => $username,
            ];
        
            // Save instructor details and username in the instructor_details table
            $instructor = new Instructor_details();
            $instructor->username = $username;
            $instructor->instructor_id = $data['id'];
            $instructor->instructor_name = $username;
            // Set other instructor details here
            $instructor->save();

        $instructor = Instructor_details::createInstructor($data);

        return response()->json([
            'message' => 'Instructor created successfully',
            'instructor' => $instructor,
        ]);
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
    public function store(StoreAdmin_loginRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin_login $admin_login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin_login $admin_login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdmin_loginRequest $request, Admin_login $admin_login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin_login $admin_login)
    {
        //
    }
}
