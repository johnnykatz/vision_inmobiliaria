<?php

namespace App\Models\Admin;

use Eloquent as Model;

/**
 * Class TipoOperacion
 * @package App\Models\Admin
 */
class TipoOperacion extends Model
{

    public $table = 'tipos_operaciones';
    


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
