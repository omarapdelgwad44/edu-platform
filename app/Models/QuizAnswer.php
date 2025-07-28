<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    protected $guarded = [];

    public function quiz()
{
    return $this->belongsTo(Quiz::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
