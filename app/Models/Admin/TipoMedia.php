<?php

namespace App\Models\Admin;

use Eloquent as Model;

/**
 * Class TipoMedia
 * @package App\Models\Admin
 */
class TipoMedia extends Model
{

    public $table = 'tipos_medias';
    


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

    public function medias()
    {
        return $this->hasMany('App\Models\Admin\Media');
    }
}
