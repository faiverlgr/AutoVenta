<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Agencia extends Model
{
    //use Notifiable;
    protected $table='agencias';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codage',
        'nombreage',
        'nomrepre',
        'docrepre',
        'direccion',
        'barrio',
        'telefono1',
        'telefono2',
        'email',
        'estado',
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
