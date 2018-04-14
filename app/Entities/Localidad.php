<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    //use Notifiable;
    protected $table='localidades';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idred',
        'idzon',
        'codloc',
        'nomloc',
        'desloc',
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
