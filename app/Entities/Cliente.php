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
        'documento',
        'nombres',
        'apellidos',
        'razons',
        'direccion',
        'idepto',
        'idciudad',
        'telefonos',
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
