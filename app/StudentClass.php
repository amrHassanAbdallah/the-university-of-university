<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class StudentClass extends Model
{

    use SoftDeletes;
    protected $table = 'classes';

    protected $fillable = [
        'user_id',
        'course_id',
        'name',
        'date',
        'location'
    ];
    private $errors = [];


    private $rules = [
        'user_id' => 'required|max:12',
        'course_id' => 'required|max:12',
        'name' => 'required|max:120',
        'location' => 'required|max:160|min:4',
        'date' => 'required|max:160'

    ];

    public function User()
    {
        return $this->belongsToMany(User::class, 'user_class', 'class_id')
            ->withTimestamps();
    }

    public function Course()
    {
        return $this->belongsToMany(Course::class, 'user_course', 'class_id')
            ->withTimestamps();
    }


    public function validate($data)
    {
        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }


    public function errors()
    {

        return $this->errors;
    }

    public static function getRequiredAttribute($method)
    {
        $required = [
            'user_id',
            'course_id',
            'location',
            'date',
            'name'
        ];
        if ($method === 'put') {
            $required[] = 'id';
        }
        return $required;

    }

    public static function getDataFromRequest($required, $request)
    {
        $data = [];
        foreach ($required as $req) {
            $data[$req] = $request->$req;
        }
        return $data;

    }


    public static function store($dataArray)
    {
        $class = new self();
        $class->validate($dataArray);
        if (count($class->errors())) {
            return ["data" => $class->errors(), "state" => 1];
        }

        $class = self::create($dataArray);
        /*        $course->prerequisite()->attach($preq);*/
        return ["data" => $class, "state" => 0];


    }

    public static function updateIt($dataArray, $id)
    {
        $course = self::findOrFail($id);
        $course->validate($dataArray);
        if (count($course->errors())) {
            return ["data" => $course->errors(), "state" => 1];
        }

        $course->update($dataArray);
        return ["data" => $course, "state" => 0];


    }

    public static function getAllTeacherClasses($teacher_id)
    {
        return self::where('user_id', $teacher_id)->get();
    }



}
