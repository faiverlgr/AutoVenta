<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class TipoAjuste extends Model
{
    //use Notifiable;
    protected $table='tipoajustes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
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
