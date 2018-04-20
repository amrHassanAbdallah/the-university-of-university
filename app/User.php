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
        'email' => 'required|max:160|unique:users',
        'password' => 'required|
               min:6|
                        |confirmed',
        'password_confirmation' => 'required'
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
            'name',
            'email',
            'level',
            'password',
            'password_confirmation'
        ];
        if ($method === 'update') {
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
        $dataArray["password"] = bcrypt($dataArray["password"]);
        User::create($dataArray);
        return ["data" => $user, "state" => 0];


    }


}
