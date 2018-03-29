<?php

namespace App\Repositories\Admin;

use App\Models\Admin\TipoMedia;
use InfyOm\Generator\Common\BaseRepository;

class TipoMediaRepository extends BaseRepository
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
        return TipoMedia::class;
    }
}
