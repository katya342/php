<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Notifications\NewWorkoutNotification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class NotificationController extends Controller
{
    public function sendNewWorkoutNotification()
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        Log::info('New workout notification sent to user: ' . $user->id);
        $user->notify(new NewWorkoutNotification());

        return redirect('/')->with('status', 'New workout notification sent');

    }
    public function alert()
    {
        return view('alert');
    }
}
