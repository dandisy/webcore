<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Article2
 * @package App\Models
 * @version June 6, 2017, 9:58 am UTC
 */
class Article2 extends Model
{
    use SoftDeletes;

    public $table = 'article2s';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'description'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
