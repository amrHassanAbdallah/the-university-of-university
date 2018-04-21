<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    private $errors = [];


    private $rules = [
        'id' => 'nullable|max:12|exist:users,id',
        'name' => 'required|max:120',
        'email' => 'nullable|max:160|unique:users',
        'password' => 'required|
               min:6|
                        |confirmed',
        'password_confirmation' => 'required'
    ];

    public function Course()
    {
        return $this->belongsToMany(Course::class, 'user_course')
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
            'name',
            'level',
            'password',
            'password_confirmation'
        ];
        if ($method === 'put') {
            $required[] = 'id';
        } elseif ($method === 'post') {
            $required[] = 'email';

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
        $dataArray["password"] = bcrypt($dataArray["password"]);
        User::create($dataArray);
        return ["data" => $user, "state" => 0];


    }

    public static function updateUser($dataArray, $id)
    {
        $user = self::findOrFail($id);
        $dataArray["password"] = ($dataArray["password"]) ? bcrypt($dataArray["password"]) : $user->password;
        $dataArray["password_confirmation"] = ($dataArray["password_confirmation"]) ? bcrypt($dataArray["password_confirmation"]) : $user->password;
        $user->validate($dataArray);
        if (count($user->errors())) {
            return ["data" => $user->errors(), "state" => 1];
        }
        $user->update($dataArray);
        return ["data" => $user, "state" => 0];


    }


}
