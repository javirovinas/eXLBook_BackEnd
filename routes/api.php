<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\TraineeDetailsController;

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
Route::post('/login', [AdminAuthController::class, 'login']);

// Routes for creating new accounts
Route::post('login/instructors', [AdminController::class, 'createinstructor']);
Route::post('login/trainees', [AdminController::class, 'createtrainee']);

//Routes for assigning logbooks
Route::post('/login/logbooks', [LogbookController::class, 'assignLogbook']);
