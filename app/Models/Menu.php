<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Menu
 * @package App\Models
 * @version June 5, 2017, 10:02 am UTC
 */
class Menu extends Model
{
    use SoftDeletes;

    public $table = 'menus';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'label',
        'link',
        'group',
        'parent',
        'order'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'label' => 'string',
        'link' => 'string',
        'group' => 'string',
        'parent' => 'string',
        'order' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'label' => 'required',
        'link' => 'required',
        'group' => 'required',
        'parent' => 'required',
        'order' => 'required'
    ];

    
}
