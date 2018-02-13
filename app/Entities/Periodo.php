<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    //use Notifiable;
    protected $table='periodos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'anoper',
        'mesper',
        'fechai',
        'fechaf',
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
