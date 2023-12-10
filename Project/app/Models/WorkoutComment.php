<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkoutComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 'workout_id', 'comment',
    ];
    public function workout()
    {
        return $this->belongsTo(Workout::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
