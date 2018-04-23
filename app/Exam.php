<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Validator;

class Exam extends Model
{
    use SoftDeletes;

    public function User()
    {
        return $this->belongsToMany(User::class, 'user_exam')
            ->withPivot('score')
            ->withTimestamps();
    }

    public function Course()
    {
        return $this->hasOne(Course::class, 'id', 'course_id');
    }

    public function StudentClass()
    {
        return $this->belongsToMany(StudentClass::class, 'class_exam', 'exam_id', 'class_id');
    }

    protected $fillable = [
        'location',
        'test_day',
        'test_hour',
        'grade',
        'type',
        'course_id',
    ];
    private $errors = [];


    private $rules = [
        'id' => 'nullable|max:12|exist:users,id',
        'location' => 'required|max:120',
        'test_day' => 'required|max:10|min:4',
        'test_hour' => 'required|max:160',
        'grade' => 'required',
        'type' => 'required',
        'course_id' => 'required',
    ];


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
            'location',
            'test_day',
            'test_hour',
            'grade',
            'type',
            'course_id',
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
        $user = new self();
        $user->validate($dataArray);
        if (count($user->errors())) {
            return ["data" => $user->errors(), "state" => 1];
        }

        $exam = Exam::create($dataArray);
        $exam->StudentClass()->attach(StudentClass::where('course_id', $dataArray['course_id'])->get());
        return ["data" => $user, "state" => 0];


    }

    public static function updateIt($dataArray, $id)
    {
        $exam = self::findOrFail($id);
        $exam->validate($dataArray);
        if (count($exam->errors())) {
            return ["data" => $exam->errors(), "state" => 1];
        }
        $exam->StudentClass()->detach();
        $exam->update($dataArray);
        $exam->StudentClass()->attach(StudentClass::where('course_id', $dataArray['course_id'])->get());

        return ["data" => $exam, "state" => 0];


    }


}
