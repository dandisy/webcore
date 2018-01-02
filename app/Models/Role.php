<?php

namespace App\Models;

use Eloquent as Model;

class Role extends Model
{
    public $fillable = [
        'name',
        'description'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];
}
