<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    public function course()
{
    return $this->belongsTo(Course::class);
}

public function files()
{
    return $this->hasMany(File::class);
}

public function assignments()
{
    return $this->hasMany(Assignment::class);
}

}
