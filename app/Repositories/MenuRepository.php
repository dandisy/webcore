<?php

namespace App\Repositories;

use App\Models\Menu;
use InfyOm\Generator\Common\BaseRepository;

class MenuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'label',
        'link',
        'group',
        'parent',
        'order'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Menu::class;
    }
}
