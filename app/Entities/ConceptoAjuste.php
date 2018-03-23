<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class ConceptoAjuste extends Model
{
    //use Notifiable;
    protected $table='concepto_ajustes';
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
