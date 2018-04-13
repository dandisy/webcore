<?php

namespace App\Models;

use Eloquent as Model;

class Role extends Model
{
    public $fillable = [
        'name',
        'display_name',
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
