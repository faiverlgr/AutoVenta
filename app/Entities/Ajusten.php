<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Ajusten extends Model
{
    //use Notifiable;
    protected $table='ajusten';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'idconcepto',
        'idper',
        'fecha',
        'tcosto',
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
