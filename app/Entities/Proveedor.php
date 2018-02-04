<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    //use Notifiable;
    protected $table='proveedores';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idprov',
        'nit',
        'razons',
        'sigla',
        'direccion',
        'telefono1',
        'telefono2',
        'email',
        'estado'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        //
    ];
}
