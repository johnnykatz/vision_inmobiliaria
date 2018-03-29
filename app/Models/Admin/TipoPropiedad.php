<?php

namespace App\Models\Admin;

use Eloquent as Model;

/**
 * Class TipoPropiedad
 * @package App\Models\Admin
 */
class TipoPropiedad extends Model
{

    public $table = 'tipos_propiedades';


    public $fillable = [
        'nombre'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];


    public function propiedades()
    {
        return $this->hasMany('App\Models\Admin\Propiedad');
    }
}
