<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Ingresen extends Model
{
    //use Notifiable;
    protected $table='ingresen';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idper',
        'idprov',
        'numdoc',
        'fecha',
        'fechav',
        'tcosto',
        'tmargen',
        'tventa',
        'tiva',
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
