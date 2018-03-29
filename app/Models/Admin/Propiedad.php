<?php

namespace App\Models\Admin;

use Eloquent as Model;

/**
 * Class Propiedad
 * @package App\Models\Admin
 */
class Propiedad extends Model
{

    public $table = 'propiedades';


    public $fillable = [
        'nombre',
        'direccion',
        'tipo_propiedad_id',
        'tipo_operacion_id',
        'estado_propiedad_id',
        'precio',
        'descripcion',
        'latitud',
        'longitud',
        'cant_habitaciones',
        'cant_banios',
        'cant_living',
        'cant_garage',
        'cant_cocina',
        'orden',
        'destacada',
        'slide',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'direccion' => 'string',
        'tipo_propiedad_id' => 'integer',
        'tipo_operacion_id' => 'integer',
        'descripcion' => 'string',
        'latitud' => 'string',
        'longitud' => 'string',
        'cant_habitaciones' => 'integer',
        'cant_banios' => 'integer',
        'cant_living' => 'integer',
        'cant_garage' => 'integer',
        'cant_cocina' => 'integer',
        'orden' => 'integer',
        'destacada' => 'boolean',
        'slide' => 'boolean',
        'estado_propiedad_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];

    public function tipoPropiedad()
    {
        return $this->belongsTo('App\Models\Admin\TipoPropiedad');
    }

    public function tipoOperacion()
    {
        return $this->belongsTo('App\Models\Admin\TipoOperacion');
    }

    public function estadoPropiedad()
    {
        return $this->belongsTo('App\Models\Admin\EstadoPropiedad');
    }

    public function medias()
    {
        return $this->hasMany('App\Models\Admin\Media');
    }
}
