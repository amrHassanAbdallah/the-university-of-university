<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Registration extends Model
{
    protected $fillable = [
        'start',
        'end'
    ];
    private $errors = [];


    private $rules = [
        'id' => 'nullable|max:12|exist:registrations,id',
        'start' => 'required|date|date_format:Y-m-d',
        'end' => 'nullable|date|date_format:Y-m-d|after:start',

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
            'start',
            'end',

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

        $reg = Registration::create($dataArray);
        /*        $reg->prerequisite()->attach($preq);*/
        return ["data" => $reg, "state" => 0];


    }

    public static function updateIt($dataArray, $id)
    {
        $reg = self::findOrFail($id);
        $reg->validate($dataArray);
        if (count($reg->errors())) {
            return ["data" => $reg->errors(), "state" => 1];
        }


        $reg->update($dataArray);
        return ["data" => $reg, "state" => 0];


    }

    public function getCoursesTokenByUser($user_id)
    {
        return self::where('user_id', $user_id);
    }
}
