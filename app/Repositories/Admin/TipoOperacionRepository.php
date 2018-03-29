<?php

namespace App\Repositories\Admin;

use App\Models\Admin\TipoOperacion;
use InfyOm\Generator\Common\BaseRepository;

class TipoOperacionRepository extends BaseRepository
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
        return TipoOperacion::class;
    }
}
