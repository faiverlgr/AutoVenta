<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Conceptos extends Model
{
    //use Notifiable;
    protected $table='conceptos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'tipo',
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
