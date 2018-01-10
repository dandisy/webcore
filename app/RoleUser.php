<?php

namespace App;

use Laratrust\LaratrustRole;

class RoleUser extends LaratrustRole
{
    public $table = 'role_user';

    public $fillable = [
        'user_id',
        'role_id'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'user_id' => 'required',
        'role_id' => 'required'
    ];
}
