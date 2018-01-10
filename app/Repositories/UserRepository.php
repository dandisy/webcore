<?php

namespace App\Repositories;

use App\User;
use Webcore\Generator\Common\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }
}
