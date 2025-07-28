<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    public function lesson()
{
    return $this->belongsTo(Lesson::class);
}

public function quizzes()
{
    return $this->hasMany(Quiz::class);
}

}
