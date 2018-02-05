<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    //use Notifiable;
    protected $table='articulos';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'codprov',
        'codcate',
        'codarti',
        'nomarti',
        'nomartic',
        'vcosto',
        'vneto',
        'piva',
        'pmargen',
        'unidad',
        'minimo',
        'maximo',
        'embalaje',
        'cbarras',
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
