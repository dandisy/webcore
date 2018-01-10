<?php

namespace App\Repositories;

use App\Role;
use Webcore\Generator\Common\BaseRepository;

class RoleRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Role::class;
    }
}
