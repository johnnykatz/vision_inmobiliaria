<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Media;
use InfyOm\Generator\Common\BaseRepository;

class MediaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Media::class;
    }
}
