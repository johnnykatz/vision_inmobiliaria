<?php

namespace App\Models\Admin;

use Eloquent as Model;

/**
 * Class User
 * @package App\Models\Admin
 */
class User extends Model
{

    public $table = 'users';


    public $fillable = [
        'name',
        'email',
        'login',
        'password',
        'password_cuenta_corriente',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'password' => 'string',
        'password_cuenta_corriente' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'email' => 'email|max:255|unique:users',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function cliente()
    {
        return $this->hasOne('App\Models\Admin\Cliente');
    }

    public function vendedor()
    {
        return $this->hasOne('App\Models\Admin\Vendedor');
    }

    public function posts()
    {
        return $this->hasMany('App\Models\Admin\Post');
    }

    public function players()
    {
        return $this->hasMany('App\Models\Admin\Player');
    }

    public function compania()
    {
        return $this->belongsTo('App\Models\Admin\Compania');
    }

    public function distribuidor()
    {
        return $this->belongsTo('App\Models\Admin\Distribuidor');
    }

    public function cuentaCorriente()
    {
        return $this->hasOne('App\Models\Admin\CuentaCorriente');
    }


    public function cuentaCorrienteMovimientos()
    {
        return $this->hasMany('App\Models\Admin\CuentaCorrienteMovimiento');
    }
}