<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Post
 * @package App\Models
 * @version June 7, 2017, 3:39 am UTC
 */
class Post extends Model
{
    use SoftDeletes;

    public $table = 'posts';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'title',
        'slug',
        'content',
        'tag',
        'status',
        'category',
        'Cover'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'slug' => 'string',
        'content' => 'string',
        'tag' => 'string',
        'status' => 'string',
        'category' => 'string',
        'Cover' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'slug' => 'required',
        'content' => 'required',
        'status' => 'required',
        'category' => 'required'
    ];

    
}
