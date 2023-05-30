<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorDetailsController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\TraineeDetailsController;
use App\Http\Controllers\TraineeLogbookController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Admin Login route
Route::post('admin/login', [AdminAuthController::class, 'login']);

// Routes for creating new accounts
Route::post('admin/login/instructors', [AdminController::class, 'createinstructor']);
Route::post('admin/login/trainees', [AdminController::class, 'createtrainee']);

//Routes for assigning logbooks
Route::post('admin/login/logbooks', [LogbookController::class, 'assignLogbook']);

//Trainees

Route::middleware('auth.trainee')->group(function () {
//Routes for Trainee login
Route::post('/trainees/login', [TraineeLoginController::class, 'login']);

//Routes for accessing the logbooks by trainee
Route::get('/trainee/login/{trainee_id}', [TraineeLogbookController::class, 'showLogbook']);

//Route for logbook entry by trainee
Route::post('/trainee/{trainee_id}', [TraineeLogbookController::class, 'storeLogbookEntry']);
});

//instructors

Route::middleware('auth.instructor')->group(function () {

//Routes for instructor login
Route::post('/instructors/login', [InstructorDetailsController::class, 'login']);

//Route for Instructor to view list of logbooks
Route::get('/instructor/login/{instructor_id}/logbooks', [InstructorDetailsController::class, 'getLogbooks']);

//Route for Instructor accessing logbooks
Route::get('/instructor/login/{instructor_id}/logbooks/{logbookId}', [InstructorDetailsController::class, 'getTasks']);
});