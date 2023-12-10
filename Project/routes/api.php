<?php

use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\WorkoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Use the Sanctum authentication routes
Auth::routes();

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user/data', [LoginController::class, 'getAuthorizedUser']);
    Route::post('/exercises/{idEx}/add-to-user', [ExerciseController::class, 'add_exercise']);
    Route::post('/user/workouts', [WorkoutController::class, 'createWorkout']);
    Route::get('/user/get/workouts', [WorkoutController::class, 'getUserWorkouts']);
    Route::post('/user/add-comment/{workoutId}', [WorkoutController::class, 'addComment']);
    Route::post('/user/add-subscription/{planId}', [PaymentController::class, 'subscribe']);
    Route::post('/user/unsubscribe/{subId}', [PaymentController::class, 'unsubscribe']);
    Route::get('/user/active-subs', [PaymentController::class, 'getActiveSubs']);
    Route::get('/user/unactive-subs', [PaymentController::class, 'getUnactiveSubs']);
    Route::post('/send-new-workout-notification', [NotificationController::class, 'sendNewWorkoutNotification']);
    Route::get('/workouts/check-for-new', [WorkoutController::class, 'checkForNewWorkout']);
    // Other authenticated routes
});


Route::post('/register', [UserController::class, 'register']);  


Route::post('/authorize', [UserController::class, 'authorize']);


Route::delete('/delete/{userId}', [UserController::class, 'delete_account']);



Route::get('/workouts/{id}', [WorkoutController::class, 'getWorkout']);


Route::put('/workouts/{id}', [WorkoutController::class, 'updateWorkout']);


Route::delete('/workouts/{id}', [WorkoutController::class, 'deleteWorkout']);


Route::get('/exercises', [ExerciseController::class, 'show_all_exercises']);
Route::get('/exercises/{id}', [ExerciseController::class, 'show_exercise']);

Route::post('/workouts/add-image/{workoutId}', [WorkoutController::class, 'addWorkoutImage']);

Route::get('/user/plans', [PaymentController::class, 'getAvailablePlans']);


