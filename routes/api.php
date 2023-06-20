<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InstructorDetailsController;
use App\Http\Controllers\InstructorLogbookAccessController;
use App\Http\Controllers\LogbookController;
use App\Http\Controllers\InstructorLoginController;
use App\Http\Controllers\TraineeDetailsController;
use App\Http\Controllers\TraineeLoginController;
use App\Http\Controllers\TraineeLogbookController;
use App\Http\Middleware\CorsMiddleware;
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

//Admin Create
Route::post('/register', [AdminAuthController::class, 'createAdmin']);
//admin login
//Route::middleware(['cors'])->group(function () {
Route::post('/adminlogin', [AdminAuthController::class, 'login']);
//});

//Admin authentication required routes 
Route::group(['middleware' => ['auth:sanctum']], function () {

    // Routes for creating new  trainee accounts
    
    Route::post('/trainees', [AdminController::class, 'createTrainee']);
  
    //Route for GET trainees
    Route::get('/trainees', [TraineeDetailsController::class, 'index']);
    Route::get('/trainees/{trainee_id}', [TraineeDetailsController::class, 'show']);
    //Route for PUT requests - Trainees
    Route::get('/trainees/{trainee_id}', [TraineeDetailsController::class, 'edit']); //new
    Route::put('/trainees/{trainee_id}', [TraineeDetailsController::class, 'update']);
    
    // Routes for creating new instructor accounts
    Route::post('/instructors', [AdminController::class, 'createinstructor']);
    //Route for GET Instructors
    Route::get('/instructors', [InstructorDetailsController::class, 'index']);
    Route::get('/instructors/{instructor_id}', [InstructorDetailsController::class, 'show']);
    //Route for PUT requests - Instructors
    Route::get('/instructors/{instructor_id}', [InstructorDetailsController::class, 'edit']); //new
    Route::put('/instructors/{instructor_id}', [InstructorDetailsController::class, 'update']);

    //Routes for assigning logbooks
    Route::post('/assignlogbooks', [LogbookController::class, 'assignLogbook']);
    //Routes to GET logbooks
    Route::get('/logbooks', [LogbookController::class, 'index']);
    Route::put('/logbooks/{logbook_id}', [LogbookController::class, 'show']);

    //Tasks
    Route::get('/tasks', [TraineeLogbookController::class, 'index']);
});

//End of auth


//trainees


//Routes for Trainee login
Route::post('/trainees/login', [TraineeDetailsController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum-trainee']], function () {
//Routes for accessing the logbooks by trainee
Route::get('/tasks/{trainee_id}', [TraineeLogbookController::class, 'showLogbookEntry']);
//Route::get('/tlogbooks/{trainee_id}', [TraineeLogbookController::class, 'showTraineeLogbook']);
Route::get('/trainee/logbooks', [TraineeLogbookController::class, 'showTraineeLogbook']);
//Route for logbook entry by trainee
Route::post('/tasks/{trainee_id}', [TraineeLogbookController::class, 'storeLogbookEntry']);

});



//instructors

//Routes for instructor login
Route::post('/instructors/login', [InstructorDetailsController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum-instructor']], function () {
//Route for Instructor to view list of logbooks
Route::get('/instructor/logbooks', [InstructorLogbookAccessController::class, 'getLogbooks']);

//Route for Instructor accessing logbooks
Route::get('/instructor/logbooks/{traineeId}', [InstructorLogbookAccessController::class, 'getTasks']);
});

