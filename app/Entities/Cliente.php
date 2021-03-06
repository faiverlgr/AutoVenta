<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //use Notifiable;
    protected $table='clientes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tipdoc',
        'nrodoc',
        'nombres',
        'apellidos',
        'razons',
        'direccion',
        'idciudad',
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
