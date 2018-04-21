<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'code',
        'description',
        'total_grade',
        'prerequisite'
    ];
    private $errors = [];


    private $rules = [
        'id' => 'nullable|max:12|exist:users,id',
        'name' => 'required|max:120',
        'code' => 'nullable|max:10|min:4',
        'description' => 'nullable|max:160',
        'total_grade' => 'required',
        'prerequisite' => 'nullable'
    ];

    public function User()
    {
        return $this->belongsToMany(User::class, 'user_course')
            ->withTimestamps();

    }

    public function Classes()
    {
        return $this->belongsToMany(StudentClass::class, 'classes', 'course_id', 'course_id')
            ->withTimestamps();
    }

    /**
     * @param $preq
     * @param $course
     * @param $arr
     */
    public static function createPre($preq, $course): void
    {
        foreach ($preq as $item) {
            Prerequisite::create(['course_id' => $course->id, 'pre_id' => $item]);
        }
    }

    public function Prerequisite()
    {
        return $this->hasMany(Prerequisite::class)->select(['course_id']);
    }

    public function getPrequestedCoursesIds()
    {
        $related = Prerequisite::where('course_id', $this->id)->pluck('pre_id');
        /*$couses_ids = [];
        foreach ($related as $rel) {
            $couses_ids[] = $rel->id;
        }*/
        return $related;

    }

    public function getPreqCourse()
    {
        $courses_ids = $this->getPrequestedCoursesIds();
        return self::find($courses_ids);

    }

    public function getOtherCourses($arrayOfCourses)
    {
        return self::whereNotIn('id', $arrayOfCourses)->get();
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
            'name',
            'code',
            'description',
            'total_grade',
            'prerequisite'
        ];
        if ($method === 'put') {
            $required[] = 'id';
            $required[] = 'prerequisite_to_be_deleted';
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
        $preq = ($dataArray["prerequisite"]) ?? null;
        unset($dataArray['prerequisite']);
        $course = Course::create($dataArray);
        /*        $course->prerequisite()->attach($preq);*/
        self::createPre($preq, $course);
        return ["data" => $user, "state" => 0];


    }

    public static function updateIt($dataArray, $id)
    {
        $course = self::findOrFail($id);
        $preq = ($dataArray["prerequisite"]) ?? [];
        $ToBeDeleted = ($dataArray["prerequisite_to_be_deleted"]) ?? [];
        unset($dataArray['prerequisite']);
        unset($dataArray['prerequisite_to_be_deleted']);
        $course->validate($dataArray);
        if (count($course->errors())) {
            return ["data" => $course->errors(), "state" => 1];
        }
        self::createPre($preq, $course);

        DB::table('prerequisites')->whereIn('id', $ToBeDeleted)->delete();

        $course->update($dataArray);
        return ["data" => $course, "state" => 0];


    }

    public function getCoursesTokenByUser($user_id)
    {
        return self::where('user_id', $user_id);
    }
}
