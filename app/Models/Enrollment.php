<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $guarded = [];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function course()
{
    return $this->belongsTo(Course::class);
}

}
