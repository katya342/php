<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'last_workout_check',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'exercise_user_relations');
    }
    public function workouts()
    {
        return $this->hasMany(Workout::class);
    }
    public function comments()
    {
        return $this->hasMany(WorkoutComment::class);
    }
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);    
    }
}
