<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    //use Notifiable;
    protected $table='kardex';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idbodega',
        'idperiodo',
        'idarticulo',
        'inicial',
        'entradas',
        'salidas',
        'conteo1',
        'conteo2',
        'conteo3',
        'vcosto'
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
