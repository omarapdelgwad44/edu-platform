<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $guarded = [];

    public function assignment()
{
    return $this->belongsTo(Assignment::class);
}

public function answers()
{
    return $this->hasMany(QuizAnswer::class);
}

}
