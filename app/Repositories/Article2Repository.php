<?php

namespace App\Repositories;

use App\Models\Article2;
use InfyOm\Generator\Common\BaseRepository;

class Article2Repository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Article2::class;
    }
}
