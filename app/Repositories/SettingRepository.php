<?php

namespace App\Repositories;

use App\Models\Setting;
use Webcore\Generator\Common\BaseRepository;

class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'key',
        'value',
        'description'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Setting::class;
    }
}
