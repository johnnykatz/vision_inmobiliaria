<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password','nombre_tienda','nombre_contacto','telefono_contacto','cedula','ciudad_id'
//    ];
    protected $fillable = [
        'name', 'email', 'password', 'telefono_contacto'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ciudad()
    {
        return $this->belongsTo('App\Models\Admin\Ciudad');
    }

    public function cliente()
    {
        return $this->hasOne('App\Models\Admin\Cliente');
    }

    public function vendedor()
    {
        return $this->hasOne('App\Models\Admin\Vendedor');
    }

    public function players()
    {
        return $this->hasMany('App\Models\Admin\Player');
    }

    public function cuentaCorriente()
    {
        return $this->hasOne('App\Models\Admin\CuentaCorriente');
    }
}
