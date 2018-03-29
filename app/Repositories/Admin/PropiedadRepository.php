<?php

namespace App\Repositories\Admin;

use App\Models\Admin\Propiedad;
use InfyOm\Generator\Common\BaseRepository;

class PropiedadRepository extends BaseRepository
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
        return Propiedad::class;
    }

    public function getPropiedadesFilter($request)
    {
        $propiedades = Propiedad::from('propiedades as p')
            ->join('estados_propiedades as e', 'e.id', '=', 'p.estado_propiedad_id')
            ->join('tipos_propiedades as tp', 'tp.id', '=', 'p.tipo_propiedad_id')
            ->join('tipos_operaciones as to', 'to.id', '=', 'p.tipo_operacion_id');
        if ($request['comodin'] != '') {
            $propiedades->where(function ($query) {
                $query->orWhere('p.nombre', 'LIKE', "%" . $_REQUEST['comodin'] . "%");
                $query->orWhere('p.direccion', 'LIKE', "%" . $_REQUEST['comodin'] . "%");
                $query->orWhere('e.nombre', 'LIKE', "%" . $_REQUEST['comodin'] . "%");
                $query->orWhere('to.nombre', 'LIKE', "%" . $_REQUEST['comodin'] . "%");
                $query->orWhere('tp.nombre', 'LIKE', "%" . $_REQUEST['comodin'] . "%");
            });
        }
        $propiedades= $propiedades->select("p.*")->orderBy("p.orden","desc")->orderBy("p.estado_propiedad_id", "desc")->paginate(15);
        return $propiedades;
    }
}
