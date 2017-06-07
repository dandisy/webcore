<?php

namespace App\Repositories;

use App\Models\Setting;
use InfyOm\Generator\Common\BaseRepository;

class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'tagline',
        'keyword',
        'timezone',
        'privacy'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }
}
