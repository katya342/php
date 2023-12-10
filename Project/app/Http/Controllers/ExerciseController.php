<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\Exercise;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    public function show_all_exercises()
    {
        $exercises = Exercise::all();
        return response()->json(['exercises'=> $exercises]);

    }
    public function add_exercise(Request $request, $idEx)
    {
        $user = Auth::user();
        Log::info('User information:', ['user' => $user]);
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
       
        
        $exercise = Exercise::find($idEx);
        if (!$exercise) {
            return response()->json(['error' => 'Exercise not found'], 404); 
        }

        $user->exercises()->attach($idEx);

        return response()->json(['message' => 'Exercise added to user', 'exercise' => $exercise], 200);

    }



        public function show_exercise($idEx)
    {
        $exercise = Exercise::find($idEx);
        if (!$exercise) {
            return response()->json(['error' => 'Exercise not found'], 404);
        }

        return response()->json(['exercise' => $exercise]);
    }

}
