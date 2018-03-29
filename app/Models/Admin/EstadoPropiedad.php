<?php

namespace App\Models\Admin;

use Eloquent as Model;

/**
 * Class EstadoPropiedad
 * @package App\Models\Admin
 */
class EstadoPropiedad extends Model
{

    public $table = 'estados_propiedades';
    


    public $fillable = [
        'nombre',
        'slug'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nombre' => 'string',
        'slug' => 'string'
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
