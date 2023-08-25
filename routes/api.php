<?php

namespace routes\api;

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
use App\Http\Controllers\NoteController;
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
Route::group(['middleware' => ['auth:sanctum-admin']], function () {

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
    Route::put('/logbooks/{logbook_id}', [LogbookController::class, 'update']);

    //Tasks
    //retrieving tasks
    Route::get('/tasks', [TraineeLogbookController::class, 'index']);

});

//End of auth


//trainees

//Routes for Trainee login
Route::post('/trainees/login', [TraineeDetailsController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum-trainee']], function () {
//Routes for accessing the logbooks by trainee
Route::get('/trainee/logbooks/{logbook_id}/tasks', [TraineeLogbookController::class, 'showTraineeTasks']);
//Accessing the logbooks by trainee
Route::get('/trainee/{trainee_id}/logbooks', [TraineeLogbookController::class, 'showTraineeLogbooks']);
//Get specific logbook
Route::get('/trainee/{trainee_id}/logbooks/{logbook_id}', [TraineeLogbookController::class, 'showTraineeLogbook']);
//Route for logbook entry by trainee
Route::post('/trainee/{trainee_id}/taskentry/{logbook_id}', [TraineeLogbookController::class, 'storeLogbookEntry']);
//Route for updating logbook for a trainee
Route::put('/trainee/taskentry/{taskId}', [TraineeLogbookController::class, 'updateLogbookEntry']);

//Notes
Route::post('/trainee/notesentry', [NoteController::class, 'traineenotesEntry']);
Route::put('/trainee/editnotes', [NoteController::class, 'traineeeditNotes']);
Route::get('/trainee/{trainee_id}/{task_id}/notes', [NoteController::class, 'traineeshowNotes']);
});



//instructors

//Routes for instructor login
Route::post('/instructors/login', [InstructorDetailsController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum-instructor']], function () {
//Route for Instructor to view list of logbooks
Route::get('/instructor/logbooks', [InstructorLogbookAccessController::class, 'getLogbooks']);

//Route for Instructor accessing tasks for specific logbook
Route::get('/instructor/logbooks/{traineeId}/{logbookId?}', [InstructorLogbookAccessController::class, 'getTasks']);

//updating tasks after instructor signoff
Route::put('/instructor/tasks/{work_order_no}', [InstructorLogbookAccessController::class, 'update']);

//notes
Route::post('/instructor/notesentry', [NoteController::class, 'insnotesEntry']);
Route::put('/instructor/editnotes', [NoteController::class, 'inseditNotes']);
Route::get('/instructor/{instructor_id}/{task_id}/notes', [NoteController::class, 'insshowNotes']);
Route::get('/instructor/{trainee_id}/{task_id}/traineenotes', [NoteController::class, 'fetchTraineeNotes']);
});



