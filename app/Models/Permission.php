<?php

namespace App\Models;

use Eloquent as Model;

class Permission extends Model
{
    public $fillable = [
        'name',
        'display_name',
        'description'
    ];

    /**
     * Validation permissions
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'display_name' => 'required'
    ];
}
