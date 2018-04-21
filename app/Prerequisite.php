<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prerequisite extends Model
{

    protected $fillable = ['course_id', 'pre_id'];

    public function Course()
    {

        return $this->belongsTo(Course::class);
    }
}
