<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
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

//Routes for instructor login
Route::post('/instructors/login', [InstructorDetailsController::class, 'login']);

//Routes for Trainee login
Route::post('/trainees/login', [TraineeDetailsController::class, 'login']);

//Routes for accessing the logbooks by trainee
Route::post('/tranee/login/{trianee_id}', [TraineeLogbookController::class, 'showLogbook']);
