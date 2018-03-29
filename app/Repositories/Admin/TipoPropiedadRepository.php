<?php

namespace App\Repositories\Admin;

use App\Models\Admin\TipoPropiedad;
use InfyOm\Generator\Common\BaseRepository;

class TipoPropiedadRepository extends BaseRepository
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
        return TipoPropiedad::class;
    }
}
