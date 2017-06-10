<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Component
 * @package App\Models
 * @version June 10, 2017, 3:46 pm UTC
 */
class Component extends Model
{
    use SoftDeletes;

    public $table = 'components';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'description',
        'module'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'module' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'module' => 'required'
    ];

    
}
