<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    //use Notifiable;
    protected $table='zonas';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codzon',
        'nomzon',
        'deszon',
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
