<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $guarded = [];

    public function assignment()
{
    return $this->belongsTo(Assignment::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
