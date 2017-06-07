<?php

namespace App\Repositories;

use App\Permission;
use InfyOm\Generator\Common\BaseRepository;

class PermissionRepository extends BaseRepository
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
        return Permission::class;
    }
}
