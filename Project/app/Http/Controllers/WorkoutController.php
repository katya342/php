<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use App\Models\WorkoutComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ILLuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WorkoutController extends Controller
{
    // получение списка всех тренировок пользователя
    public function getUserWorkouts(){
        $user = Auth::user();
        $workouts = $user->workouts;
        return response()->json(['workouts' => $workouts], 200);
    }

    // получение информации об конкретной тренировки
    public function getWorkout($id)
    {
        $workout = Workout::find($id);
        if(!$workout){
            return response()->json(['error' => 'Workout not found'], 404);
        }
        else{
            return response()->json(['workout' => $workout], 200);
        }
    }

    // создать новую тренировку для пользователя
    public function createWorkout(Request $request)
    {
        try{
            $user = Auth::user();
            
            if(!$user)
            {
                return response()->json(['error' => 'user is not authorized']);
            }

        

            // Создаем новую тренировку через отношение "один ко многим"
            $workout = $user->workouts()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'date' => $request->input('date')

                // Другие поля по необходимости
            ]);
       
        return response()->json(['workout' => $workout], 201);

        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
            
        
    }


    // обновление информации об тренировке
    public function updateWorkout(Request $request, $id)
    {
        $workout = Workout::find($id);
        if (!$workout) {
            return response()->json(['error' => 'Workout not found'], 404);
        }
        
        $workout->title = $request->input('title');
        $workout->description = $request->input('description');
        $workout->date = $request->input('date'); 

        $workout->update($request->all());

        return response()->json(['workout' => $workout], 200);
    }
   
    public function deleteWorkout($id)
    {
        $workout = Workout::find($id);

        if (!$workout) {
            return response()->json(['error' => 'Workout not found'], 404);
        }

        $workout->delete();

        return response()->json(['message' => 'Workout deleted successfully'], 200);
    }
    public function addComment(Request $request, $workoutId)
    {
        $user = Auth::user();
        $workout = Workout::find($workoutId);
        
        if (!$workout) {
            return response()->json(['error' => 'Workout not found'], 404);
        }

        $comment = new WorkoutComment([
            'comment' => $request->input('comment'),
            
             
        ]);
        
    // Связывание комментария с тренировкой и пользователем
        $user->comments()->save($comment);
        $workout->comments()->save($comment);

        return response()->json(['comment' => $comment], 201);
        
    }
    public function addWorkoutImage(Request $request, $workoutId)
    {
       
        try
        {
            Log::info('Start addWorkoutImage method');
            $workout = Workout::find($workoutId);
            if (!$workout)
            {
                return response()->json(['error' => 'Workout does not exist'], 404);
            }
            $imagePath = $request->file('image')->store('workout_images', 'public');
            $workout->images()->create(['image_path' => $imagePath]);
            return response()->json(['success' => 'Image added to workout success']);

        }
        catch(\Throwable $ex)
        {
            Log::error('Exception: ' . $ex->getMessage());
            return response()->json(['Exception' => $ex->getMessage()], 500);
        }
        
       

    }
  


    public function checkForNewWorkout()
    {
       
        $newWorkouts = Workout::where('created_at', '>', auth()->user()->last_workout_check ?? null)->exists();
    

        if ($newWorkouts) {
            auth()->user()->update(['last_workout_check' => now()]);
        }
    
        return response()->json(['newWorkout' => $newWorkouts]);
    }

    
    

    
}
