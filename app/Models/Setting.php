<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Setting
 * @package App\Models
 * @version June 7, 2017, 3:43 am UTC
 */
class Setting extends Model
{
    use SoftDeletes;

    public $table = 'settings';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'icon',
        'title',
        'tagline',
        'keyword',
        'timezone',
        'privacy'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'icon' => 'string',
        'title' => 'string',
        'tagline' => 'string',
        'keyword' => 'string',
        'timezone' => 'string',
        'privacy' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'tagline' => 'required',
        'keyword' => 'required',
        'timezone' => 'required',
        'privacy' => 'required'
    ];

    
}
