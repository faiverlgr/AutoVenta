<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Negocio extends Model
{
    //use Notifiable;
    protected $table='negocios';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idcli',
        'idred',
        'idzon',
        'idloc',
        'nombre',
        'direccion',
        'idciudad',
        'telefono1',
        'email',
        'tipneg',
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
