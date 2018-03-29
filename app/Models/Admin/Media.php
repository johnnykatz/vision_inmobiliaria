<?php

namespace App\Models\Admin;

use Eloquent as Model;

/**
 * Class Media
 * @package App\Models\Admin
 */
class Media extends Model
{

    public $table = 'medias';
    


    public $fillable = [
        'url',
        'descripcion',
        'tipo_media_id',
        'propiedad_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'url' => 'string',
        'descripcion' => 'string',
        'tipo_media_id' => 'integer',
        'propiedad_id' => 'integer',
        'slide' =>'boolean'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    public function tipoMedia()
    {
        return $this->belongsTo('App\Models\Admin\TipoMedia');
    }

    public function propiedad()
    {
        return $this->belongsTo('App\Models\Admin\Propiedad');
    }
}
