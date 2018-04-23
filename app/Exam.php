<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use SoftDeletes;

    public function User()
    {
        return $this->belongsToMany(User::class, 'user_exam')
            ->withPivot('score')
            ->withTimestamps();
    }
}
