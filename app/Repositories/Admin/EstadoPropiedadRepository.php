<?php

namespace App\Repositories\Admin;

use App\Models\Admin\EstadoPropiedad;
use InfyOm\Generator\Common\BaseRepository;

class EstadoPropiedadRepository extends BaseRepository
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
        return EstadoPropiedad::class;
    }
}
