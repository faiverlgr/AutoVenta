<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //use Notifiable;
    protected $table='categorias';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idprov',
        'idcate',
        'nombre',
        'estado',
        'validaCate'
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
