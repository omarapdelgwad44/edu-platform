<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function teacher()
{
    return $this->belongsTo(User::class, 'teacher_id');
}

public function lessons()
{
    return $this->hasMany(Lesson::class);
}

}
